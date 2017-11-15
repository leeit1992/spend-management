<?php
namespace App\Http\Controllers\Backend;

use Atl\Foundation\Request;
use Atl\Validation\Validation;
use Atl\Pagination\Pagination;
use App\Model\DebtModel;
use App\Model\SpendModel;
use App\Http\Components\ApiHandlePrice;
use App\Http\Components\Controller as baseController;

class DebtController extends baseController
{
	public function __construct() {
		parent::__construct();
		$this->userAccess();

		// Model data system.
		$this->mdDebt   = new DebtModel;
		$this->mdSpend  = new SpendModel;
		$this->helpPrice = ApiHandlePrice::getInstance();
	}

	/**
     * Handle show list Debts manage page.
     * 
     * @return void
     */
	public function manageDebts( $page = null ) {
		$ofset      = 10;
        $totalRow   = $this->mdDebt->count();
        $baseUrl    = url( '/atl-admin/manage-debt/page/' );
        $config     = $this->configPagination( $page, $ofset, $totalRow, $baseUrl );
        $pagination = new Pagination( $config );

		// Load template
		return $this->loadTemplate(
			'backend/debt/manageDebt.tpl',
			[	
				'listDebt'    => $this->mdDebt->getDebtLimit( $pagination->getStartResult( $page ), $ofset ),
				'pagination'   => $pagination->link(),
				'mdDebt'      => $this->mdDebt,
				'notify'       => Session()->getFlashBag()->get( 'debtFormNotice' ),
				'helpPrice'    => $this->helpPrice,
                'addButton'    => $this->addButton,
                'manageAction' => $this->manageAction
			]
		);
	}
	/**
	 * Handle display add | edit debt.
	 * 
	 * @param  int $id ID of debt edit.
	 * @return string
	 */
	public function handleDebt( $id = null ) {
		$infoDebt = [];
		// Load data debt by action edit debt.
		if( $id ) {
			$infoDebt = $this->mdDebt->getinfoDebt( $id );
			if( empty( $infoDebt ) ) {
				redirect( url( '/atl-admin/error-404?url=' . $_SERVER['REDIRECT_URL'] ) );
			}
		}
		return $this->loadTemplate(
			'backend/debt/addDebt.tpl',
			[
				'debt'        => !empty( $infoDebt ) ? $infoDebt[0] : [],
				'self'         => $this,
				'actionName'   => ( !$id ) ? 'Add' : 'Edit',
				'mdDebt'      => $this->mdDebt,
				'notify'       => Session()->getFlashBag()->get( 'debtFormNotice' ),
                'addButton'    => $this->addButton,
                'manageAction' => $this->manageAction
			],
			[   'media' => true ]
		);
	}
	/**
	 * Handle validate form debt.
	 * 
	 * @param  Request $request Request POST | GET method
	 * @return void.
	 */
	public function validateDebt( Request $request ) {
		if( !empty( $request->get( 'formData' ) ) ) {
			parse_str( $request->get( 'formData' ), $formData );
			$notice = [];
			$debt_expire = (isset( $formData['atl_debt_expire_un'] )) ? $formData['atl_debt_expire_un'] : $formData['atl_debt_expire'];
			// Insert | Update Debt.
			$dataDebt = [    
				'debt_price' => $this->helpPrice->convertPriceToInt ( $formData['atl_debt_price'] ),
        		'debt_date'  => $this->convertDateToYmd( $formData['atl_debt_date'] ),
        		'debt_expire'  => $debt_expire,
        		'debt_description' => $formData['atl_debt_description'],
        		'debt_created_date' => date("Y-m-d H:i:s")
			];
			$lastID = $this->mdDebt->save(
				$dataDebt,
				isset( $formData['atl_debt_id'] ) ? $formData['atl_debt_id'] : null
			);

			// Set notice success
			$nameAction = isset( $formData['atl_debt_id'] ) ? 'Update' : 'Create';
			Session()->getFlashBag()->set( 'debtFormNotice', $nameAction . ' debt successfully' );
			
			// Set notice success
			$notice['id']     = $lastID;
			$notice['status'] = true;

			echo json_encode( $notice );
		}	
	}
	/**
	 * Handle filter debt
	 * 
	 * @param  Request $request POST | GET
	 * @return json
	 */
	public function ajaxManageDebt( Request $request ) {
		$output = '';
		/**
		 * Check type get list debt manage.
		 */
		switch ( $request->get('getBy') ) {
			case 'day':
				$debts = $this->mdDebt->getAllByDay( $request->get( 'startDate' ), $request->get( 'endDate' ) );
				break;
			case 'month':
				$debts = $this->mdDebt->getAllByMonth( $request->get( 'dataMonth' ), $request->get( 'dataYear' ) );
				break;
		}
		$totalPrice = 0;
		$totalPaid = 0;
		foreach ($debts as $value) {
			$totalPrice += $value['debt_price'];
			$totalPaid += $value['debt_paid'];
		}
		ob_start();
		$output .= View(
			'backend/debt/manageDebtJs.tpl',
			[
				'debts'     => $debts,
				'totalPrice' => $totalPrice,
				'totalRemain' => $totalPrice - $totalPaid,
				'mdDebt'    => $this->mdDebt,
				'helpPrice'  => $this->helpPrice
			]
		);
		$output .= ob_get_clean();
		echo json_encode( [ 'output' => $output ] );
	}
	/**
	 * Handle delete debt with ajax
	 * 
	 * @param  Request $request POST | GET
	 * @return void
	 */
	public function ajaxDelete( Request $request ) {
		$id = $request->get( 'id' );
		// Remove debt
		$this->mdDebt->delete( $id );

		$message['status'] = true;
		if( empty( $request->get( 'id' ) ) ) {
			$message['status'] = false;
		}
		echo json_encode( $message );
	}

	/**
	 * Handle validate form debt.
	 * 
	 * @param  Request $request Request POST | GET method
	 * @return void.
	 */
	public function validateDebtPay( Request $request ) {
		$notice = [];
		if ( !empty( $request->get( 'id' ) ) && !empty( $request->get( 'pay' ) ) ) {
			$infoDebt = $this->mdDebt->getinfoDebt( $request->get( 'id' ) );
			$debt_paid = intval( $infoDebt[0]['debt_paid'] ) + $this->helpPrice->convertPriceToInt ( $request->get( 'pay' ) );
			// Update Debt.
			$this->mdDebt->save( [
					'debt_paid' => $debt_paid
				],
				$request->get( 'id' )
			);
			// get info Debt
			$infoDebt = $this->mdDebt->getinfoDebt( $request->get( 'id' ) );
			// Update Spend.
			$dataSpend = [    
				'spend_price' => $this->helpPrice->convertPriceToInt ( $request->get( 'pay' ) ),
        		'spend_date'  => date('Y-m-d'),
        		'spend_description' => $infoDebt[0]['debt_description'],
        		'spend_created_date' => date("Y-m-d H:i:s")
			];
			$lastID = $this->mdSpend->save(
				$dataSpend,
				null
			);
			$notice['status'] = true;
			// Set notice success
			Session()->getFlashBag()->set( 'debtFormNotice', 'Update debt pay successfully' );	
		} else {
			$notice['status'] = false;
		}
		echo json_encode( $notice );
	}
}
