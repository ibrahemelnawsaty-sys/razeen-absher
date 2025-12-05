<?php

echo "🖥️  معلومات نظامك\n";
echo "================================\n\n";

echo "📦 PHP Version الحالي:\n";
echo "   " . phpversion() . "\n";

$requiredVersion = '8.4.0';
$currentVersion = phpversion();

if (version_compare($currentVersion, $requiredVersion, '>=')) {
    echo "✅ الإصدار متوافق (>= 8.4.0)\n";
} else {
    echo "❌ الإصدار غير متوافق\n";
    echo "   المطلوب: >= {$requiredVersion}\n";
    echo "   الحالي: {$currentVersion}\n";
}

echo "\n🐬 MySQL Version:\n";
$conn = mysqli_connect('localhost', 'root', '');
if ($conn) {
    echo "   " . mysqli_get_server_info($conn) . "\n";
    echo "   ✅ متصل\n";
    mysqli_close($conn);
} else {
    echo "   ❌ غير متصل\n";
}

echo "\n📋 Extensions المطلوبة:\n";
$required = ['mysqli', 'pdo', 'json', 'zlib'];
foreach ($required as $ext) {
    $status = extension_loaded($ext) ? '✅' : '❌';
    echo "   {$status} {$ext}\n";
}

echo "\n💾 Memory Limit:\n";
echo "   " . ini_get('memory_limit') . "\n";

echo "\n⏱️  Max Execution Time:\n";
echo "   " . ini_get('max_execution_time') . " seconds\n";

echo "\n================================\n";
echo "🔧 الحل:\n";
if (version_compare($currentVersion, $requiredVersion, '<')) {
    echo "1. ثبّت PHP 8.4+ من: https://www.php.net/downloads\n";
    echo "2. أو استخدم XAMPP/WAMP الأحدث\n";
    echo "3. أضف المسار الجديد إلى PATH\n";
}

?>
