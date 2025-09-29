<?php
require_once __DIR__ . '/../config/auth.php';
start_session();
$user = current_user();
if ($user) {
$role = $user['role'];
redirect_to("{$role}_dashboard.php");
}

require_once __DIR__ . '/../templates/header.php';
?>
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height:60vh;">
	<h1 class="display-4 fw-bold mb-3 text-center">Campus Internship & Placement Portal</h1>
	<p class="lead text-center mb-4" style="max-width: 500px;">A modern platform for students, employers, mentors, and admins to manage internships, placements, and certificates efficiently.</p>
	<a class="btn btn-warning btn-lg px-5" href="<?php echo app_base_url(); ?>/login.php">Login</a>
</div>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>