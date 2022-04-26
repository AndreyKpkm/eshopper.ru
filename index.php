<?php

// FRONT CONTROLLER

// 1. Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (isset($_SESSION['lang'])) {
    $_SESSION['lang'] = "en";
}

// 2. Подключение файлов системы. // 3. Установка соедниения с БД.
define('ROOT', __DIR__);
require_once(ROOT . '/components/Autoload.php');

// 4. Вызов Router
$router = new Router();
$router->run();