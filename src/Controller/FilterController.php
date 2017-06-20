<?php

namespace Shop\Controller;

use John\Frame\Response\Response;
use Shop\Model\FilterModel;
use Shop\Model\MobileModel;
use Shop\Model\ScaleModel;

class FilterController extends MainController
{

    /**
     * Get filtering data
     * @param $page
     * @param FilterModel $model
     * @param MobileModel $mobile
     * @param ScaleModel $scale
     * @return Response
     */
    public function showFilter($page, FilterModel $model, MobileModel $mobile, ScaleModel $scale):Response
    {
        $model->setTable($page);
        $filtersData = $model->getWithFilter($_POST);
        $checkedParameter = $model->getChecked($_POST);
        $price = array_pop($filtersData);
        $number = count($filtersData);
        $product = substr($page,0, strlen($page)-1);
        $good ='';
        $back_page['name'] = $page;
        if($page == 'mobiles') {
            $filters = $mobile->getFilterData();
            $good = 'mobile';
            $pageName = 'mobiles';
            $back_page['details'] = 'mob_phone_details';
            $back_page['description'] = 'Мобильные телефоны';
            $back_page['title'] = 'мобильных телефонов';
            $tovar = 'мобильный телефон';
        }
        if($page == 'scales') {
            $filters = $scale->getFilterData();
            $good = 'scale';
            $pageName = 'scales';
            $back_page['details'] = 'scale_details';
            $back_page['description'] = 'Весы';
            $back_page['title'] = 'весов';
            $tovar = 'весы';
        }
        $title = 'Фильтр товаров';
        $data = compact('product', 'tovar','back_page','title', 'filtersData', 'pageName', 'filters', 'checkedParameter', 'good' ,'price', 'number');
        return $this->getRenderer($data, $model);
    }

}