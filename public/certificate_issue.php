<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['admin']);
$pdo = DB::connect();
$appId = (int)($_GET['id'] ?? 0);
if ($appId) {
$pdo->prepare('INSERT INTO certificates (application_id, issued_at) VALUES (?, NOW()) ON DUPLICATE KEY UPDATE issued_at=NOW()')->execute([$appId]);
}
redirect_to('admin_dashboard.php');