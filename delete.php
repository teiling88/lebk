<?php declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

$reportId = (int) $_GET['id'];

$repository->deleteById($reportId);

header('Location: index.php');
