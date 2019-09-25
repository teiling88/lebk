<?php declare(strict_types=1);

use SwagLebk\Repository\WeeklyReportRepository;

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/vendor/autoload.php';

$connection = new \SQLite3(__DIR__ . '/db/lebk.sqlite3');
$repository = new WeeklyReportRepository($connection);
