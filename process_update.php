<?php
require_once 'config.php';

$id = $_GET['id'] ?? 0;
if (!$id) {
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $response = trim($_POST['response']);
    
    $stmt = $pdo->prepare("UPDATE suggestions SET status = ?, response = ? WHERE id = ?");
    $stmt->execute([$status, $response, $id]);
    
    header('Location: admin.php');
    exit;
}

// Fetch current
$stmt = $pdo->prepare("SELECT * FROM suggestions WHERE id = ?");
$stmt->execute([$id]);
$sug = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$sug) {
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Suggestion - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <a href="admin.php" class="btn btn-secondary mb-4">&larr; Back to Admin</a>
        <div class="card p-4">
            <h3>Edit Suggestion #<?php echo $id; ?></h3>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status" required>
                        <option value="pending" <?php echo $sug['status']=='pending' ? 'selected' : ''; ?>>pending</option>
                        <option value="ongoing" <?php echo $sug['status']=='ongoing' ? 'selected' : ''; ?>>ongoing</option>
                        <option value="resolved" <?php echo $sug['status']=='resolved' ? 'selected' : ''; ?>>resolved</option>
                        <option value="not_feasible" <?php echo $sug['status']=='not_feasible' ? 'selected' : ''; ?>>not_feasible</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Response</label>
                    <textarea class="form-control" name="response" rows="5"><?php echo htmlspecialchars($sug['response'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
