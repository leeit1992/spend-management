<?php 
namespace App\Model;

use Atl\Database\Model;
use App\Model\AtlModel;

class DebtModel extends Model
{
	public function __construct() {
		parent::__construct( 'debt' );
	}

	/**
	 * Insert | Update data debt.
	 * 
	 * @param  array  $argsData Array data insert | update
	 * @param  int    $id       Debt id
	 * @return array
	 */
	public function save( $argsData, $id = null ){
		if ( $id ) {
			$this->db->update(
				$this->table, 
				$argsData,
				[ 'id' => $id ]
			);
			return $id;
		} else {
			$this->db->insert(
				$this->table, 
				$argsData
			);
			return $this->db->id();
		}
	}

	/**
	 * Handle query get info debt by key.
	 * 
	 * @param  stirng $key   Column key
	 * @return array
	 */
	public function getinfoDebt( $id ) {
		return $this->db->select(
			$this->table,
				'*',
				[
					'id' => $id
				]
			);
	}

	/**
	 * Handle get limit debt
	 * @param  int 	  	$start Start query.
	 * @param  int 		$limit Number of row result.
	 * @return array
	 */
	public function getDebtLimit( $start, $limit ) {
		return $this->db->select(
			$this->table,
			'*',
			[
				'LIMIT' => [$start, $limit],
				'ORDER' => [ 'id' => 'DESC']
			]
		);
	}

	/**
	 * Handle count Debt
	 * @return array
	 */
	public function count( $condition = [] ) {
		return $this->db->count( $this->table, $condition );
	}
	/**
	 * Handle remove debt
	 * 
	 * @param  int | array $args Data id debt
	 * @return void
	 */
	public function delete( $args ) {
		return $this->db->delete(
			$this->table,
			[
			"AND" => [
				"id" => $args
			]
		]);
	}

	/**
	 * Handle search by key
	 * 
	 * @param  string $key  Key search value.
	 * @return void
	 */
	public function getAllByDay( $startt = '0', $endd = '0' ) {
		$start = date( 'Y-m-d', strtotime( $startt ) );
		$end = date( 'Y-m-d', strtotime( $endd ) );
		$listDebt =  $this->db->select(
			$this->table,
			'*',
			[
				"debt_date[<>]" => [ $start, $end ],
				'ORDER' => [ 'debt_date' => 'DESC']
			]
		);
		return $listDebt;
	}

	/**
	 * Handle search by key
	 * 
	 * @param  string $key  Key search value.
	 * @return void
	 */
	public function getAllByMonth( $month = 1, $year = 2010 ) {
		$string = $year.'-'.$month;
		$listDebt =  $this->db->select(
			$this->table,
			'*',
			[
				"debt_date[~]" => $string,
				'ORDER' => [ 'debt_date' => 'DESC']
			]
		);
		return $listDebt;
	}
}
