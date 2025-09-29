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
require_once __DIR__ . '/../templates/header.php';
?>
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height:60vh;">
	<div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
		<h2 class="mb-3 text-center">Login</h2>
		<?php if ($error): ?>
			<div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
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
			<button class="btn btn-warning w-100" type="submit">Sign in</button>
		</form>
	</div>
</div>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>