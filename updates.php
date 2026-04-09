<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Updates - Tingog Mo, Aksyon Ko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">🗣️ Tingog Mo, Aksyon Ko</a>
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="submit_form.php">Submit</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <h2 class="mb-4 text-center">📊 Public Updates & Responses</h2>
        <?php
        require_once 'config.php';
        $stmt = $pdo->query("SELECT * FROM suggestions WHERE status != 'pending' ORDER BY updated_at DESC");
        $suggestions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($suggestions)) {
            echo '<div class="alert alert-info text-center">No updates available yet. Check back soon!</div>';
        } else {
            foreach ($suggestions as $sug) {
                $name_display = $sug['anonymous'] ? 'Anonymous' : ($sug['full_name'] ?: 'Resident');
                echo '
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title">' . htmlspecialchars($name_display) . '</h5>
                            <span class="status-badge status-' . $sug['status'] . '">' . ucfirst($sug['status']) . '</span>
                        </div>
                        <h6><i class="bi bi-tag me-2"></i>' . htmlspecialchars($sug['category']) . '</h6>
                        <p class="card-text">' . htmlspecialchars($sug['suggestion']) . '</p>';
                if (!empty($sug['response'])) {
                    echo '<div class="mt-3 p-3 bg-light rounded">
                            <strong>Response:</strong> ' . htmlspecialchars($sug['response']) . '
                          </div>';
                }
                echo '<small class="text-muted">Updated: ' . date('M j, Y', strtotime($sug['updated_at'])) . '</small>
                    </div>
                </div>';
            }
        }
        ?>
        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

