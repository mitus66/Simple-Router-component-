# Simple-Router-component-

Элементарный компонент роутинга страниц

1. В основной папке проекта создается файл .htaccess с директивами:
  RewriteEngine on
  RewriteRule ^(.+)?$ /public/$1
он служит для перенаправления пользователя в папку public/index.php, который является точкой входа

2. В основной папке public создается файл .htaccess с директивами:
  RewriteBase /
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule . index.php
он служит для перенаправления пользователя в папку public/index.php, который является точкой входа

3. Файл public/index.php 
3.1. подключаем файл настроек с разрешенными для промотра страницами
require __DIR__ . '/../components/router/settings.php';

3.2. подключаем компонент роутера
require __DIR__ . '/../components/router/Router.php';

3.3. Получает, что запросил Пользователь
$route = $_SERVER['REQUEST_URI'];

3.4. сравнивает запрашиваемую страницу со списком разрашенных
и делает соответствующее перенаправление
new Router($route, $legalPages);

4. Файл /components/router/settings.php содержит массив с разрешенніми для просмотра страницами:
Например,
$legalPages = [
    '/' => 'controllers/home.php',
    '/404' => 'controllers/404.php',
    '/about' => 'controllers/about.php',
    '/users' => 'controllers/users.php',
    '/posts' => 'controllers/posts.php'
];

5. Файл роутера /components/router/Router.php является классом и содержит объекты и конструктор
/*
 * string $route
 * array $legalPages
 * return include string
 */
class Router
{
    public $route;
    public $legalPages;

    public function __construct($route, $legalPages)
    {
        $this->route = $route;
        $this->legalPages = $legalPages;

        // если его запрос в списке разрешенных, подключаем его к этой странице
        if(array_key_exists($route, $legalPages)) {
            $pageController = __DIR__ . '/../../' . $legalPages[$route];
            include $pageController;
            exit;
        } else {
            // иначе - подключаем к странице 404
            $pageController = __DIR__ . '/../../' . $legalPages['/404'];
            include $pageController;
        }
    }
}
