<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

function app_base_url() {
$cfg = require __DIR__ . '/config.php';
return rtrim($cfg['app']['base_url'] ?? '', '/');
}

function redirect_to($path) {
$base = app_base_url();
header('Location: ' . $base . '/' . ltrim($path, '/'));
exit;
}

function start_session() {
$cfg = require __DIR__ . '/config.php';
if (session_status() === PHP_SESSION_NONE) {
session_name($cfg['app']['session_name']);
session_start();
}
}

function require_login($roles = null) {
start_session();
if (!isset($_SESSION['user'])) {
redirect_to('login.php');
}
if ($roles && !in_array($_SESSION['user']['role'], (array)$roles, true)) {
http_response_code(403);
echo 'Forbidden';
exit;
}
}

function current_user() {
start_session();
return $_SESSION['user'] ?? null;
}

function login($email, $password) {
$pdo = DB::connect();
$st = $pdo->prepare('SELECT id, email, full_name, role, password_hash FROM users WHERE email = ?');
$st->execute([$email]);
$user = $st->fetch();
if (!$user) return false;
// Proto: match MySQL SHA2 seeding; can upgrade to password_hash later
if (hash('sha256', $password) !== $user['password_hash']) return false;
start_session();
$_SESSION['user'] = [
'id' => $user['id'],
'email' => $user['email'],
'full_name' => $user['full_name'],
'role' => $user['role'],
];
return true;
}

function logout() {
start_session();
$_SESSION = [];
session_destroy();
}