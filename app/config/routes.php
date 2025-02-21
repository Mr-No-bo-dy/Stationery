<?php

$urlRoutes = [
    // URI => directory / controller / method
    '' => 'site/home/index',
    'home' => 'site/home/index',

    'category' => 'site/category/index',
    'subcategory' => 'site/subcategory/index',

    'catalog' => "site/products/catalog",
    'card' => "site/products/card",

    "addToCart" => "site/order/addToCart",
    "removeFromCart" => "site/order/removeFromCart",
    "plusItemToCart" => "site/order/plusItemToCart",
    "minusItemFromCart" => "site/order/minusItemFromCart",
    "makeOrder" => "site/order/makeOrder",
    "cart" => "site/order/cart",
    "checkout" => "site/order/checkout",
    "order" => "site/order/test",
    'reviews' => 'site/review/index',

    'registration' => 'site/user/registration',
    'signUp' => 'site/user/signUp',
    'login' => 'site/user/login',
    'signIn' => 'site/user/signIn',
    'profile' => 'site/user/profile',
    'edit' => 'site/user/edit',
    'update' => 'site/user/update',
    'setPhoto' => 'site/user/setPhoto',
    'deletePhoto' => 'site/user/deletePhoto',
    'passwordChange' => 'site/user/passwordChange',
    'passwordUpdate' => 'site/user/passwordUpdate',
    'logout' => 'site/user/logout',

    'admin/category' => 'admin/category/index',
    'admin/deleteCategory' => 'admin/category/deleteCategory',
    'admin/createCategory' => 'admin/category/create',
    'admin/storeCategory' => 'admin/category/store',
    'admin/updateCategory' => 'admin/category/update',
    'admin/editCategory' => 'admin/category/edit',
    'admin/subcategory' => 'admin/subcategory/index',
    'admin/createSubcategory' => 'admin/subcategory/create',
    'admin/storeSubcategory' => 'admin/subcategory/store',
    'admin/updateSubcategory' => 'admin/subcategory/update',
    'admin/editSubcategory' => 'admin/subcategory/edit',
    'admin/deleteSubcategory' => 'admin/subcategory/delete',
    'admin/home' => 'admin/user/index',
    'admin/logout' => 'admin/user/logout',
    'admin/users' => 'admin/user/getAll',
    'admin/edit' => 'admin/user/edit',
    'admin/update' => 'admin/user/update',
    'admin/delete' => 'admin/user/delete',
    'admin/orders' => 'admin/order/index',
    'admin/ordersSorting' => 'admin/order/sorting',
    'admin/reviews' => 'admin/review/index',

    'admin/productCreating' => 'admin/products/productCreating',
    'admin/productSave' => 'admin/products/save',
    'admin/productEdit' => 'admin/products/productEdit',
    'admin/products' => 'admin/products/products',
    'admin/productUpdate' => 'admin/products/update'
];
