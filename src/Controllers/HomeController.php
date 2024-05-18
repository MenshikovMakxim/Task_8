<?php

namespace Me\Task7\Controllers;

use Me\Task7\Viewer;

class HomeController
{
    public function index(): void
    {
        $page = 'home';
        $title = 'Home';
        $content = 'Головна';
        $data = [

        ];
        $view = new Viewer([
            'page' => $page,
            'title' => $title,
            'content' => $content,
            'data' => $data,
        ]);

        $view->render();
    }
}