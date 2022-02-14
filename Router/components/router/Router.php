<?php
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