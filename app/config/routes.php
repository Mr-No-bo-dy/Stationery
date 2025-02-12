<?php

$urlRoutes = [
    // URI => directory / controller / method
    '' => 'site/home/index',
    'home' => 'site/home/index',

    'category' => 'site/category/index',

    'catalog' => "site/products/catalog",
    'productCard' => "site/products/productCard",

    'reviews' => 'site/review/index',

    'register' => 'site/user/register',
    'login' => 'site/user/login',
    'profile' => 'site/user/profile',
    'edit' => 'site/user/edit',
    'logout' => 'site/user/logout',

    'adminCategory' => 'admin/category/index',
    'adminDeleteCategory' => 'admin/category/deleteCategory',
    'createCategory' => 'admin/category/create',
    'admin/home' => 'admin/user/index',
    'admin/logout' => 'admin/user/logout',
    'admin/users' => 'admin/user/getAll',
    'admin/edit' => 'admin/user/edit',
    'admin/delete' => 'admin/user/delete',

];
