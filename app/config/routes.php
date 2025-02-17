<?php

$urlRoutes = [
    // URI => directory / controller / method
    '' => 'site/home/index',
    'home' => 'site/home/index',

    'category' => 'site/category/index',
    'subcategory' => 'admin/subcategory/index',

    'catalog' => "site/products/catalog",
    'card' => "site/products/card",

    "addToCart" => "site/order/addToCart",
    "removeFromCart" => "site/order/removeFromCart",
    "plusItemToCart" => "site/order/plusItemToCart",
    "minusItemFromCart" => "site/order/minusItemFromCart",
    "makeOrder" => "site/order/makeOrder",
    "cart" => "site/order/cart",
    "order" => "site/order/test",
    'reviews' => 'site/review/index',

    'register' => 'site/user/register',
    'login' => 'site/user/login',
    'profile' => 'site/user/profile',
    'edit' => 'site/user/edit',
    'setPhoto' => 'site/user/setPhoto',
    'passwordChange' => 'site/user/passwordChange',
    'logout' => 'site/user/logout',

    'admin/category' => 'admin/category/index',
    'admin/deleteCategory' => 'admin/category/deleteCategory',
    'admin/createCategory' => 'admin/category/create',
    'admin/updateCategory' => 'admin/category/update',
    'admin/subcategory' => 'admin/subcategory/index',
    'admin/createSubcategory' => 'admin/subcategory/create',
    'admin/updateSubcategory' => 'admin/subcategory/update',
    'admin/home' => 'admin/user/index',
    'admin/logout' => 'admin/user/logout',
    'admin/users' => 'admin/user/getAll',
    'admin/edit' => 'admin/user/edit',
    'admin/delete' => 'admin/user/delete',

    'admin/reviews' => 'admin/review/index',

    'admin/productCreating' => 'admin/products/productCreating',
    'admin/productEdit' => 'admin/products/productEdit',
];
