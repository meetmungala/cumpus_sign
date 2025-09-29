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
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height:70vh; background: linear-gradient(120deg, #e3f0ff 60%, #f8f9fa 100%);">
	<div class="card shadow-lg p-4 border-0" style="max-width: 400px; width: 100%; border-radius: 1.2rem;">
		<div class="text-center mb-3">
			<span style="font-size:2.5rem; color:#0d6efd;"><i class="fa-solid fa-user-lock"></i></span>
		</div>
		<h2 class="mb-3 text-center fw-bold">Login</h2>
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
			<button class="btn btn-warning w-100 fw-semibold" type="submit">Sign in</button>
		</form>
	</div>
</div>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>