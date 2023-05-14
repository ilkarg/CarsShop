<?php

// Подключение системных библиотек
include __DIR__ . '/app/PHPRouter/Router.php';
include __DIR__ . '/app/PHPOrm/SQLite.php';
include __DIR__ . '/app/PHPTemplater/Template.php';
include __DIR__ . '/app/PHPView/View.php';
include __DIR__ . '/app/PHPRequester/Request.php';
include __DIR__ . "/app/PHPHash/Hash.php";
include __DIR__ . '/app/PHPModel/Model.php';

// Подключение системных пространств имен
use PHPTemplater\Template;
use PHPRequester\Request;
use PHPRouter\Router;

// Создание системных объектов
$router = new Router();
$orm = new SQLite(__DIR__ . "/db/cars_shop.db");
$request = new Request();

// Подключение контроллеров
include __DIR__ . '/controllers/PageController.php';
include __DIR__ . '/controllers/AuthController.php';
include __DIR__ . '/controllers/LogicController.php';
include __DIR__ . '/controllers/QueryController.php';
include __DIR__ . '/controllers/PostController.php';

// Подключение файла с маршрутами
include __DIR__ . '/routes/web.php';

$router->exec();
