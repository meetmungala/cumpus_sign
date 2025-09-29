<?php
require_once __DIR__ . '/../config/auth.php';
require_login(['mentor']);
$user = current_user();
?>
require_once __DIR__ . '/../templates/header.php';
?>
<div class="container">
	<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
		<h2 class="fw-bold mb-3 mb-md-0">Faculty Mentor</h2>
	</div>
	<div class="row g-4">
		<div class="col-md-6">
			<a class="dashboard-card card text-decoration-none h-100" href="<?php echo app_base_url(); ?>/mentor_approvals.php">
				<div class="card-body">
					<span class="dashboard-icon"><i class="fa-solid fa-user-check"></i></span>
					<h5 class="card-title">Approval Requests</h5>
					<p class="card-text">Approve student applications</p>
					<span class="dashboard-arrow"><i class="fa-solid fa-arrow-right"></i></span>
				</div>
			</a>
		</div>
		<div class="col-md-6">
			<a class="dashboard-card card text-decoration-none h-100" href="<?php echo app_base_url(); ?>/mentor_feedback.php?id=1">
				<div class="card-body">
					<span class="dashboard-icon"><i class="fa-solid fa-comments"></i></span>
					<h5 class="card-title">Feedback</h5>
					<p class="card-text">Submit post-internship feedback</p>
					<span class="dashboard-arrow"><i class="fa-solid fa-arrow-right"></i></span>
				</div>
			</a>
		</div>
	</div>
</div>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>