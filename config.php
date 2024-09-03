<?php
// config.php
$host = 'localhost';
$db   = 'user_management';
$user = 'root';  // Your MySQL username
$pass = '';      // Your MySQL password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    createDatabaseAndTable($pdo, $db);
    $pdo->exec("USE $db");
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
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
