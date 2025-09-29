<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['admin']);
$pdo = DB::connect();
$id = (int)($_GET['id'] ?? 0);
$v = (int)($_GET['v'] ?? 1);
if ($id) {
$pdo->prepare('UPDATE internships SET verified=? WHERE id=?')->execute([$v,$id]);
}
redirect_to('internships_admin.php');