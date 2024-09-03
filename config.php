<?php
$host = 'dev-mysql'; // MySQL container name or alias
$dbname = 'default'; // Database name
$username = 'root'; // MySQL username
$password = 'pass123'; // MySQL password

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>




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
