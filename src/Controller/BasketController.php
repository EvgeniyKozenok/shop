<?php

namespace Shop\Controller;

use Shop\Model\MainModel;

class BasketController extends MainController
{

    public function show(MainModel $model){

        $products = json_decode($_POST['id'],true);
        $title = 'Корзина';
        $message = 'ваша корзина пуста!';
        if(count($products)>2){
            $productsCount = $products['count'];
            $productsSum = $products['price'];
            unset( $products['count']);
            unset( $products['price']);
            $id = [];
            $number = [];
            foreach ($products as $key => $value) {
                $k = explode(':', $key);
                if(!isset($id[$k[0]])){
                    $id[$k[0]] = [];
                    $number[$k[0]] = [];
                }
                $number[$k[0]][$k[1]] = $value;
                array_push($id[$k[0]], $k[1]);
            }
            $products = [];
            foreach ($id as $table => $idArray) {
                $id = $model->getAllById($idArray, $table . 's');
                array_push($products,$id);
            }
            $goods = [];
            for ($i=0; $i<count($products); $i++){
                foreach ($number as $key => $value) {
                    if (count($products[$i])==count($value)){
                        if(empty($goods[$key])) {
                            $goods[$key] = $products[$i];
                            break;
                        }
                    }
                }
            }
            $data = compact('goods', 'number', 'productsCount', 'productsSum', 'title');
        } else {
            $data = compact('title', 'message');
        }
        return $this->getRenderer($data, $model);
    }

    public function order(){
        $title = 'Заказ оформлен';
        $message = 'вы можете забрать свой заказ по адрессу... Оплата при получении';
        $data = compact('title', 'message');
        return $this->getRenderer($data, null,'index', 'indexController');
    }

}