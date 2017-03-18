<?php

namespace Shop\Controller;

use john\frame\Controller\BaseController;
use john\frame\Response\RedirectResponse;
use john\frame\Response\Response;

/**
 * Class IndexController
 * @package john\frame\TestController
 */
class IndexController extends BaseController
{
    /**
     * Index action
     */
    public function index():Response
    {
        $this->response = new RedirectResponse('/good/1');
        return $this->response;
    }
}