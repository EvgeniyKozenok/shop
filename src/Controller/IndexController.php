<?php

namespace Shop\Controller;

use John\Frame\Response\Response;

/**
 * Class IndexController
 * @package John\Frame\TestController
 */
class IndexController extends MainController
{
    /**
     * Index action
     * @return Response
     * @internal param MainModel $model
     */
    public function index(): Response
    {
        $title = 'Интернет магазин электроники, компьютерной техники';
        $data = compact('title');
        return $this->getRenderer($data, null);
    }
}