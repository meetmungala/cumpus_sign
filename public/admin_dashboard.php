<?php
require_once __DIR__ . '/../config/auth.php';
require_login(['admin']);
$user = current_user();
?>
require_once __DIR__ . '/../templates/header.php';
?>
<div class="container">
	<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
		<h2 class="fw-bold mb-3 mb-md-0">Placement Cell Dashboard</h2>
	</div>
	<div class="row g-4">
		<div class="col-md-3">
			<a class="dashboard-card card text-decoration-none h-100" href="<?php echo app_base_url(); ?>/internship_form.php">
				<div class="card-body">
					<span class="dashboard-icon"><i class="fa-solid fa-plus"></i></span>
					<h5 class="card-title">Post Internship</h5>
					<p class="card-text">Verified opportunities</p>
					<span class="dashboard-arrow"><i class="fa-solid fa-arrow-right"></i></span>
				</div>
			</a>
		</div>
		<div class="col-md-3">
			<a class="dashboard-card card text-decoration-none h-100" href="<?php echo app_base_url(); ?>/mentor_approvals.php">
				<div class="card-body">
					<span class="dashboard-icon"><i class="fa-solid fa-users"></i></span>
					<h5 class="card-title">Manage Applications</h5>
					<p class="card-text">Approvals & interviews</p>
					<span class="dashboard-arrow"><i class="fa-solid fa-arrow-right"></i></span>
				</div>
			</a>
		</div>
		<div class="col-md-3">
			<a class="dashboard-card card text-decoration-none h-100" href="<?php echo app_base_url(); ?>/admin_analytics.php">
				<div class="card-body">
					<span class="dashboard-icon"><i class="fa-solid fa-chart-line"></i></span>
					<h5 class="card-title">Analytics</h5>
					<p class="card-text">Open positions & unplaced</p>
					<span class="dashboard-arrow"><i class="fa-solid fa-arrow-right"></i></span>
				</div>
			</a>
		</div>
		<div class="col-md-3">
			<a class="dashboard-card card text-decoration-none h-100" href="<?php echo app_base_url(); ?>/admin_export_csv.php">
				<div class="card-body">
					<span class="dashboard-icon"><i class="fa-solid fa-file-csv"></i></span>
					<h5 class="card-title">Export</h5>
					<p class="card-text">Reports & CSV</p>
					<span class="dashboard-arrow"><i class="fa-solid fa-arrow-right"></i></span>
				</div>
			</a>
		</div>
	</div>
</div>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>