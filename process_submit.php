<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $category = $_POST['category'];
    $suggestion = trim($_POST['suggestion']);
    $anonymous = isset($_POST['anonymous']);

    if (empty($category) || empty($suggestion)) {
        die('All required fields must be filled.');
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO suggestions (full_name, contact, category, suggestion, anonymous) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$full_name, $contact, $category, $suggestion, $anonymous]);
        
        header('Location: confirmation.php');
        exit;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
} else {
    header('Location: index.php');
    exit;
}
?>

