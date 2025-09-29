<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['mentor']);
$me = current_user();
$pdo = DB::connect();
if (isset($_GET['approve'])) {
$appId = (int)$_GET['approve'];
$pdo->prepare("UPDATE applications SET status='approved', mentor_id=? , updated_at=NOW() WHERE id=?")->execute([$me['id'],$appId]);
redirect_to('mentor_approvals.php');
}
$rows = $pdo->query("SELECT a.id, a.status, u.full_name as student, i.title FROM applications a JOIN users u ON a.student_id=u.id JOIN internships i ON a.internship_id=i.id WHERE a.status='applied' ORDER BY a.applied_at ASC")->fetchAll();
include __DIR__ . '/../templates/header.php';
?>
<h3>Approval Requests</h3>
<table class="table">
<thead><tr><th>Student</th><th>Internship</th><th>Status</th><th></th></tr></thead>
<tbody>
<?php foreach ($rows as $r): ?>
<tr>
<td><?php echo htmlspecialchars($r['student']); ?></td>
<td><?php echo htmlspecialchars($r['title']); ?></td>
<td><?php echo htmlspecialchars($r['status']); ?></td>
<td><a class="btn btn-sm btn-success" href="<?php echo app_base_url(); ?>/mentor_approvals.php?approve=<?php echo $r['id']; ?>">Approve</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php include __DIR__ . '/../templates/footer.php'; ?>