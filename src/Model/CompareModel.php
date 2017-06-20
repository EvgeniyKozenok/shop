<?php

namespace Shop\Model;

class CompareModel extends MainModel
{
    protected $table;

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * return array of compare products
     * @param array $data
     * @return array
     */
    public function getCompareGoods(array $data):array
    {
        $data = $this->getFilterData($data);
        return $this->getAllById($data);
    }

    /**
     * return array id to compare product
     * @param $data
     * @return array
     */
    private function getFilterData($data)
    {
        $id = [];
        $i = 0;
        foreach ($data as $key => $value){
            $temp = explode('/', $key);
            $id[$i] = $temp[1];
            $i++;
        }
        return $id;
    }

}