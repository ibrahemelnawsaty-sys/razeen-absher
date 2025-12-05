<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'absher';

$mysqldumpPath = null;
$paths = require 'config/backup.php';

// البحث عن mysqldump
foreach ($paths['mysql_paths'] as $path) {
    if (file_exists($path)) {
        $mysqldumpPath = $path;
        echo "✅ تم العثور على mysqldump في: {$path}\n\n";
        break;
    }
}

if (!$mysqldumpPath) {
    echo "❌ mysqldump غير موجود\n";
    echo "المسارات التي تم البحث عنها:\n";
    foreach ($paths['mysql_paths'] as $path) {
        echo "  ❌ {$path}\n";
    }
    echo "\n💡 الحل: أضف MySQL bin إلى PATH أو ثبت MySQL مجدداً\n";
    exit;
}

// إنشاء مجلد Backups
if (!is_dir('backups')) {
    mkdir('backups', 0755, true);
    echo "📁 تم إنشاء مجلد backups\n\n";
}

// اسم الملف مع التاريخ والوقت - استخدام forward slash
$timestamp = date('Y-m-d_H-i-s');
$filename = 'backups/backup_' . $timestamp . '.sql';
$compressedFile = $filename . '.gz';

echo "🚀 نظام Export قاعدة البيانات\n";
echo "================================\n\n";

// 1. Export كامل قاعدة البيانات
echo "⏳ خطوة 1: Export قاعدة البيانات...\n";
echo "   Database: {$database}\n";
echo "   Host: {$host}\n";
echo "   User: {$user}\n";

// تحويل backslash إلى forward slash للـ output file
$outputFile = str_replace('\\', '/', $filename);

// الأمر الصحيح - بدون مسافة بين -p و كلمة المرور
if (empty($password)) {
    // بدون كلمة مرور
    $command = "\"{$mysqldumpPath}\" -h {$host} -u {$user} {$database} > \"{$outputFile}\"";
} else {
    // مع كلمة مرور (بدون مسافة)
    $command = "\"{$mysqldumpPath}\" -h {$host} -u {$user} -p{$password} {$database} > \"{$outputFile}\"";
}

echo "   🔧 الأمر: {$command}\n";

$output = [];
$returnCode = 0;
exec($command, $output, $returnCode);

if ($returnCode === 0 && file_exists($filename)) {
    $filesize = filesize($filename);
    echo "✅ تم Export بنجاح!\n";
    echo "📁 الملف: {$filename}\n";
    echo "📊 الحجم: " . round($filesize / 1024 / 1024, 2) . " MB\n\n";
    
    // 2. ضغط الملف
    echo "⏳ خطوة 2: ضغط الملف...\n";
    
    if (file_exists($filename)) {
        $fileContent = file_get_contents($filename);
        $compressed = gzencode($fileContent, 9);
        
        if (file_put_contents($compressedFile, $compressed)) {
            unlink($filename);
            
            $compressedSize = filesize($compressedFile);
            $ratio = round((1 - ($compressedSize / $filesize)) * 100, 2);
            
            echo "✅ تم الضغط بنجاح!\n";
            echo "📦 الملف المضغوط: {$compressedFile}\n";
            echo "📊 الحجم المضغوط: " . round($compressedSize / 1024 / 1024, 2) . " MB\n";
            echo "📉 نسبة الضغط: {$ratio}%\n\n";
            
            // 3. إنشاء ملف معلومات
            echo "⏳ خطوة 3: إنشاء ملف المعلومات...\n";
            $infoFile = 'backups/backup_' . $timestamp . '.info';
            $infoContent = [
                'Database: ' . $database,
                'Host: ' . $host,
                'User: ' . $user,
                'Date: ' . date('Y-m-d H:i:s'),
                'Original Size: ' . round($filesize / 1024 / 1024, 2) . ' MB',
                'Compressed Size: ' . round($compressedSize / 1024 / 1024, 2) . ' MB',
                'Compression Ratio: ' . $ratio . '%',
                'PHP Version: ' . phpversion(),
                'MySQL Version: ' . getMysqlVersion($host, $user, $password),
                'OS: ' . php_uname()
            ];
            
            file_put_contents($infoFile, implode("\n", $infoContent));
            echo "✅ تم إنشاء ملف المعلومات!\n";
            echo "📄 الملف: {$infoFile}\n\n";
            
            // 4. عرض ملخص
            echo "✨ ملخص العملية\n";
            echo "================================\n";
            echo "✅ النسخة الاحتياطية جاهزة للاستخدام!\n\n";
            echo "📋 معلومات الاستيراد:\n";
            if (empty($password)) {
                echo "💻 gunzip < {$compressedFile} | mysql -h {$host} -u {$user} {$database}\n\n";
            } else {
                echo "💻 gunzip < {$compressedFile} | mysql -h {$host} -u {$user} -p{$password} {$database}\n\n";
            }
            
            // 5. عرض قائمة الـ Backups
            echo "📋 Backups السابقة (آخر 5):\n";
            echo "================================\n";
            listBackups();
            
        } else {
            echo "❌ فشل الضغط\n";
        }
    }
} else {
    echo "❌ فشل الـ Export\n";
    if (!empty($output)) {
        echo "تفاصيل الخطأ:\n";
        foreach ($output as $line) {
            echo "  " . $line . "\n";
        }
    }
    
    echo "\n🔍 التشخيص:\n";
    echo "الأمر المستخدم:\n";
    echo "{$command}\n";
    
    // محاولة اختبار الاتصال بـ MySQL
    echo "\n🧪 اختبار الاتصال:\n";
    testMysqlConnection($host, $user, $password);
}

/**
 * الحصول على إصدار MySQL
 */
function getMysqlVersion($host, $user, $password) {
    try {
        $conn = mysqli_connect($host, $user, $password);
        if (!$conn) {
            return 'Unknown - ' . mysqli_connect_error();
        }
        $version = mysqli_get_server_info($conn);
        mysqli_close($conn);
        return $version;
    } catch (\Exception $e) {
        return 'Unknown - Error';
    }
}

/**
 * اختبار الاتصال بـ MySQL
 */
function testMysqlConnection($host, $user, $password) {
    $conn = mysqli_connect($host, $user, $password ?: null);
    
    if ($conn) {
        echo "✅ الاتصال بـ MySQL: نجح\n";
        echo "   MySQL Version: " . mysqli_get_server_info($conn) . "\n";
        mysqli_close($conn);
    } else {
        echo "❌ الاتصال بـ MySQL: فشل\n";
        echo "   الخطأ: " . mysqli_connect_error() . "\n";
    }
}

/**
 * عرض قائمة الـ Backups
 */
function listBackups() {
    $backupDir = 'backups';
    $files = glob($backupDir . '/backup_*.sql.gz');
    
    if (empty($files)) {
        echo "لا توجد نسخ احتياطية بعد\n";
        return;
    }
    
    rsort($files);
    
    $count = 1;
    foreach ($files as $file) {
        if ($count > 5) break;
        
        $size = filesize($file);
        $date = date('Y-m-d H:i:s', filemtime($file));
        $basename = basename($file);
        
        echo "{$count}. {$basename}\n";
        echo "   📊 الحجم: " . round($size / 1024 / 1024, 2) . " MB\n";
        echo "   📅 التاريخ: {$date}\n";
        
        $count++;
    }
}

?>
