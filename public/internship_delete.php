<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['admin','employer']);
$me = current_user();
$pdo = DB::connect();
$id = (int)($_GET['id'] ?? 0);
if ($id) {
if ($me['role'] === 'admin') {
$pdo->prepare('DELETE FROM internships WHERE id=?')->execute([$id]);
} else {
$pdo->prepare('DELETE FROM internships WHERE id=? AND posted_by=?')->execute([$id,$me['id']]);
}
}
redirect_to('internships_admin.php');