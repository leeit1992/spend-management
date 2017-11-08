<?php
namespace App\Http\Router;

use App\Http\Router\RouterInterface;

class User implements RouterInterface
{
	private static $getInstance = null;

	public static function getInstance() {
        if ( !( self::$getInstance instanceof self ) ) {
            self::$getInstance = new self();
        }

        return self::$getInstance;
	} 

	public function router( &$route ) {
		$route->get( '/atl-admin/edit-user/{id}', 'Backend\UserController@handleUser', ['id' => '\d+'] );

		$route->post( '/atl-admin/validate-user', 'Backend\UserController@validateUser' );
	}
}
