<?php

namespace Shop\Controller;

/**
 * Class GoodController
 * @package Shop
 */
class GoodController
{

    public function __construct()
    {
    }

    /**
     * @param $id
     */
    public function getOneGood($id)
    {
        echo sprintf("You requested good by number %d", $id);
    }

    /**
     * @param $id
     * @param $name
     */
    public function getOneGoodWithParam($id, $name)
    {
        echo sprintf("You requested good by number %d with parameter %s", $id, $name);
    }

    /**
     *
     */
    public function getAllGoods()
    {
        echo sprintf("You requested all goods!");
    }

}