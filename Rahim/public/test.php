<?php

$legalPages = [
    '/' => 'controllers/home.php',
    '/404' => 'controllers/404.php',
    '/about' => 'controllers/about.php',
    '/users' => 'controllers/users.php',
    '/posts' => 'controllers/posts.php'
];
// Проверяем, что запросил Гость
$route = $_SERVER['REQUEST_URI'];

function router($route, $legalPages)
{
    // если его запрос в списке разрешенных, подключаем его
    if(array_key_exists($route, $legalPages)) {
        $pageController = __DIR__ . '/../' . $legalPages[$route];
        include $pageController;
        exit;
    } else {
        // если иначе - переадрессовываем на страницу 404
        $pageController = __DIR__ . '/../' . $legalPages['/404'];
        include $pageController;
    }
//    return $pageController;
}

router($route, $legalPages);
//require __DIR__ . '/../components/router/settings.php';
//require __DIR__ . '/../components/router/Router.php';
////$path = '';
////$path = new Router($route, $legalPages);