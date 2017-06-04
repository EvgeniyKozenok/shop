<?php

namespace Shop\Controller;

use John\Frame\Controller\BaseController;
use John\Frame\Response\RedirectResponse;
use John\Frame\Response\Response;

/**
 * Class IndexController
 * @package Shop\Controller
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