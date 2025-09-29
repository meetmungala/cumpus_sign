<?php
require_once __DIR__ . '/../config/auth.php';
start_session();
$user = current_user();
if ($user) {
$role = $user['role'];
redirect_to("{$role}_dashboard.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Campus Sign</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
<h1>Campus Internship & Placement</h1>
<a class="btn btn-primary" href="<?php echo app_base_url(); ?>/login.php">Login</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>