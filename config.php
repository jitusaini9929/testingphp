<?php
// config.php
$dsn = 'mysql:host=ek804wooowgooskcc4co48w8;port=3306;dbname=default';
$user = 'mysql';
$pass = 'VNdUeqqAr4uMobgO2V0YXuTDNTfDONfJkFQjnNBKBLAtbCjR01GmE1ZcInNmJhkO';
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connection successful!";
} catch (\PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


// Function to create the database and table if they do not exist
function createDatabaseAndTable($pdo, $dbName) {
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbName");
    
    // Select the database
    $pdo->exec("USE $dbName");

    // Create the users table if it doesn't exist
    $tableCreationSql = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($tableCreationSql);
}
