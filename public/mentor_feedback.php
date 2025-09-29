<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['mentor']);
$pdo = DB::connect();
$appId = (int)($_GET['id'] ?? 0);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$fb = trim($_POST['feedback'] ?? '');
$pdo->prepare('UPDATE applications SET feedback=?, updated_at=NOW() WHERE id=?')->execute([$fb,$appId]);
redirect_to('mentor_approvals.php');
}
include __DIR__ . '/../templates/header.php';
?>
<h3>Mentor Feedback</h3>
<form method="post">
<div class="mb-3">
<label class="form-label">Feedback</label>
<textarea class="form-control" rows="6" name="feedback"></textarea>
</div>
<button class="btn btn-primary">Save</button>
</form>
<?php include __DIR__ . '/../templates/footer.php'; ?>