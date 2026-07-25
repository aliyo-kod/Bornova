<?php
/**
 * Database Setup Script
 *
 * Usage: php database/setup.php
 *
 * This script creates the database and runs migrations.
 * Ensure DB_* environment variables are set in .env or system environment.
 */

require __DIR__ . '/../app/Support/env.php';

$host = env('DB_HOST', 'localhost');
$port = env('DB_PORT', 3306);
$database = env('DB_DATABASE', 'bornova');
$username = env('DB_USERNAME', 'root');
$password = env('DB_PASSWORD', '');

try {
    echo "🔄 Connecting to MySQL server...\n";

    // Connect to MySQL without selecting database
    $pdo = new \PDO(
        "mysql:host={$host};port={$port}",
        $username,
        $password,
        [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ]
    );

    echo "✅ Connected to MySQL\n\n";

    // Create database if it doesn't exist
    echo "📁 Creating database '{$database}' if not exists...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✅ Database ready\n\n";

    // Select database
    $pdo->exec("USE `{$database}`");

    // Run migrations
    echo "🚀 Running migrations...\n";
    $schemaFile = __DIR__ . '/migrations/001_initial_schema.sql';

    if (!file_exists($schemaFile)) {
        throw new \Exception("Schema file not found: {$schemaFile}");
    }

    $sql = file_get_contents($schemaFile);
    $pdo->exec($sql);

    echo "✅ Migrations completed successfully\n\n";

    // Verify tables
    echo "📊 Verifying tables...\n";
    $result = $pdo->query("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = '{$database}'");
    $count = $result->fetch(\PDO::FETCH_ASSOC)['count'];
    echo "✅ Database contains {$count} tables\n\n";

    echo "🎉 Database setup completed successfully!\n";
    echo "Next: Configure routes/admin.php for admin panel (Phase 3)\n";

} catch (\PDOException $e) {
    echo "❌ Database Error:\n";
    echo "   " . $e->getMessage() . "\n\n";
    echo "⚠️  Troubleshooting:\n";
    echo "   1. Ensure MySQL is running\n";
    echo "   2. Check database credentials in .env file\n";
    echo "   3. Verify user has CREATE DATABASE privilege\n";
    exit(1);
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
