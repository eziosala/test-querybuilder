<?php

namespace App\Controllers;

use App\Controllers\Controller;

class MainController extends Controller
{
    public function home()
    {
        return $this->view('home');
    }
}