<?php

$urlRoutes = [
    // URI => directory / controller / method

    // Site pages
    '' => 'site/home/index',
    'home' => 'site/home/index',
    'changeColorTheme' => 'site/home/changeColorTheme',

    'category' => 'site/category/index',
    'subcategory' => 'site/subcategory/index',

    'catalog' => "site/product/catalog",
    'card' => "site/product/card",

    // Cart & Order
    "addToCart" => "site/order/addToCart",
    "removeFromCart" => "site/order/removeFromCart",
    "plusItemToCart" => "site/order/plusItemToCart",
    "minusItemFromCart" => "site/order/minusItemFromCart",
    "makeOrder" => "site/order/makeOrder",
    "cart" => "site/order/cart",
    "checkout" => "site/order/checkout",
    "order" => "site/order/test",

    // Reviews
    'reviews' => 'site/review/index',

    // Users
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

    // Admin Categories
    'admin/changeColorTheme' => 'site/home/changeColorTheme',
    'admin/category' => 'admin/category/index',
    'admin/deleteCategory' => 'admin/category/deleteCategory',
    'admin/createCategory' => 'admin/category/create',
    'admin/storeCategory' => 'admin/category/store',
    'admin/editCategory' => 'admin/category/edit',
    'admin/updateCategory' => 'admin/category/update',

    // Admin Subcategories
    'admin/subcategory' => 'admin/subcategory/index',
    'admin/createSubcategory' => 'admin/subcategory/create',
    'admin/storeSubcategory' => 'admin/subcategory/store',
    'admin/editSubcategory' => 'admin/subcategory/edit',
    'admin/updateSubcategory' => 'admin/subcategory/update',
    'admin/deleteSubcategory' => 'admin/subcategory/delete',

    // Admin Users
    'admin/home' => 'admin/user/index',
    'admin/logout' => 'admin/user/logout',
    'admin/users' => 'admin/user/getAll',
    'admin/edit' => 'admin/user/edit',
    'admin/update' => 'admin/user/update',
    'admin/delete' => 'admin/user/delete',

    // Admin orders
    'admin/orders' => 'admin/order/index',
    'admin/reviews' => 'admin/review/index',

    // Admin Products
    'admin/productCreating' => 'admin/product/productCreating',
    'admin/productSave' => 'admin/product/save',
    'admin/productEdit' => 'admin/product/productEdit',
    'admin/products' => 'admin/product/products',
    'admin/productUpdate' => 'admin/product/update',
    'admin/productRemove' => 'admin/product/remove'
];
