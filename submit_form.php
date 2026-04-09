<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Suggestion - Tingog Mo, Aksyon Ko</title>
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
                        <a class="nav-link active" href="submit_form.php"><i class="bi bi-plus-circle me-1"></i>Submit</a>
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
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-5">
                    <h2 class="page-title text-center mb-5">📝 Submit Your Suggestion</h2>
            <form action="process_submit.php" method="POST">
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name (optional)</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact Number (optional)</label>
                    <input type="tel" class="form-control" id="contact" name="contact" placeholder="e.g., 09123456789">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">Select category</option>
                        <option value="Public Services">Public Services</option>
                        <option value="Facilities">Facilities</option>
                        <option value="Safety">Safety</option>
                        <option value="Cleanliness">Cleanliness</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="suggestion" class="form-label">Suggestion / Concern</label>
                    <textarea class="form-control" id="suggestion" name="suggestion" rows="6" placeholder="Describe your suggestion or concern..." required></textarea>
                </div>
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="anonymous" name="anonymous">
                    <label class="form-check-label" for="anonymous">Submit Anonymously</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit Suggestion</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

