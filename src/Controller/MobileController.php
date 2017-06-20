<?php

namespace Shop\Controller;

use John\Frame\Response\Response;
use Shop\Model\MobileModel;

class MobileController extends MainController
{

    /**
     * Show all mobiles
     * @param MobileModel $model
     * @return Response
     */
    public function show(MobileModel $model):Response
    {
        $filters = $model->getFilterData();
        $price = $model->boundaryPrice();
        $goods = $model->getPhones();
        $title = 'Мобильные телефоны';
        $additionalTitle = "каталог мобильных телефонов";
        $prefix = 'Мобильный телефон';
        $product = 'mobile';
        $page = 'mobiles';
        $good_route = 'mob_phone_details';
        $data = compact('good_route','page','title', 'filters', 'price', 'goods', 'product', 'prefix', 'additionalTitle');
        return $this->getRenderer($data, $model, 'show');
    }

    /**
     * Show detail for some mobile
     * @param $id
     * @param MobileModel $model
     * @return Response
     */
    public function showDetails($id, MobileModel $model): Response
    {
        $good = $model->getPhone($id);
        $title = 'подробное описание телефона ' . $good['название'];
        $product = 'mobile';
        $back_route['name'] = 'mobiles';
        $back_route['title'] = 'мобильные телефон';
        $back_route['description'] = 'мобильный телефон';
        $data = compact('good', 'title', 'back_route', 'product');
        return $this->getRenderer($data, $model);
    }

}