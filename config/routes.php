<?php

namespace john\frame\config;

return [
    "root" => [
        "pattern" => "/",
        "method" => "",
        "action" => "IndexController@index"
    ],
    "get_one_good" => [
        "pattern" => "/good/{id}/params/{name}",
        "method" => "",
        "variables" => [
            "id" => "\\d+"
            //"name" => ".+"
        ],
        "action" => "GoodController@getOneGood"
    ],
    "get_all_goods" => [
        "pattern" => "/good",
        "action" => "GoodController@getAllGoods"
    ]
];