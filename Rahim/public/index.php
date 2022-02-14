<?php
// подключаем файл настроек с разрешенными для промотра страницами
require __DIR__ . '/../components/router/settings.php';

// подключаем компонент роутера
require __DIR__ . '/../components/router/Router.php';

// Получаем, что запросил Пользователь
$route = $_SERVER['REQUEST_URI'];

// сравниваем запрашиваемую страницу со списком разрашенных
// и делаем соответствующее перенаправление
new Router($route, $legalPages);