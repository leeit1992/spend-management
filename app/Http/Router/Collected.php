<?php
namespace App\Http\Router;

use App\Http\Router\RouterInterface;

class Collected implements RouterInterface
{
	private static $getInstance = null;

	public static function getInstance() {
        if ( !( self::$getInstance instanceof self ) ) {
            self::$getInstance = new self();
        }

        return self::$getInstance;
	} 

	public function router( &$route ) {
		$route->get( '/atl-admin/manage-collected', 'Backend\CollectedController@manageCollecteds' );
		$route->get( '/atl-admin/manage-collected/page/{page}', 'Backend\CollectedController@manageCollecteds' );
		$route->get( '/atl-admin/add-collected', 'Backend\CollectedController@handleCollected' );
		$route->get( '/atl-admin/edit-collected/{id}', 'Backend\CollectedController@handleCollected', ['id' => '\d+'] );
		$route->get( '/atl-admin/ajax-manage-collected', 'Backend\CollectedController@ajaxManageCollected' );
		
		$route->post( '/atl-admin/validate-collected', 'Backend\CollectedController@validateCollected' );
		$route->post( '/atl-admin/delete-collected', 'Backend\CollectedController@ajaxDelete' );
	}
}
