<?php

namespace Shop\Controller;

use John\Frame\Response\Response;
use Shop\Model\ScaleModel;

class ScaleController extends MainController
{

    /**
     * Show all scales
     * @param ScaleModel $model
     * @return Response
     */
    public function show(ScaleModel $model):Response
    {
        $filters = $model->getFilterData();
        $price = $model->boundaryPrice();
        $goods = $model->getScales();
        $title = 'Весы';
        $additionalTitle = 'каталог весов';
        $prefix = $title;
        $page = 'scales';
        $good_route = 'scale_details';
        $product = 'scale';
        $data = compact('good_route','page','title', 'filters', 'price', 'goods', 'phones', 'product', 'prefix', 'additionalTitle');
        return $this->getRenderer($data, $model, 'show', 'mobileController');
    }

    /**
     * Show detail for some scale
     * @param $id
     * @param ScaleModel $model
     * @return Response
     */
    public function showDetails($id, ScaleModel $model): Response
    {
        $good = $model->getScale($id);
        $title = 'подробное описание весов ' . $good['название'];
        $back_route['name'] = 'scales';
        $product = 'scale';
        $back_route['title'] = 'весы';
        $back_route['description'] = 'весы';
        $data = compact('good', 'product', 'title', 'back_route');
        return $this->getRenderer($data, $model, 'showDetails', 'mobileController');
    }

}