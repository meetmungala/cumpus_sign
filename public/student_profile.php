<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['student']);
$me = current_user();
$pdo = DB::connect();
$year = (int)date('Y');
$st = $pdo->prepare('SELECT * FROM student_profiles WHERE user_id=?');
$st->execute([$me['id']]);
after_profile:
$profile = $st->fetch();
$locked = $profile && (int)($profile['semester_lock'] ?? 0) === $year;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$locked) {
$resume = trim($_POST['resume_url'] ?? '');
$cover = trim($_POST['cover_letter_url'] ?? '');
$skills = array_filter(array_map('trim', explode(',', $_POST['skills'] ?? '')));
$prefs = ['dept' => trim($_POST['pref_dept'] ?? ''), 'location' => trim($_POST['pref_location'] ?? '')];
if ($profile) {
$pdo->prepare('UPDATE student_profiles SET resume_url=?, cover_letter_url=?, skills=?, preferences=?, semester_lock=? WHERE user_id=?')->execute([$resume,$cover,json_encode(array_values($skills)),json_encode($prefs),$year,$me['id']]);
} else {
$pdo->prepare('INSERT INTO student_profiles (user_id, resume_url, cover_letter_url, skills, preferences, semester_lock) VALUES (?,?,?,?,?,?)')->execute([$me['id'],$resume,$cover,json_encode(array_values($skills)),json_encode($prefs),$year]);
}
redirect_to('student_profile.php');
}
include __DIR__ . '/../templates/header.php';
?>
<h3>My Profile</h3>
<?php if ($locked): ?><div class="alert alert-info">Profile locked for this semester (<?php echo $year; ?>).</div><?php endif; ?>
<form method="post">
<div class="mb-3"><label class="form-label">Resume URL</label><input class="form-control" name="resume_url" value="<?php echo htmlspecialchars($profile['resume_url'] ?? ''); ?>" <?php echo $locked?'disabled':''; ?>></div>
<div class="mb-3"><label class="form-label">Cover Letter URL</label><input class="form-control" name="cover_letter_url" value="<?php echo htmlspecialchars($profile['cover_letter_url'] ?? ''); ?>" <?php echo $locked?'disabled':''; ?>></div>
<div class="mb-3"><label class="form-label">Skills (comma separated)</label><input class="form-control" name="skills" value="<?php echo htmlspecialchars(isset($profile['skills'])? implode(',', json_decode($profile['skills'],true) ?: []):''); ?>" <?php echo $locked?'disabled':''; ?>></div>
<div class="mb-3"><label class="form-label">Preference - Department</label><input class="form-control" name="pref_dept" value="<?php echo htmlspecialchars(isset($profile['preferences']) ? (json_decode($profile['preferences'],true)['dept'] ?? '') : ''); ?>" <?php echo $locked?'disabled':''; ?>></div>
<div class="mb-3"><label class="form-label">Preference - Location</label><input class="form-control" name="pref_location" value="<?php echo htmlspecialchars(isset($profile['preferences']) ? (json_decode($profile['preferences'],true)['location'] ?? '') : ''); ?>" <?php echo $locked?'disabled':''; ?>></div>
<button class="btn btn-primary" <?php echo $locked?'disabled':''; ?>>Save (locks this semester)</button>
</form>
<?php include __DIR__ . '/../templates/footer.php'; ?>