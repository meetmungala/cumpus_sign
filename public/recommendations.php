<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['student']);
$me = current_user();
$pdo = DB::connect();
$sp = $pdo->prepare('SELECT skills, preferences FROM student_profiles WHERE user_id=?');
$sp->execute([$me['id']]);
$prof = $sp->fetch();
$skills = $prof && $prof['skills'] ? json_decode($prof['skills'],true) : [];
$deptPref = $prof && $prof['preferences'] ? (json_decode($prof['preferences'],true)['dept'] ?? '') : '';
$rows = $pdo->query("SELECT * FROM internships WHERE verified=1 ORDER BY created_at DESC LIMIT 100")->fetchAll();
function score_row($row, $skills, $deptPref) {
$tags = $row['competency_tags'] ? json_decode($row['competency_tags'],true) : [];
$overlap = count(array_intersect(array_map('strtolower',$skills), array_map('strtolower',$tags)));
$deptScore = ($deptPref && strtolower($deptPref) === strtolower($row['department'])) ? 1 : 0;
return $overlap*2 + $deptScore;
}
usort($rows, function($a,$b) use ($skills,$deptPref){ return score_row($b,$skills,$deptPref) <=> score_row($a,$skills,$deptPref); });
include __DIR__ . '/../templates/header.php';
?>
<h3>Recommended for You</h3>
<div class="row g-3">
<?php foreach ($rows as $r): $s=score_row($r,$skills,$deptPref); if ($s<=0) continue; ?>
<div class="col-md-6">
<div class="card h-100">
<div class="card-body">
<div class="d-flex justify-content-between"><h5 class="card-title"><?php echo htmlspecialchars($r['title']); ?></h5><span class="badge bg-info">Score <?php echo $s; ?></span></div>
<p class="text-muted mb-1"><?php echo htmlspecialchars($r['department']); ?> � <?php echo htmlspecialchars($r['location']); ?></p>
<p><?php echo nl2br(htmlspecialchars(substr($r['description'],0,160))); ?>...</p>
<a class="btn btn-primary" href="<?php echo app_base_url(); ?>/internship_apply.php?id=<?php echo $r['id']; ?>">Apply</a>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>