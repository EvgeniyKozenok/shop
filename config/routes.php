<?php

return [
    "root" => [
        "pattern" => "/",
        "method" => "",
        "action" => "Shop\\IndexController@index"
    ],
    "get_one_good" => [
        "pattern" => "/good/{id}",
        "method" => "GET",
        "variables" => [
            "id" => "\\d+"
        ],
        "action" => "Shop\\GoodController@getOneGood"
    ],
    "get_one_good_param" => [
        "pattern" => "/good/{id}/params/{name}",
        "method" => "GET",
        "variables" => [
            "id" => "\\d+"
        ],
        "action" => "Shop\\GoodController@getOneGoodWithParam"
    ],
    "get_all_goods" => [
        "pattern" => "/good",
        "action" => "Shop\\GoodController@getAllGoods"
    ]
];