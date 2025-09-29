<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['admin','employer']);
$me = current_user();
$pdo = DB::connect();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$data = ['title'=>'','description'=>'','department'=>'','competency_tags'=>'[]','stipend'=>'','placement_potential'=>'medium','location'=>'','deadline'=>''];
if ($id) {
$st = $pdo->prepare('SELECT * FROM internships WHERE id=?');
$st->execute([$id]);
$data = $st->fetch() ?: $data;
}
include __DIR__ . '/../templates/header.php';
?>
<h3><?php echo $id ? 'Edit' : 'Create'; ?> Internship</h3>
<form method="post" action="<?php echo app_base_url(); ?>/internship_save.php">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="mb-3">
<label class="form-label">Title</label>
<input class="form-control" name="title" required value="<?php echo htmlspecialchars($data['title']); ?>">
</div>
<div class="mb-3">
<label class="form-label">Department</label>
<input class="form-control" name="department" required value="<?php echo htmlspecialchars($data['department']); ?>">
</div>
<div class="mb-3">
<label class="form-label">Stipend</label>
<input class="form-control" name="stipend" type="number" value="<?php echo htmlspecialchars($data['stipend']); ?>">
</div>
<div class="mb-3">
<label class="form-label">Placement Potential</label>
<select class="form-select" name="placement_potential">
<?php foreach (['low','medium','high'] as $opt): ?>
<option value="<?php echo $opt; ?>" <?php echo $data['placement_potential']===$opt?'selected':''; ?>><?php echo ucfirst($opt); ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="mb-3">
<label class="form-label">Location</label>
<input class="form-control" name="location" value="<?php echo htmlspecialchars($data['location']); ?>">
</div>
<div class="mb-3">
<label class="form-label">Deadline</label>
<input class="form-control" name="deadline" type="date" value="<?php echo htmlspecialchars($data['deadline']); ?>">
</div>
<div class="mb-3">
<label class="form-label">Competency Tags (comma separated)</label>
<input class="form-control" name="tags" value="<?php echo htmlspecialchars(trim(implode(',', json_decode($data['competency_tags'] ?: '[]', true) ?: []))); ?>">
</div>
<div class="mb-3">
<label class="form-label">Description</label>
<textarea class="form-control" rows="6" name="description" required><?php echo htmlspecialchars($data['description']); ?></textarea>
</div>
<button class="btn btn-primary">Save</button>
</form>
<?php include __DIR__ . '/../templates/footer.php'; ?>