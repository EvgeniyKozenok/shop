<?php

return [
    "root" => [
        "pattern" => "/",
        "method" => "",
        "action" => "Shop\\Controller\\IndexController@index"
    ],
    "get_one_good" => [
        "pattern" => "/good/{id}",
        "method" => "GET",
        "variables" => [
            "id" => "\\d+"
        ],
        "action" => "Shop\\Controller\\GoodController@getOneGood"
    ],
    "get_one_good_param" => [
        "pattern" => "/good/{id}/params/{name}",
        "method" => "GET",
        "variables" => [
            "id" => "\\d+"
        ],
        "action" => "Shop\\Controller\\GoodController@getOneGoodWithParam"
    ],
    "get_all_goods" => [
        "pattern" => "/good",
        "action" => "Shop\\Controller\\GoodController@getAllGoods"
    ]
];