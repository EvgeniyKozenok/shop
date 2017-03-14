<?php

namespace Shop;

use john\frame\Response\RedirectResponse;

/**
 * Class IndexController
 * @package Shop
 */
class IndexController
{
    /**
     * Index action
     */
    public function index(){
        $response = new RedirectResponse('/good/1');
        return $response;
    }
}