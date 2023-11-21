<?php

namespace App\Controllers;

use App\Models\Test;

class TestController extends Controller
{
    public function test($id)
    {
        $model = new Test();
        dump($model->findById($id));

        $this->view('test/test', compact('id'));
    }
}