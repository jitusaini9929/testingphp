<?php
$host = 'localhost'; // Docker MySQL container name
$dbname = 'user_management'; // Database name
$username = 'root'; // MySQL username
$password = 'Root@9929'; // MySQL password

try {
    $dsn = "mysql:host=$host;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Log successful connection
    echo "Database connection successful.<br>";

    // Create the database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    echo "Database created or already exists.<br>";

    // Use the database
    $pdo->exec("USE $dbname");
    echo "Switched to database '$dbname'.<br>";

    // Create the table if it doesn't exist
    $tableCreationSql = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($tableCreationSql);
    echo "Table 'users' created or already exists.<br>";

    // Success message
    echo "Database and table setup completed successfully.";
} catch (PDOException $e) {
    // Log the specific error message
    echo 'Connection failed: ' . $e->getMessage();
}
?>
