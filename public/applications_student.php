<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['student']);
$me = current_user();
$pdo = DB::connect();
$st = $pdo->prepare('SELECT a.*, i.title, i.department, i.location FROM applications a JOIN internships i ON a.internship_id=i.id WHERE a.student_id=? ORDER BY a.applied_at DESC');
$st->execute([$me['id']]);
$rows = $st->fetchAll();
include __DIR__ . '/../templates/header.php';
?>
<h3>My Applications</h3>
<table class="table">
<thead><tr><th>Internship</th><th>Status</th><th>Applied</th></tr></thead>
<tbody>
<?php foreach ($rows as $r): ?>
<tr>
<td><?php echo htmlspecialchars($r['title']); ?> (<?php echo htmlspecialchars($r['department']); ?>)</td>
<td><?php echo htmlspecialchars($r['status']); ?></td>
<td><?php echo htmlspecialchars($r['applied_at']); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php include __DIR__ . '/../templates/footer.php'; ?>