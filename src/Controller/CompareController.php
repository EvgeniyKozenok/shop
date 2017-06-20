<?php

namespace Shop\Controller;

use Shop\Model\CompareModel;

/**Compare products
 * Class CompareController
 * @package Shop\Controller
 */
class CompareController extends MainController
{
    public function compareProduct($name, CompareModel $model){
        $model->setTable($name . 's');
        $product = $name;
        $back_page['name'] = $name . 's';
        if($name == 'mobile'){
            $back_page['title'] = 'Мобильные телефоны';
        }
        if($name == 'scale'){
            $back_page['title'] = 'Весы';
        }
        $goods = $model->getCompareGoods($_POST);
        $number = count($goods);
        $title = 'Сравнить продукты';
        $data = compact('title', 'goods', 'number', 'product', 'back_page');
        return $this->getRenderer($data, $model);
    }

}