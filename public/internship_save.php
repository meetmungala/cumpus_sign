<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['admin','employer']);
$me = current_user();
$pdo = DB::connect();
$id = (int)($_POST['id'] ?? 0);
$title = trim($_POST['title'] ?? '');
$department = trim($_POST['department'] ?? '');
$stipend = strlen($_POST['stipend'] ?? '') ? (int)$_POST['stipend'] : null;
$placement = $_POST['placement_potential'] ?? 'medium';
$location = trim($_POST['location'] ?? '');
$deadline = $_POST['deadline'] ?? null;
$tags = array_filter(array_map('trim', explode(',', $_POST['tags'] ?? '')));
$desc = trim($_POST['description'] ?? '');
$verified = $me['role'] === 'admin' ? 1 : 0;
if ($id) {
$st = $pdo->prepare('UPDATE internships SET title=?, description=?, department=?, competency_tags=?, stipend=?, placement_potential=?, location=?, deadline=? WHERE id=?');
$st->execute([$title,$desc,$department,json_encode(array_values($tags)),$stipend,$placement,$location,$deadline,$id]);
} else {
$st = $pdo->prepare('INSERT INTO internships (title, description, department, competency_tags, stipend, placement_potential, posted_by, posted_by_role, verified, location, deadline) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
$st->execute([$title,$desc,$department,json_encode(array_values($tags)),$stipend,$placement,$me['id'],$me['role'],$verified,$location,$deadline]);
$id = (int)$pdo->lastInsertId();
}
redirect_to('internships_admin.php');