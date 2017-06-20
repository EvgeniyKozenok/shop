<?php

namespace Shop\Model;

class ScaleModel extends MainModel
{
    protected $table = 'scales';

    /**
     * Function get filter data for scale
     * @return array of filters
     */
    public function getFilterData(){
        $searchCharacteristics = [
            'brand' => 'бренд',
            'weight' => 'Максимальный измеряемый вес',
            'construction' => 'тип',
        ];
        return $this->getFilters($searchCharacteristics, null);
    }

    public function getScales(){
        return $this->getProducts();
    }

    /**
     * Get info for describing phone
     * @param int $id
     * @return array
     */
    public function getScale(int $id): array
    {
        $rewriteKey = [
            'weight' => 'максимальный вес, кг',
            'construction' => 'вид',
            'error' => 'Погрешность измерения, г',
            'ram' => 'Память (количество пользователей)',
            'onoff' => 'Автоматическое включение/выключение',
            'color' => 'цвет',
            'material' => 'материал',
            'batery' => 'Питание'
        ];
        return $this->getOneProduct($id, $rewriteKey);
    }

}