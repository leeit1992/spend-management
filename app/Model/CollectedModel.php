<?php 
namespace App\Model;

use Atl\Database\Model;
use App\Model\AtlModel;

class CollectedModel extends Model
{
	public function __construct() {
		parent::__construct( 'collected' );
	}

	/**
	 * Insert | Update data collected.
	 * 
	 * @param  array  $argsData Array data insert | update
	 * @param  int    $id       Collected id
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
	 * Handle query get info collected by key.
	 * 
	 * @param  stirng $key   Column key
	 * @return array
	 */
	public function getinfoCollected( $id ) {
		return $this->db->select(
			$this->table,
				'*',
				[
					'id' => $id
				]
			);
	}

	/**
	 * Handle get limit collected
	 * @param  int 	  	$start Start query.
	 * @param  int 		$limit Number of row result.
	 * @return array
	 */
	public function getCollectedLimit( $start, $limit ) {
		return $this->db->select(
			$this->table,
			'*',
			[
				'LIMIT' => [ $start, $limit ],
				'ORDER' => [ 'id' => 'DESC']
			]
		);
	}

	/**
	 * Handle count Collected
	 * @return array
	 */
	public function count( $condition = [] ) {
		return $this->db->count( $this->table, $condition );
	}
	/**
	 * Handle remove collected
	 * 
	 * @param  int | array $args Data id collected
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
		$listCollected =  $this->db->select(
			$this->table,
			'*',
			[
				"collected_date[<>]" => [ $start, $end ],
				'ORDER' => [ 'collected_date' => 'DESC']
			]
		);
		return $listCollected;
	}

	/**
	 * Handle search by key
	 * 
	 * @param  string $key  Key search value.
	 * @return void
	 */
	public function getAllByMonth( $month = 1, $year = 2010 ) {
		$string = $year.'-'.$month;
		$listCollected =  $this->db->select(
			$this->table,
			'*',
			[
				"collected_date[~]" => $string,
				'ORDER' => [ 'collected_date' => 'DESC']
			]
		);
		return $listCollected;
	}
}
