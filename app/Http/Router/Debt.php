<?php
namespace App\Http\Router;

use App\Http\Router\RouterInterface;

class Debt implements RouterInterface
{
	private static $getInstance = null;

	public static function getInstance() {
        if ( !( self::$getInstance instanceof self ) ) {
            self::$getInstance = new self();
        }

        return self::$getInstance;
	} 

	public function router( &$route ) {
		$route->get( '/atl-admin/manage-debt', 'Backend\DebtController@manageDebts' );
		$route->get( '/atl-admin/manage-debt/page/{page}', 'Backend\DebtController@manageDebts' );
		$route->get( '/atl-admin/add-debt', 'Backend\DebtController@handleDebt' );
		$route->get( '/atl-admin/edit-debt/{id}', 'Backend\DebtController@handleDebt', ['id' => '\d+'] );
		$route->get( '/atl-admin/ajax-manage-debt', 'Backend\DebtController@ajaxManageDebt' );
		
		$route->post( '/atl-admin/validate-debt', 'Backend\DebtController@validateDebt' );
		$route->post( '/atl-admin/delete-debt', 'Backend\DebtController@ajaxDelete' );
	}
}
