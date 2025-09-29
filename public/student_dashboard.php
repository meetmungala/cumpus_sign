<?php
require_once __DIR__ . '/../config/auth.php';
require_login(['student']);
$user = current_user();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student Dashboard</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-3">
<h2>Welcome, <?php echo htmlspecialchars($user['full_name']); ?></h2>
<a class="btn btn-outline-secondary btn-sm" href="<?php echo app_base_url(); ?>/logout.php">Logout</a>
</div>
<div class="row g-3">
<div class="col-md-4">
<a class="card text-decoration-none" href="<?php echo app_base_url(); ?>/student_profile.php">
<div class="card-body">
<h5 class="card-title">My Profile</h5>
<p class="card-text">Resume, cover letter, skills</p>
</div>
</a>
</div>
<div class="col-md-4">
<a class="card text-decoration-none" href="<?php echo app_base_url(); ?>/internships_browse.php">
<div class="card-body">
<h5 class="card-title">Find Internships</h5>
<p class="card-text">Browse & one-click apply</p>
</div>
</a>
</div>
<div class="col-md-4">
<a class="card text-decoration-none" href="<?php echo app_base_url(); ?>/applications_student.php">
<div class="card-body">
<h5 class="card-title">Applications</h5>
<p class="card-text">Status & interview schedule</p>
</div>
</a>
</div>
</div>
</div>
</body>
</html>