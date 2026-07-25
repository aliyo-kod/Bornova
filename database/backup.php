<?php
/**
 * Database Backup Script
 *
 * Usage: php database/backup.php
 * Or: php database/backup.php /path/to/backup/dir
 *
 * Creates a complete database backup with SQL dump
 */

require __DIR__ . '/../app/Support/env.php';

$backupDir = $argv[1] ?? __DIR__ . '/../storage/backups';

if (!is_dir($backupDir)) {
    mkdir($backupDir, 0755, true);
}

$host = env('DB_HOST', 'localhost');
$database = env('DB_DATABASE', 'bornova');
$username = env('DB_USERNAME', 'root');
$password = env('DB_PASSWORD', '');

$timestamp = date('Y-m-d_H-i-s');
$filename = "backup_{$database}_{$timestamp}.sql";
$filepath = $backupDir . '/' . $filename;

echo "🔄 Starting database backup...\n";
echo "   Database: {$database}\n";
echo "   Backup file: {$filepath}\n\n";

try {
    // Use mysqldump command-line tool
    $command = sprintf(
        'mysqldump --host=%s --user=%s --password=%s %s > %s 2>&1',
        escapeshellarg($host),
        escapeshellarg($username),
        escapeshellarg($password),
        escapeshellarg($database),
        escapeshellarg($filepath)
    );

    $returnCode = null;
    system($command, $returnCode);

    if ($returnCode === 0 && file_exists($filepath)) {
        $size = filesize($filepath);
        $sizeInMb = round($size / 1024 / 1024, 2);

        echo "✅ Backup created successfully!\n";
        echo "   File: {$filename}\n";
        echo "   Size: {$sizeInMb} MB\n";
        echo "   Path: {$filepath}\n\n";

        // Log backup in database
        require __DIR__ . '/../vendor/autoload.php';
        require __DIR__ . '/../app/Support/helpers.php';

        try {
            $backup = \App\Models\Backup::createNew($filename, $size);
            $backup->markCompleted();
            echo "✅ Backup logged in database\n";
        } catch (\Exception $e) {
            echo "⚠️  Backup created but not logged: " . $e->getMessage() . "\n";
        }
    } else {
        throw new \Exception("Backup creation failed. Return code: {$returnCode}");
    }

    exit(0);
} catch (\Exception $e) {
    echo "❌ Backup failed:\n";
    echo "   " . $e->getMessage() . "\n\n";
    echo "⚠️  Troubleshooting:\n";
    echo "   1. Ensure mysqldump is installed and in PATH\n";
    echo "   2. Check database credentials in .env\n";
    echo "   3. Ensure backup directory is writable\n";
    exit(1);
}
