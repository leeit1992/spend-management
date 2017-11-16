<?php
/*
|--------------------------------------------------------------------------
| Router for project
|--------------------------------------------------------------------------
*/

/*============================
=            Main            =
============================*/

$route->get( '/atl-admin', 'Backend\MainController@index' );
$route->get( '/atl-admin/error-404', 'Backend\MainController@page404' );
$route->get( '/atl-admin/template', 'Backend\MainController@template' );

/*=====  End of Main  ======*/

App\Http\Router\Login::getInstance()->router( $route );
App\Http\Router\User::getInstance()->router ($route );
App\Http\Router\Spend::getInstance()->router ($route );
App\Http\Router\Collected::getInstance()->router ($route );
App\Http\Router\Debt::getInstance()->router ($route );
