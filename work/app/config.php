<?php

define('DSN', 'mysql:host=localhost;dbname=daily_report;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/dev/daily-report/work/public/');

try {
    $pdo = new PDO(
        DSN,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}