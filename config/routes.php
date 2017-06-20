<?php

return [
    "root" => [
        "pattern" => "/",
        "method" => "",
        "action" => "Shop\\Controller\\IndexController@index",
    ],
    "mobiles" => [
        "pattern" => "/mobiles",
        "action" => "Shop\\Controller\\MobileController@show",

    ],
    "mob_phone_details" => [
        "pattern" => "/mobile/{id}",
        "action" => "Shop\\Controller\\MobileController@showDetails",
        "method" => "",
        "variables" => [
            "id" => "\\d+"
        ],
    ],
    "filters" => [
        "pattern" => "/filter/{page}",
        "action" => "Shop\\Controller\\FilterController@showFilter",
        "method" => "POST",
        "variables" => [
            "page" => "\\w+"
        ],
    ],
    "compare" => [
        "pattern" => "/compare/{name}",
        "action" => "Shop\\Controller\\CompareController@compareProduct",
        "method" => "POST",
        "variables" => [
            "name" => "\\w+"
        ],
    ],
    "check_in" => [
        "pattern" => "/registration",
        "action" => "Shop\\Controller\\RegistrationController@showForm"
    ],
    "registr" => [
        "pattern" => "/registration",
        "action" => "Shop\\Controller\\RegistrationController@addUser",
        "method" => "POST",
    ],
    "logout" => [
        "pattern" => "/logout",
        "action" => "Shop\\Controller\\LogoutController@logout"
    ],
    "login" => [
        "pattern" => "/",
        "action" => "Shop\\Controller\\LoginController@login",
        "method" => "POST"
    ],
    "basket" => [
        "pattern" => "/basket",
        "action" => "Shop\\Controller\\BasketController@show",
        "method" => "POST"
    ],
    "order" => [
        "pattern" => "/basket",
        "action" => "Shop\\Controller\\BasketController@order",
    ],
    "scales" => [
        "pattern" => "/scales",
        "method" => "",
        "action" => "Shop\\Controller\\ScaleController@show",
    ],
    "scale_details" => [
        "pattern" => "/scale/{id}",
        "action" => "Shop\\Controller\\ScaleController@showDetails",
        "variables" => [
            "id" => "\\d+"
        ],
    ],






    "smartwatches" => [
        "pattern" => "/other",
        "method" => "",
        "action" => "Shop\\Controller\\IndexController@index",
    ],
    "radios" => [
        "pattern" => "/other",
        "method" => "",
        "action" => "Shop\\Controller\\IndexController@index",
    ],










    "get_one_good" => [
        "pattern" => "/good/{id}",
        "method" => "GET",
        "variables" => [
            "id" => "\\d+"
        ],
        "action" => "John\\Frame\\TestController\\GoodController@getOneGood"
    ],
    "get_one_good_param" => [
        "pattern" => "/good/{id}/params/{name}",
        "method" => "GET",
        "variables" => [
            "id" => "\\d+"
        ],
        "action" => "John\\Frame\\TestController\\GoodController@getOneGoodWithParam",
        "middlewares" => [
            "test", "actionTime", "age:admin,moderator"
        ],
    ],
    "get_all_goods" => [
        "pattern" => "/good",
        "action" => "John\\Frame\\TestController\\GoodController@getAllGoods"
    ]
];