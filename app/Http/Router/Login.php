<?php
namespace App\Http\Router;

use App\Http\Router\RouterInterface;

class Login implements RouterInterface
{
	private static $getInstance = null;

	public static function getInstance() {
        if ( !( self::$getInstance instanceof self ) ) {
            self::$getInstance = new self();
        }

        return self::$getInstance;
	} 

	public function router( &$route ) {
		$route->get( '/atl-login', 'Backend\LoginController@login' );
		$route->get( '/logout', 'Backend\LoginController@logout' );

		$route->post( '/check-login', 'Backend\LoginController@checkLogin' );
	}
}
