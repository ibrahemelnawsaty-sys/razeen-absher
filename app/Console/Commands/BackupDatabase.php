<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database {--compress : ضغط الـ Backup}';
    protected $description = 'عمل نسخة احتياطية من قاعدة البيانات';

    public function handle()
    {
        $this->info('⏳ جاري عمل نسخة احتياطية...');

        $backupDir = storage_path('backups');
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $filename = $backupDir . '/backup_' . date('Y-m-d_H-i-s') . '.sql';
        $database = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');

        $command = "mysqldump -h {$host} -u {$user} -p{$password} {$database} > {$filename}";

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $filesize = filesize($filename);

            if ($this->option('compress')) {
                exec("gzip {$filename}");
                $filename .= '.gz';
                $filesize = filesize($filename);
                $this->info('✅ تم الضغط!');
            }

            $this->info('✅ تم بنجاح!');
            $this->info('📁 الملف: ' . $filename);
            $this->info('📊 الحجم: ' . round($filesize / 1024 / 1024, 2) . ' MB');
        } else {
            $this->error('❌ فشل الـ Backup');
        }
    }
}
