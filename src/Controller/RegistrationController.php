<?php

namespace Shop\Controller;

use John\Frame\Response\RedirectResponse;
use Shop\Model\RegistrationModel;

class RegistrationController extends MainController
{

    public function showForm(){
        return $this->getRenderer(['title' => 'Регистрационная форма']);
    }

    public function addUser(RegistrationModel $model){
//        $data = $_POST;
        $title = 'Форма регистрации';
        $result = $model->doRegistarte($_POST);
        if(isset($result['errors'])) {
            array_shift($result);

            $errors = compact('title', 'data', 'result');
            return $this->getRenderer($errors, $model,'showForm');
        }
        var_dump($_POST);

        $user = $model->findUser($_POST);
        $title = 'Интернет магазин электроники, компьютерной техники';
        $data = compact('title');
        $_SESSION['logged_user'] = $user['id'];
        return $this->getRenderer($data, $model, 'index', 'indexController');
    }
}