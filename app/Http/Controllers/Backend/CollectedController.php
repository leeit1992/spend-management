<?php
namespace App\Http\Controllers\Backend;

use Atl\Foundation\Request;
use Atl\Validation\Validation;
use Atl\Pagination\Pagination;
use App\Model\CollectedModel;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Controller as baseController;

class CollectedController extends baseController
{
	public function __construct() {
		parent::__construct();
		$this->userAccess();

		// Model data system.
		$this->mdCollected   = new CollectedModel;
		$this->helpPrice = ApiHandlePrice::getInstance();
	}

	/**
     * Handle show list Collecteds manage page.
     * 
     * @return void
     */
	public function manageCollecteds( $page = null ) {
		$ofset      = 10;
        $totalRow   = $this->mdCollected->count();
        $baseUrl    = url( '/atl-admin/manage-collected/page/' );
        $config     = $this->configPagination( $page, $ofset, $totalRow, $baseUrl );
        $pagination = new Pagination( $config );

		// Load template
		return $this->loadTemplate(
			'backend/collected/manageCollected.tpl',
			[	
				'listCollected'    => $this->mdCollected->getCollectedLimit( $pagination->getStartResult( $page ), $ofset ),
				'pagination'   => $pagination->link(),
				'mdCollected'  => $this->mdCollected,
				'helpPrice'    => $this->helpPrice,
                'addButton'    => $this->addButton,
                'manageAction' => $this->manageAction
			]
		);
	}
	/**
	 * Handle display add | edit collected.
	 * 
	 * @param  int $id ID of collected edit.
	 * @return string
	 */
	public function handleCollected( $id = null ) {
		$infoCollected = [];
		// Load data collected by action edit collected.
		if( $id ) {
			$infoCollected = $this->mdCollected->getinfoCollected( $id );
			if( empty( $infoCollected ) ) {
				redirect( url( '/atl-admin/error-404?url=' . $_SERVER['REDIRECT_URL'] ) );
			}
		}
		return $this->loadTemplate(
			'backend/collected/addCollected.tpl',
			[
				'collected'        => !empty( $infoCollected ) ? $infoCollected[0] : [],
				'self'         => $this,
				'actionName'   => ( !$id ) ? 'Add' : 'Edit',
				'mdCollected'      => $this->mdCollected,
				'notify'       => Session()->getFlashBag()->get( 'collectedFormNotice' ),
                'addButton'    => $this->addButton,
                'manageAction' => $this->manageAction
			],
			[   'media' => true ]
		);
	}
	/**
	 * Handle validate form collected.
	 * 
	 * @param  Request $request Request POST | GET method
	 * @return void.
	 */
	public function validateCollected( Request $request ) {
		if( !empty( $request->get( 'formData' ) ) ) {
			parse_str( $request->get( 'formData' ), $formData );
			$notice = [];

			// Insert | Update Collected.
			$dataCollected = [    
				'collected_price' => $this->helpPrice->convertPriceToInt ( $formData['atl_collected_price'] ),
        		'collected_date'  => $this->convertDateToYmd( $formData['atl_collected_date'] ),
        		'collected_time'  => $this->convertTimeToHis( $formData['atl_collected_time'] ),
        		'collected_description' => $formData['atl_collected_description'],
        		'collected_created_date' => date("Y-m-d H:i:s")
			];
			$lastID = $this->mdCollected->save(
				$dataCollected,
				isset( $formData['atl_collected_id'] ) ? $formData['atl_collected_id'] : null
			);

			// Set notice success
			$nameAction = isset( $formData['atl_collected_id'] ) ? 'Update' : 'Create';
			Session()->getFlashBag()->set( 'collectedFormNotice', $nameAction . ' collected successfully' );
			
			// Set notice success
			$notice['id']     = $lastID;
			$notice['status'] = true;

			echo json_encode( $notice );
		}	
	}
	/**
	 * Handle filter collected
	 * 
	 * @param  Request $request POST | GET
	 * @return json
	 */
	public function ajaxManageCollected( Request $request ) {
		$output = '';
		/**
		 * Check type get list collected manage.
		 */
		switch ( $request->get('getBy') ) {
			case 'day':
				$collecteds = $this->mdCollected->getAllByDay( $request->get( 'startDate' ), $request->get( 'endDate' ) );
				break;
			case 'month':
				$collecteds = $this->mdCollected->getAllByMonth( $request->get( 'dataMonth' ), $request->get( 'dataYear' ) );
				break;
		}
		$totalPrice = 0;
		foreach ($collecteds as $value) {
			$totalPrice += $value['collected_price'];
		}
		ob_start();
		$output .= View(
			'backend/collected/manageCollectedJs.tpl',
			[
				'collecteds'     => $collecteds,
				'totalPrice' => $totalPrice,
				'mdCollected'    => $this->mdCollected,
				'helpPrice'  => $this->helpPrice
			]
		);
		$output .= ob_get_clean();
		echo json_encode( [ 'output' => $output ] );
	}
	/**
	 * Handle delete collected with ajax
	 * 
	 * @param  Request $request POST | GET
	 * @return void
	 */
	public function ajaxDelete( Request $request ) {
		$id = $request->get( 'id' );
		// Remove collected
		$this->mdCollected->delete( $id );

		$message['status'] = true;
		if( empty( $request->get( 'id' ) ) ) {
			$message['status'] = false;
		}
		echo json_encode( $message );
	}
}
