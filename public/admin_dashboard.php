<?php
require_once __DIR__ . '/../config/auth.php';
require_login(['admin']);
$user = current_user();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-3">
<h2>Placement Cell Dashboard</h2>
<div>
<span class="me-2"><?php echo htmlspecialchars($user['full_name']); ?></span>
<a class="btn btn-outline-secondary btn-sm" href="<?php echo app_base_url(); ?>/logout.php">Logout</a>
</div>
</div>
<div class="row g-3">
<div class="col-md-3">
<a class="card text-decoration-none" href="<?php echo app_base_url(); ?>/internship_form.php">
<div class="card-body">
<h5 class="card-title">Post Internship</h5>
<p class="card-text">Verified opportunities</p>
</div>
</a>
</div>
<div class="col-md-3">
<a class="card text-decoration-none" href="<?php echo app_base_url(); ?>/mentor_approvals.php">
<div class="card-body">
<h5 class="card-title">Manage Applications</h5>
<p class="card-text">Approvals & interviews</p>
</div>
</a>
</div>
<div class="col-md-3">
<a class="card text-decoration_none" href="<?php echo app_base_url(); ?>/admin_analytics.php">
<div class="card-body">
<h5 class="card-title">Analytics</h5>
<p class="card-text">Open positions & unplaced</p>
</div>
</a>
</div>
<div class="col-md-3">
<a class="card text-decoration-none" href="<?php echo app_base_url(); ?>/admin_export_csv.php">
<div class="card-body">
<h5 class="card-title">Export</h5>
<p class="card-text">Reports & CSV</p>
</div>
</a>
</div>
</div>
</div>
</body>
</html>