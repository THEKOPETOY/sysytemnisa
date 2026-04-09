<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tingog Mo, Aksyon Ko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    session_start();
    require_once 'config.php';
    
    if (!isset($_SESSION['admin_logged_in'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['password'] === ADMIN_PASSWORD) {
            $_SESSION['admin_logged_in'] = true;
        } else {
            ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3>Admin Login</h3>
                                <form method="POST">
                                    <input type="password" class="form-control mb-3" name="password" placeholder="Password" required>
                                    <button type="submit" class="btn btn-primary w-100">Login</button>
                                </form>
                                <a href="index.php" class="btn btn-link mt-3">Public Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            exit;
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%) !important;">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="admin.php">
                <i class="bi bi-gear-fill me-2"></i>Admin Dashboard
            </a>
            <a href="?logout=1" class="btn btn-outline-light ms-auto">Logout</a>
        </div>
    </nav>
    <div class="container mt-4 mb-5">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo $_GET['success'] == 'added' ? 'Added successfully!' : 'Deleted successfully!'; ?></div>
        <?php endif; ?>
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="page-title mb-0">Manage Suggestions</h2>
                <small class="text-muted">Full CRUD operations</small>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="bi bi-plus-lg"></i> Add New
                </button>
            </div>
        </div>
        <!-- Search Form -->
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    <option value="Public Services">Public Services</option>
                    <option value="Facilities">Facilities</option>
                    <option value="Safety">Safety</option>
                    <option value="Cleanliness">Cleanliness</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="resolved">Resolved</option>
                    <option value="not_feasible">Not Feasible</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search suggestions..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-secondary w-100">Filter</button>
            </div>
        </form>
        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Suggestion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="process_add.php" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact</label>
                                <input type="text" name="contact" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select" required>
                                    <option value="Public Services">Public Services</option>
                                    <option value="Facilities">Facilities</option>
                                    <option value="Safety">Safety</option>
                                    <option value="Cleanliness">Cleanliness</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Suggestion</label>
                                <textarea name="suggestion" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" name="anonymous" id="anonymous" class="form-check-input">
                                <label class="form-check-label" for="anonymous">Anonymous</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Suggestion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name/Contact</th>
                    <th>Category</th>
                    <th>Suggestion</th>
                    <th>Status</th>
                    <th>Response</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Filter logic
                $where = [];
                $params = [];
                
                if (!empty($_GET['category'])) {
                    $where[] = "category = ?";
                    $params[] = $_GET['category'];
                }
                if (!empty($_GET['status'])) {
                    $where[] = "status = ?";
                    $params[] = $_GET['status'];
                }
                if (!empty($_GET['search'])) {
                    $where[] = "(suggestion LIKE ? OR full_name LIKE ? OR category LIKE ?)";
                    $search = '%' . $_GET['search'] . '%';
                    $params[] = $search;
                    $params[] = $search;
                    $params[] = $search;
                }
                
                $sql = "SELECT * FROM suggestions";
                if (!empty($where)) {
                    $sql .= " WHERE " . implode(" AND ", $where);
                }
                $sql .= " ORDER BY created_at DESC";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $name_display = $row['anonymous'] ? 'Anonymous' : ($row['full_name'] . ' (' . $row['contact'] . ')');
                    echo '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . htmlspecialchars($name_display) . '</td>
                            <td>' . htmlspecialchars($row['category']) . '</td>
                            <td>' . htmlspecialchars(substr($row['suggestion'], 0, 100)) . '...</td>
                            <td><span class="badge bg-secondary status-' . $row['status'] . '">' . ucfirst($row['status']) . '</span></td>
                            <td>' . htmlspecialchars(substr($row['response'] ?? '', 0, 50)) . '...</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="process_update.php?id=' . $row['id'] . '" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                                    <a href="process_delete.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')"><i class="bi bi-trash"></i></a>
                                </div>
                            </td>
                          </tr>';
                }
                ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Public Home</a>
    </div>
    <?php
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: admin.php');
        exit;
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

