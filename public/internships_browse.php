<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['student']);
$me = current_user();
$pdo = DB::connect();
$q = trim($_GET['q'] ?? '');
$dept = trim($_GET['dept'] ?? '');
$sql = "SELECT i.*, (SELECT COUNT(*) FROM applications a WHERE a.internship_id=i.id AND a.student_id=?) as applied FROM internships i WHERE verified=1";
$params = [$me['id']];
if ($q !== '') { $sql .= " AND (i.title LIKE ? OR i.description LIKE ?)"; $params[] = "%$q%"; $params[] = "%$q%"; }
if ($dept !== '') { $sql .= " AND i.department = ?"; $params[] = $dept; }
$sql .= ' ORDER BY created_at DESC';
$st = $pdo->prepare($sql);
$st->execute($params);
$rows = $st->fetchAll();
include __DIR__ . '/../templates/header.php';
?>
<h3>Browse Internships</h3>
<form class="row g-2 mb-3">
<div class="col-md-6"><input class="form-control" name="q" placeholder="Search" value="<?php echo htmlspecialchars($q); ?>"></div>
<div class="col-md-3"><input class="form-control" name="dept" placeholder="Department" value="<?php echo htmlspecialchars($dept); ?>"></div>
<div class="col-md-3"><button class="btn btn-outline-primary w-100">Filter</button></div>
</form>
<div class="row g-3">
<?php foreach ($rows as $r): ?>
<div class="col-md-6">
<div class="card h-100">
<div class="card-body">
<h5 class="card-title"><?php echo htmlspecialchars($r['title']); ?></h5>
<p class="text-muted mb-1"><?php echo htmlspecialchars($r['department']); ?> � <?php echo htmlspecialchars($r['location']); ?></p>
<p class="card-text"><?php echo nl2br(htmlspecialchars(substr($r['description'],0,180))); ?>...</p>
<?php if ($r['applied']>0): ?>
<span class="badge bg-success">Applied</span>
<?php else: ?>
<a class="btn btn-primary" href="<?php echo app_base_url(); ?>/internship_apply.php?id=<?php echo $r['id']; ?>">One-click Apply</a>
<?php endif; ?>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>