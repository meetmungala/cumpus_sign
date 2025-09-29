<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['admin','employer']);
$me = current_user();
$pdo = DB::connect();
$scope = $_GET['scope'] ?? 'all';
$where = '1=1';
$params = [];
if ($me['role'] === 'employer' || $scope === 'self') {
$where = 'posted_by = ?';
$params[] = $me['id'];
}
$stmt = $pdo->prepare("SELECT * FROM internships WHERE $where ORDER BY created_at DESC");
$stmt->execute($params);
$rows = $stmt->fetchAll();
include __DIR__ . '/../templates/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
<h3>Internships</h3>
<a class="btn btn-primary" href="<?php echo app_base_url(); ?>/internship_form.php">New</a>
</div>
<table class="table table-striped">
<thead>
<tr>
<th>Title</th><th>Dept</th><th>Stipend</th><th>Potential</th><th>Verified</th><th>Deadline</th><th></th>
</tr>
</thead>
<tbody>
<?php foreach ($rows as $r): ?>
<tr>
<td><?php echo htmlspecialchars($r['title']); ?></td>
<td><?php echo htmlspecialchars($r['department']); ?></td>
<td><?php echo htmlspecialchars($r['stipend']); ?></td>
<td><?php echo htmlspecialchars($r['placement_potential']); ?></td>
<td><?php echo $r['verified'] ? 'Yes' : 'No'; ?></td>
<td><?php echo htmlspecialchars($r['deadline']); ?></td>
<td class="text-nowrap">
<a class="btn btn-sm btn-outline-primary" href="<?php echo app_base_url(); ?>/internship_form.php?id=<?php echo $r['id']; ?>">Edit</a>
<?php if ($me['role'] === 'admin'): ?>
<a class="btn btn-sm btn-outline-success" href="<?php echo app_base_url(); ?>/internship_verify.php?id=<?php echo $r['id']; ?>&v=1">Verify</a>
<a class="btn btn-sm btn-outline-warning" href="<?php echo app_base_url(); ?>/internship_verify.php?id=<?php echo $r['id']; ?>&v=0">Unverify</a>
<?php endif; ?>
<a class="btn btn-sm btn-outline-danger" href="<?php echo app_base_url(); ?>/internship_delete.php?id=<?php echo $r['id']; }?>" onclick="return confirm('Delete?')">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php include __DIR__ . '/../templates/footer.php'; ?>