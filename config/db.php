<?php
class DB {
public static $pdo;
public static function connect() {
if (self::$pdo) return self::$pdo;
$cfg = require __DIR__ . '/config.php';
$dsn = 'mysql:host=' . $cfg['db']['host'] . ';port=' . $cfg['db']['port'] . ';dbname=' . $cfg['db']['database'] . ';charset=' . $cfg['db']['charset'];
self::$pdo = new PDO($dsn, $cfg['db']['username'], $cfg['db']['password'], [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
return self::$pdo;
}
}