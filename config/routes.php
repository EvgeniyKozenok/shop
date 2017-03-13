<?php

namespace john\frame\config;

return [
    "root" => [
        "pattern" => "/",
        "method" => "",
        "action" => "IndexController@index"
    ],
    "get_one_good" => [
        "pattern" => "/good/{id}",
        "method" => "GET",
        "variables" => [
            "id" => "\\d+"
        ],
        "action" => "GoodController@getOneGood"
    ],
    "get_one_good_param" => [
        "pattern" => "/good/{id}/params/{name}",
        "method" => "GET",
        "variables" => [
            "id" => "\\d+"
        ],
        "action" => "GoodController@getOneGoodWithParam"
    ],
    "get_all_goods" => [
        "pattern" => "/good",
        "action" => "GoodController@getAllGoods"
    ]
];