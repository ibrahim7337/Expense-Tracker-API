<?php

use Dotenv\Dotenv;
use Helpers\Router;

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/api.php';

Router::dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();