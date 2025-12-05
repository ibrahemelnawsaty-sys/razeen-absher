<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportDatabase extends Command
{
    protected $signature = 'db:export {--compress : ضغط الـ Backup}';
    protected $description = 'Export قاعدة البيانات مع خيارات متقدمة';

    public function handle()
    {
        $this->info('🚀 بدء Export قاعدة البيانات...\n');

        $backupDir = storage_path('backups');
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $timestamp = date('Y-m-d_H-i-s');
        $filename = $backupDir . '/backup_' . $timestamp . '.sql';
        $compressedFile = $filename . '.gz';

        $database = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');

        // Export
        $this->info('⏳ Export قاعدة البيانات...');
        $command = "mysqldump -h {$host} -u {$user} -p{$password} {$database} > {$filename}";
        
        exec($command, $output, $returnCode);

        if ($returnCode === 0 && file_exists($filename)) {
            $filesize = filesize($filename);
            $this->info("✅ Export بنجاح!");
            $this->info("📁 الملف: {$filename}");
            $this->info("📊 الحجم: " . round($filesize / 1024 / 1024, 2) . " MB");

            if ($this->option('compress')) {
                $this->info("\n⏳ ضغط الملف...");
                exec("gzip -f {$filename}", $gzipOutput, $gzipReturn);

                if ($gzipReturn === 0) {
                    $compressedSize = filesize($compressedFile);
                    $ratio = round((1 - ($compressedSize / $filesize)) * 100, 2);
                    
                    $this->info("✅ ضغط بنجاح!");
                    $this->info("📦 الملف: {$compressedFile}");
                    $this->info("📊 الحجم المضغوط: " . round($compressedSize / 1024 / 1024, 2) . " MB");
                    $this->info("📉 نسبة الضغط: {$ratio}%");
                }
            }

            // إنشاء ملف المعلومات
            $infoFile = $backupDir . '/backup_' . $timestamp . '.info';
            $infoContent = implode("\n", [
                'Database: ' . $database,
                'Host: ' . $host,
                'Date: ' . date('Y-m-d H:i:s'),
                'Size: ' . round($filesize / 1024 / 1024, 2) . ' MB'
            ]);
            file_put_contents($infoFile, $infoContent);

            $this->info("\n✨ Export جاهز للاستخدام!");
        } else {
            $this->error('❌ فشل الـ Export');
        }
    }
}
