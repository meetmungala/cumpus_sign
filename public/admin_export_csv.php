<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/db.php';
require_login(['admin']);
$pdo = DB::connect();
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="placement_stats.csv"');
$out = fopen('php://output', 'w');
fputcsv($out, ['Internship','Department','Applications']);
$st = $pdo->query("SELECT i.title, i.department, (SELECT COUNT(*) FROM applications a WHERE a.internship_id=i.id) apps FROM internships i WHERE verified=1 ORDER BY apps DESC");
while ($r = $st->fetch()) { fputcsv($out, [$r['title'],$r['department'],$r['apps']]); }
fclose($out);