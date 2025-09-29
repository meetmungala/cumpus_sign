<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['student','admin']);
$pdo = DB::connect();
$id = (int)($_GET['id'] ?? 0);
$st = $pdo->prepare('SELECT c.*, i.title, u.full_name FROM certificates c JOIN applications a ON c.application_id=a.id JOIN internships i ON a.internship_id=i.id JOIN users u ON a.student_id=u.id WHERE c.id=?');
$st->execute([$id]);
$c = $st->fetch();
include __DIR__ . '/../templates/header.php';
?>
<h3>Certificate</h3>
<?php if ($c): ?>
<p>Student: <strong><?php echo htmlspecialchars($c['full_name']); ?></strong></p>
<p>Internship: <strong><?php echo htmlspecialchars($c['title']); ?></strong></p>
<p>Issued: <strong><?php echo htmlspecialchars($c['issued_at']); ?></strong></p>
<div class="alert alert-success">This is a prototype digital certificate record.</div>
<?php else: ?>
<div class="alert alert-warning">Not found.</div>
<?php endif; ?>
<?php include __DIR__ . '/../templates/footer.php'; ?>