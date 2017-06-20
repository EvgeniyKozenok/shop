<?php

namespace Shop\Model;

use John\Frame\Validator\Validator;

class FilterModel extends MainModel
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
     * Get data by input filter and return result
     * @param array $post
     * @return array
     */
    public function getWithFilter(array $post):array
    {
        $filterData = [];
        foreach ($post as $key => $value) {
            $value = explode('/', $key);
            if (strlen($value[1]) < 4) {
                $value[1] = str_replace('_', '.', $value[1]);
            }
            if($value[0] == 'sim' && !is_numeric($value[1])) {
                $value[0] .= 's';
            }
            if($value[0] == 'price1' || $value[0] == 'price2') {
                $value[0] = 'price';
                $value[1] = $post[$key];
            }
            if (isset($filterData[$value[0]])) {
                array_push($filterData[$value[0]], $value[1]);
            } else {
                $filterData[$value[0]] = [$value[1]];
            }
        }
        $validator = new Validator($post, [
            'numeric' => ['numeric_rule' => [$filterData['price'][0], $filterData['price'][1]]]
        ]);
        $validator->validate();
        if ($validator->getErrors()) {
            $data['price'] = [$post['price1/'], $post['price2/'], 'введите корректные цены' ];
            return $data;
        }
        $findIn = [];
        foreach ($filterData as $key => $value) {
            if ($key == 'price') {
                $idArray = $this->getBetween($value, 'price');
            } else {
                $idArray = $this->getIn($key, $value);
            }
            $idArray = $this->getSimpleArray($idArray);
            if (isset($findIn[0]) && count($idArray) >= count($findIn[0])) {
                if (count($idArray) == count($findIn[0]) && $idArray[count($idArray) - 1] != $findIn[0][count($idArray) - 1]) {
                    array_pop($idArray);
                    array_unshift($findIn, $idArray);
                } else {
                    array_push($findIn, $idArray);
                }
            } else {
                array_unshift($findIn, $idArray);
            }
        }
        $findIn = $this->compare($findIn);
        if(empty($findIn)){
            $data['price'] = [$post['price1/'], $post['price2/']];
            return $data;
        }
        $data = $this->getIn('id', $findIn, ['*']);
        $data['price'] = [$post['price1/'], $post['price2/']];
        return $data;
    }

    /**
     * Convert array to simple array
     * @param  array $arr
     * @param string $param
     * @return array
     */
    private function getSimpleArray(array $arr, string $param = 'id'):array
    {
        $temp = [];
        for($i=0; $i<count($arr); $i++) {
            $temp[$i] = $arr[$i][$param];
        }
        return $temp;
    }

    /**
     * Compare all input array and return result to filter search
     * @param $findIn
     * @return mixed
     */
    private function compare($findIn): array
    {
        $first = array_shift($findIn);
        if(empty($findIn))
            return $first;
        $result = [];
        foreach ($findIn as $array) {
            $temp = [];
            foreach ($array as $key => $value) {
                if(in_array((int)$value, $first)){
                    array_push($temp,$value);
                }
            }
            if(empty($temp)) {
                return [];
            } else {
                foreach ($temp as $key => $value) {
                    if (!in_array($value, $result)) {
                        array_push($result,$value);
                    }
                }
            }
        }
        return $result;
    }

    /**
     * return checked parameter in filter
     * @param $post
     * @return array
     */
    public function getChecked($post):array
    {
        $checked = [];
        foreach ($post as $k => $v) {
            $k = explode('/', $k);
            $checked[$k[0]][] = $k[1];
        }
        return $checked;
    }


}