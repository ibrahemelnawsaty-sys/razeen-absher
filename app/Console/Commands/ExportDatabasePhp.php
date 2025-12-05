<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExportDatabasePhp extends Command
{
    protected $signature = 'db:export-php';
    protected $description = 'Export قاعدة البيانات بدون mysqldump';

    public function handle()
    {
        $this->info('🚀 بدء Export قاعدة البيانات (بدون mysqldump)...\n');

        $backupDir = storage_path('backups');
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $timestamp = date('Y-m-d_H-i-s');
        $filename = $backupDir . '/backup_' . $timestamp . '.sql';

        $this->info('⏳ جاري الاتصال بقاعدة البيانات...');

        try {
            // الحصول على جميع الجداول
            $tables = DB::select('SHOW TABLES');
            $dbName = env('DB_DATABASE');
            
            $sql = "-- Database Backup\n";
            $sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
            $sql .= "-- Database: " . $dbName . "\n\n";

            $this->info('⏳ جاري Export الجداول...');

            foreach ($tables as $table) {
                $tableName = (array)$table;
                $tableName = array_shift($tableName);

                $this->line("  📋 Export جدول: {$tableName}");

                // Drop Table
                $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";

                // Create Table
                $createTableResult = DB::select("SHOW CREATE TABLE `{$tableName}`");
                $createTable = (array)$createTableResult[0];
                $sql .= $createTable['Create Table'] . ";\n\n";

                // Insert Data
                $rows = DB::select("SELECT * FROM `{$tableName}`");
                
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                        $values = array_map(function($value) {
                            return "'" . addslashes($value) . "'";
                        }, (array)$row);
                        
                        $columns = implode('`, `', array_keys((array)$row));
                        $sql .= "INSERT INTO `{$tableName}` (`{$columns}`) VALUES (" . implode(', ', $values) . ");\n";
                    }
                    $sql .= "\n";
                }
            }

            // حفظ الملف
            file_put_contents($filename, $sql);
            
            $filesize = filesize($filename);
            $this->info("✅ Export بنجاح!");
            $this->info("📁 الملف: {$filename}");
            $this->info("📊 الحجم: " . round($filesize / 1024 / 1024, 2) . " MB");

            // ضغط الملف
            $this->info("\n⏳ جاري ضغط الملف...");
            $compressedFile = $filename . '.gz';
            
            $content = file_get_contents($filename);
            $compressed = gzencode($content, 9);
            file_put_contents($compressedFile, $compressed);
            
            unlink($filename); // حذف الملف الأصلي
            
            $compressedSize = filesize($compressedFile);
            $ratio = round((1 - ($compressedSize / $filesize)) * 100, 2);

            $this->info("✅ ضغط بنجاح!");
            $this->info("📦 الملف المضغوط: {$compressedFile}");
            $this->info("📊 الحجم المضغوط: " . round($compressedSize / 1024 / 1024, 2) . " MB");
            $this->info("📉 نسبة الضغط: {$ratio}%");

            $this->info("\n✨ Export جاهز للاستخدام!");

        } catch (\Exception $e) {
            $this->error('❌ فشل الـ Export: ' . $e->getMessage());
        }
    }
}
