<?php
namespace App\Http\Router;

use App\Http\Router\RouterInterface;

class Spend implements RouterInterface
{
	private static $getInstance = null;

	public static function getInstance() {
        if ( !( self::$getInstance instanceof self ) ) {
            self::$getInstance = new self();
        }

        return self::$getInstance;
	} 

	public function router( &$route ) {
		$route->get( '/atl-admin/manage-spend', 'Backend\SpendController@manageSpends' );
		$route->get( '/atl-admin/manage-spend/page/{page}', 'Backend\SpendController@manageSpends' );
		$route->get( '/atl-admin/add-spend', 'Backend\SpendController@handleSpend' );
		$route->get( '/atl-admin/edit-spend/{id}', 'Backend\SpendController@handleSpend', ['id' => '\d+'] );
		$route->get( '/atl-admin/ajax-manage-spend', 'Backend\SpendController@ajaxManageSpend' );
		
		$route->post( '/atl-admin/validate-spend', 'Backend\SpendController@validateSpend' );
		$route->post( '/atl-admin/delete-spend', 'Backend\SpendController@ajaxDelete' );
	}
}
