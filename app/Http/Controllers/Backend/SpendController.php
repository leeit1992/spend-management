<?php
namespace App\Http\Controllers\Backend;

use Atl\Foundation\Request;
use Atl\Validation\Validation;
use Atl\Pagination\Pagination;
use App\Model\SpendModel;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Controller as baseController;

class SpendController extends baseController
{
	public function __construct() {
		parent::__construct();
		$this->userAccess();

		// Model data system.
		$this->mdSpend   = new SpendModel;
		$this->helpPrice = ApiHandlePrice::getInstance();
	}

	/**
     * Handle show list Spends manage page.
     * 
     * @return void
     */
	public function manageSpends( $page = null ) {
		$ofset      = 10;
        $totalRow   = $this->mdSpend->count();
        $baseUrl    = url( '/atl-admin/manage-spend/page/' );
        $config     = $this->configPagination( $page, $ofset, $totalRow, $baseUrl );
        $pagination = new Pagination( $config );

		// Load template
		return $this->loadTemplate(
			'backend/spend/manageSpend.tpl',
			[	
				'listSpend'    => $this->mdSpend->getSpendLimit( $pagination->getStartResult( $page ), $ofset ),
				'pagination'   => $pagination->link(),
				'mdSpend'      => $this->mdSpend,
				'helpPrice'    => $this->helpPrice,
                'addButton'    => $this->addButton,
                'manageAction' => $this->manageAction
			]
		);
	}
	/**
	 * Handle display add | edit spend.
	 * 
	 * @param  int $id ID of spend edit.
	 * @return string
	 */
	public function handleSpend( $id = null ) {
		$infoSpend = [];
		// Load data spend by action edit spend.
		if( $id ) {
			$infoSpend = $this->mdSpend->getinfoSpend( $id );
			if( empty( $infoSpend ) ) {
				redirect( url( '/atl-admin/error-404?url=' . $_SERVER['REDIRECT_URL'] ) );
			}
		}
		return $this->loadTemplate(
			'backend/spend/addSpend.tpl',
			[
				'spend'        => !empty( $infoSpend ) ? $infoSpend[0] : [],
				'self'         => $this,
				'actionName'   => ( !$id ) ? 'Add' : 'Edit',
				'mdSpend'      => $this->mdSpend,
				'notify'       => Session()->getFlashBag()->get( 'spendFormNotice' ),
                'addButton'    => $this->addButton,
                'manageAction' => $this->manageAction
			],
			[   'media' => true ]
		);
	}
	/**
	 * Handle validate form spend.
	 * 
	 * @param  Request $request Request POST | GET method
	 * @return void.
	 */
	public function validateSpend( Request $request ) {
		if( !empty( $request->get( 'formData' ) ) ) {
			parse_str( $request->get( 'formData' ), $formData );
			$notice = [];

			// Insert | Update Spend.
			$dataSpend = [    
				'spend_price' => $this->helpPrice->convertPriceToInt ( $formData['atl_spend_price'] ),
        		'spend_date'  => $this->convertDateToYmd( $formData['atl_spend_date'] ),
        		'spend_time'  => $this->convertTimeToHis( $formData['atl_spend_time'] ),
        		'spend_description' => $formData['atl_spend_description'],
        		'spend_created_date' => date("Y-m-d H:i:s")
			];
			$lastID = $this->mdSpend->save(
				$dataSpend,
				isset( $formData['atl_spend_id'] ) ? $formData['atl_spend_id'] : null
			);

			// Set notice success
			$nameAction = isset( $formData['atl_spend_id'] ) ? 'Update' : 'Create';
			Session()->getFlashBag()->set( 'spendFormNotice', $nameAction . ' spend successfully' );
			
			// Set notice success
			$notice['id']     = $lastID;
			$notice['status'] = true;

			echo json_encode( $notice );
		}	
	}
	/**
	 * Handle filter spend
	 * 
	 * @param  Request $request POST | GET
	 * @return json
	 */
	public function ajaxManageSpend( Request $request ) {
		$output = '';
		/**
		 * Check type get list spend manage.
		 */
		switch ( $request->get('getBy') ) {
			case 'day':
				$spends = $this->mdSpend->getAllByDay( $request->get( 'startDate' ), $request->get( 'endDate' ) );
				break;
			case 'month':
				$spends = $this->mdSpend->getAllByMonth( $request->get( 'dataMonth' ), $request->get( 'dataYear' ) );
				break;
		}
		$totalPrice = 0;
		foreach ($spends as $value) {
			$totalPrice += $value['spend_price'];
		}
		ob_start();
		$output .= View(
			'backend/spend/manageSpendJs.tpl',
			[
				'spends'     => $spends,
				'totalPrice' => $totalPrice,
				'mdSpend'    => $this->mdSpend,
				'helpPrice'  => $this->helpPrice
			]
		);
		$output .= ob_get_clean();
		echo json_encode( [ 'output' => $output ] );
	}
	/**
	 * Handle delete spend with ajax
	 * 
	 * @param  Request $request POST | GET
	 * @return void
	 */
	public function ajaxDelete( Request $request ) {
		$id = $request->get( 'id' );
		// Remove spend
		$this->mdSpend->delete( $id );

		$message['status'] = true;
		if( empty( $request->get( 'id' ) ) ) {
			$message['status'] = false;
		}
		echo json_encode( $message );
	}
}
