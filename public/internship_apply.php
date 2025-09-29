<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['student']);
$me = current_user();
$pdo = DB::connect();
$id = (int)($_GET['id'] ?? 0);
if ($id) {
try {
$st = $pdo->prepare('INSERT INTO applications (internship_id, student_id) VALUES (?,?)');
$st->execute([$id,$me['id']]);
} catch (Exception $e) {}
}
redirect_to('applications_student.php');