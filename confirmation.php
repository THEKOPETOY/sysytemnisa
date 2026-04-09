<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Tingog Mo, Aksyon Ko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="index.php">
                <i class="bi bi-megaphone-fill me-2"></i>Tingog Mo, Aksyon Ko
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="submit_form.php"><i class="bi bi-plus-circle me-1"></i>Submit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="updates.php"><i class="bi bi-eye me-1"></i>Updates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning btn-sm ms-2" href="admin.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-5 shadow-lg">
                    <i class="bi bi-check-circle-fill display-1 text-success mb-4"></i>
                    <h1 class="mb-4 page-title">Thank You!</h1>
                    <p class="lead mb-4">Your suggestion has been recorded successfully.</p>
                    <p class="text-muted fs-5"><strong>Note:</strong> All submissions will be reviewed and addressed within 30 days.</p>
                    <div class="d-grid gap-3 d-md-block">
                        <a href="index.php" class="btn btn-primary btn-lg px-5">Back to Home</a>
                        <a href="updates.php" class="btn btn-outline-primary btn-lg px-5">View Updates</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

