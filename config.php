<?php
$host = 'dev-mysql'; // Docker MySQL container name
$dbname = 'default'; // Database name
$username = 'root'; // MySQL username
$password = 'pass123'; // MySQL password

try {
    $dsn = "mysql:host=$host;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create the database and table
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    $pdo->exec("USE $dbname");
    
    $tableCreationSql = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($tableCreationSql);

    // Success message
    echo "Database and table created successfully.";
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
