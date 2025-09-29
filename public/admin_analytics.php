<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['admin']);
$pdo = DB::connect();
$open = $pdo->query('SELECT COUNT(*) c FROM internships WHERE verified=1 AND (deadline IS NULL OR deadline>=CURRENT_DATE())')->fetch()['c'] ?? 0;
$unplaced = $pdo->query("SELECT COUNT(*) c FROM users u WHERE role='student' AND NOT EXISTS (SELECT 1 FROM applications a WHERE a.student_id=u.id AND a.status IN ('offer'))")->fetch()['c'] ?? 0;
$upcoming = $pdo->query("SELECT COUNT(*) c FROM interviews WHERE schedule_at>=NOW()")->fetch()['c'] ?? 0;
$top = $pdo->query("SELECT department, COUNT(*) c FROM internships WHERE verified=1 GROUP BY department ORDER BY c DESC LIMIT 5")->fetchAll();
include __DIR__ . '/../templates/header.php';
?>
<h3>Analytics</h3>
<div class="row g-3 mb-3">
<div class="col-md-4"><div class="card"><div class="card-body"><div class="h5">Open Positions</div><div class="display-6"><?php echo (int)$open; ?></div></div></div></div>
<div class="col-md-4"><div class="card"><div class="card-body"><div class="h5">Unplaced Students</div><div class="display-6"><?php echo (int)$unplaced; ?></div></div></div></div>
<div class="col-md-4"><div class="card"><div class="card-body"><div class="h5">Upcoming Interviews</div><div class="display-6"><?php echo (int)$upcoming; ?></div></div></div></div>
</div>
<h5>Top Departments</h5>
<table class="table table-sm"><thead><tr><th>Department</th><th>Posts</th></tr></thead><tbody>
<?php foreach ($top as $r): ?><tr><td><?php echo htmlspecialchars($r['department']); ?></td><td><?php echo (int)$r['c']; ?></td></tr><?php endforeach; ?>
</tbody></table>
<a class="btn btn-outline-secondary" href="<?php echo app_base_url(); ?>/admin_export_csv.php">Export CSV</a>
<?php include __DIR__ . '/../templates/footer.php'; ?>