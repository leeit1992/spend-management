<?php
namespace App\Http\Controllers;

use Atl\Routing\Controller as baseController;
use Atl\Validation\Validation;
use Atl\Pagination\Pagination;

class MainController extends baseController
{
    public function index( $page = null ) {
        redirect( url( '/atl-admin' ) );
    }
}
