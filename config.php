<?php
// Database configuration for XAMPP/local
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'tingog';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Simple admin password (change in production)
define('ADMIN_PASSWORD', 'admin123');
?>

