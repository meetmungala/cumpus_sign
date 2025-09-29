<?php
require_once __DIR__ . '/../config/auth.php';
require_login(['student']);
$user = current_user();

require_once __DIR__ . '/../templates/header.php';
?>
<div class="container">
	<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
		<h2 class="fw-bold mb-3 mb-md-0">Welcome, <?php echo htmlspecialchars($user['full_name']); ?></h2>
	</div>
	<div class="row g-4">
		<div class="col-md-4">
			<a class="dashboard-card card text-decoration-none h-100" href="<?php echo app_base_url(); ?>/student_profile.php">
				<div class="card-body">
					<span class="dashboard-icon"><i class="fa-solid fa-user-graduate"></i></span>
					<h5 class="card-title">My Profile</h5>
					<p class="card-text">Resume, cover letter, skills</p>
					<span class="dashboard-arrow"><i class="fa-solid fa-arrow-right"></i></span>
				</div>
			</a>
		</div>
		<div class="col-md-4">
			<a class="dashboard-card card text-decoration-none h-100" href="<?php echo app_base_url(); ?>/internships_browse.php">
				<div class="card-body">
					<span class="dashboard-icon"><i class="fa-solid fa-briefcase"></i></span>
					<h5 class="card-title">Find Internships</h5>
					<p class="card-text">Browse & one-click apply</p>
					<span class="dashboard-arrow"><i class="fa-solid fa-arrow-right"></i></span>
				</div>
			</a>
		</div>
		<div class="col-md-4">
			<a class="dashboard-card card text-decoration-none h-100" href="<?php echo app_base_url(); ?>/applications_student.php">
				<div class="card-body">
					<span class="dashboard-icon"><i class="fa-solid fa-file-lines"></i></span>
					<h5 class="card-title">Applications</h5>
					<p class="card-text">Status & interview schedule</p>
					<span class="dashboard-arrow"><i class="fa-solid fa-arrow-right"></i></span>
				</div>
			</a>
		</div>
	</div>
</div>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>