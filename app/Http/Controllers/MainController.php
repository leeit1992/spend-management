<?php
namespace App\Http\Controllers;

use Atl\Routing\Controller as baseController;

class MainController extends baseController
{
    public function index( $page = null ) {
        redirect( url( '/atl-admin' ) );
    }
}
