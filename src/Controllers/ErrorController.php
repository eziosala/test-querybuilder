<?php

namespace App\Controllers;

class ErrorController extends Controller
{
    public function error404()
    {
        $this->view('error/error404');
    }
}