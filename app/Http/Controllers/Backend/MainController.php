<?php
namespace App\Http\Controllers\Backend;

use Atl\Foundation\Request;
use App\Http\Components\Controller as baseController;

class MainController extends baseController
{
	public function __construct() {
		parent::__construct();
		$this->userAccess();
	}

	public function index() {
		// Load layout.
		return $this->loadTemplate('backend/main.tpl');
	}

	/**
	 * Handle set page 404
	 */
	public function page404( Request $request ){
		return View(
			'backend/error404.tpl',
			[	
				'url' => $request->get( 'url' ),
				'redirect' => url( '/atl-admin' )
			]
		);
	}
}
