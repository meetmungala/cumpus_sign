<?php
require_once __DIR__ . '/../config/auth.php';
require_login(['mentor']);
$user = current_user();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mentor Dashboard</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-3">
<h2>Faculty Mentor</h2>
<a class="btn btn-outline-secondary btn-sm" href="<?php echo app_base_url(); ?>/logout.php">Logout</a>
</div>
<div class="row g-3">
<div class="col-md-6">
<a class="card text-decoration-none" href="<?php echo app_base_url(); ?>/mentor_approvals.php">
<div class="card-body">
<h5 class="card-title">Approval Requests</h5>
<p class="card-text">Approve student applications</p>
</div>
</a>
</div>
<div class="col-md-6">
<a class="card text-decoration-none" href="<?php echo app_base_url(); ?>/mentor_feedback.php?id=1">
<div class="card-body">
<h5 class="card-title">Feedback</h5>
<p class="card-text">Submit post-internship feedback</p>
</div>
</a>
</div>
</div>
</div>
</body>
</html>