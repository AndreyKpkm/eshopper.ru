<?php

return array(
    'product/([0-9]+)' => 'product/view/$1', // actionView в ProductController

    'catalog' => 'catalog/index', // actionIndex в CatalogController

    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController

    'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd в CartController

    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart/removeAjax/([0-9]+)' => 'cart/removeAjax/$1',
    'cart/updateTotalPriceCartAjax' => 'cart/updateTotalPriceCartAjax',
    'cart/checkout' => 'cart/checkout',
    'cart' => 'cart/index',
    // Пользователь
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    // Управление товарами:
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',
    // Управление категориями:
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',
    // Управление заказами:
    'admin/order/create' => 'adminOrder/create',
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',
    // Админ-панель
    'admin' => 'admin/index',
    // О магазине
    'contacts' => 'site/contacts',
    '([a-zA-Z0-9\-]+)' => 'page/view/$1', // actionView в PageController

    '' => 'site/index', // actionIndex в SiteController
);