<?php

namespace Shop\Model;

class MobileModel extends MainModel
{

    protected $table = 'mobiles';

    public function getFilterData(){
        $searchCharacteristics = [
            'brand' => 'производитель',
            'kernels' => 'Количество ядер',
            'ram' => 'Оперативная память',
            'matrix' => 'Тип матрицы',
            'diagonal' => 'Диагональ, дюймов'
        ];
        $simFilter = $this->getSims();
        return $this->getFilters($searchCharacteristics, $simFilter);
    }

    /**
     * get filter to sim
     * @return mixed
     */
    private function getSims()
    {
        $field = 'sim';
        $knownSimNumber = $this->getAll($this->table, [$field], true);
        $knownSimType =  $this->getAll($this->table, ['sims'], true);
        if (count($knownSimType) > 2) {
            for ($i = 0; $i< count($knownSimType); $i++) {
                foreach ($knownSimType[$i] as $key => $value) {
                    $temp = explode(',', $value);
                    if(count($temp) > 1) {
                        unset($knownSimType[$i]);
                    }
                }
            }
        }
        $knownSimNumber = array_merge($knownSimNumber, $knownSimType);
        return $this->combineCharacteristics($knownSimNumber, 'SIM-карта', $field);
    }

    /**
     * function to getting phones info to one loaded page
     * @return array
     */
    public function getPhones(): array
    {
        return $this->getProducts();
    }

    /**
     * Get info for describing phone
     * @param int $id
     * @return array
     */
    public function getPhone(int $id): array
    {
        $rewriteKey = [
            'os' => 'операционная система',
            'ram' => 'объем внутренней памяти',
            'hdd' => 'объем встраиваемой памяти',
            'slot' => 'наличие слотов',
            'sim' => 'количество sim-kart',
            'sims' => 'тип sim-kart',
            'proc' => 'процессор',
            'frequency' => 'частота процессора',
            'matrix' => 'матрица',
            'diagonal' => 'диагональ',
            'kernels' => 'количество ядер'
        ];
        return $this->getOneProduct($id, $rewriteKey);
    }
}