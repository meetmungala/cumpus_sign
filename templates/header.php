<?php
require_once __DIR__ . '/../config/auth.php';
start_session();
$me = current_user();
$base = app_base_url();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<title>Campus System</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<a class="navbar-brand" href="<?php echo $base; ?>/index.php">Campus</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample" aria-controls="navbarsExample" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarsExample">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
<?php if ($me): ?>
<?php if ($me['role'] === 'student'): ?>
<li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/student_dashboard.php">Dashboard</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/student_profile.php">My Profile</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/internships_browse.php">Internships</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/applications_student.php">Applications</a></li>
<?php elseif ($me['role'] === 'admin'): ?>
<li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/admin_dashboard.php">Dashboard</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/internships_admin.php">Internships</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/admin_analytics.php">Analytics</a></li>
<?php elseif ($me['role'] === 'mentor'): ?>
<li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/mentor_dashboard.php">Dashboard</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/mentor_approvals.php">Approvals</a></li>
<?php elseif ($me['role'] === 'employer'): ?>
<li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/employer_dashboard.php">Dashboard</a></li>
<li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>/internships_admin.php?scope=self">My Posts</a></li>
<?php endif; ?>
<?php endif; ?>
</ul>
<div class="d-flex">
<?php if ($me): ?>
<span class="navbar-text text-white me-2"><?php echo htmlspecialchars($me['full_name']); ?></span>
<a class="btn btn-outline-light btn-sm" href="<?php echo $base; ?>/logout.php">Logout</a>
<?php else: ?>
<a class="btn btn-outline-light btn-sm" href="<?php echo $base; ?>/login.php">Login</a>
<?php endif; ?>
</div>
</div>
</div>
</nav>
<main class="container py-4">