<?php
require_once 'config.php';

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $category = $_POST['category'];
    $suggestion = $_POST['suggestion'];
    $anonymous = isset($_POST['anonymous']);
    
    $stmt = $pdo->prepare("INSERT INTO suggestions (full_name, contact, category, suggestion, anonymous, status) VALUES (?, ?, ?, ?, ?, 'pending')");
    $stmt->execute([$full_name, $contact, $category, $suggestion, $anonymous]);
    
    header('Location: admin.php?success=added');
    exit;
} else {
    header('Location: admin.php');
    exit;
}
?>

