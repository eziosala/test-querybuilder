<?php

namespace App\Controllers;

class Controller
{

    public function view(string $name, array $params = [])
    {
        global $router;

        $viewData['currentPage'] = $name;
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        extract($params);

        require_once __DIR__ . "./../Views/layout/header.tpl.php";
        require_once __DIR__ . "./../Views/{$name}.tpl.php";
        require_once __DIR__ . "./../Views/layout/footer.tpl.php";
    }
}