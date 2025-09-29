<?php
require_once __DIR__ . '/../config/auth.php';
require_login(['employer']);
$user = current_user();
?>
require_once __DIR__ . '/../templates/header.php';
?>
<div class="container">
	<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
		<h2 class="fw-bold mb-3 mb-md-0">Recruiter/Employer</h2>
	</div>
	<div class="row g-4">
		<div class="col-md-6">
			<a class="dashboard-card card text-decoration-none h-100" href="<?php echo app_base_url(); ?>/internship_form.php">
				<div class="card-body">
					<span class="dashboard-icon"><i class="fa-solid fa-plus"></i></span>
					<h5 class="card-title">Post Internship</h5>
					<p class="card-text">Pending admin verification</p>
					<span class="dashboard-arrow"><i class="fa-solid fa-arrow-right"></i></span>
				</div>
			</a>
		</div>
		<div class="col-md-6">
			<a class="dashboard-card card text-decoration-none h-100" href="<?php echo app_base_url(); ?>/internships_admin.php?scope=self">
				<div class="card-body">
					<span class="dashboard-icon"><i class="fa-solid fa-users"></i></span>
					<h5 class="card-title">Applicants</h5>
					<p class="card-text">Review profiles (limited data)</p>
					<span class="dashboard-arrow"><i class="fa-solid fa-arrow-right"></i></span>
				</div>
			</a>
		</div>
	</div>
</div>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>