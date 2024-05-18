<?php

namespace Me\Task7\Controllers;
use Me\Task7\Viewer;
class LoginController
{
    /**
     * @return void
     * Ця функція відповідає за відображення сторінки входу
     */
    public function index(): void
    {
        $page = 'login';
        $title = 'Login Page';


        $view = new Viewer(
            [

                'page' => $page,
                'title' => $title
            ]
        );

        $view->render();
    }

     public function auth(): void
    {
        if(!isset($_POST['login'])) {
            header('Location: /login');
            exit;
        }

        $login = $_POST['login'] ?? '';
        $name = $_POST['name'] ?? '';

        if ($login === '1234' && $name === 'Test') {
            $_SESSION['name'] = $name;
            $_SESSION['login'] = $login;
            header('Location: /home');

        } else {

            header('Location: /login');
        }
        exit;
    }
}