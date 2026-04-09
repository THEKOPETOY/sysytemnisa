<?php
require_once 'config.php';

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.php');
    exit;
}

$id = $_GET['id'] ?? 0;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM suggestions WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: admin.php?success=deleted');
exit;
?>

