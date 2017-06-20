<?php

namespace Shop\Controller;


class LogoutController extends MainController
{
    public function logout(){
        unset($_SESSION['logged_user']);
        return $this->getRenderer([],null, 'index', 'indexController');
    }
}