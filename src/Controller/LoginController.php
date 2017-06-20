<?php


namespace Shop\Controller;

use Shop\Model\MainModel;

class LoginController extends MainController
{

    public function login(MainModel $model) {
        $user = $model->findUser($_POST);
        if(!$user) {
            $title = 'Авторизация';
            $error = 'Неверная комбинация email и пароля';
            $data = compact('title', 'error');
            return $this->getRenderer($data, 'default');
        }
        $data = compact('pageName');
        $_SESSION['logged_user'] = $user['id'];
        return $this->getRenderer($data, $model, 'index', 'indexController');
    }

}