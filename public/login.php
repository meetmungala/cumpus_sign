<?php
require_once __DIR__ . '/../config/auth.php';
start_session();
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
if (login($email, $password)) {
$role = $_SESSION['user']['role'];
redirect_to("{$role}_dashboard.php");
} else {
$error = 'Invalid credentials';
}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container" style="max-width:420px;">
<h2 class="mb-3">Login</h2>
<?php if ($error): ?>
<div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form method="post">
<div class="mb-3">
<label class="form-label">Email</label>
<input name="email" type="email" class="form-control" required>
</div>
<div class="mb-3">
<label class="form-label">Password</label>
<input name="password" type="password" class="form-control" required>
</div>
<button class="btn btn-primary w-100" type="submit">Sign in</button>
</form>
</div>
</body>
</html>