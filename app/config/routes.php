<?php

$urlRoutes = [
    // URI => directory / controller / method
    '' => 'site/home/index',
    'home' => 'site/home/index',
    'register' => 'site/user/register',
    'login' => 'site/user/login',
    'profile' => 'site/user/profile',
    'edit' => 'site/user/edit',
    'logout' => 'site/user/logout',

    'admin/home' => 'admin/user/index',
    'admin/logout' => 'admin/user/logout',
    'admin/users' => 'admin/user/getAll',
    'admin/edit' => 'admin/user/edit',
    'admin/delete' => 'admin/user/delete',


];
