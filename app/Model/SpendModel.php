<?php 
namespace App\Model;

use Atl\Database\Model;
use App\Model\AtlModel;

class SpendModel extends Model
{
	public function __construct() {
		parent::__construct( 'spend' );
	}

	/**
	 * Insert | Update data spend.
	 * 
	 * @param  array  $argsData Array data insert | update
	 * @param  int    $id       Spend id
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
	 * Handle query get info spend by key.
	 * 
	 * @param  stirng $key   Column key
	 * @return array
	 */
	public function getinfoSpend( $id ) {
		return $this->db->select(
			$this->table,
				'*',
				[
					'id' => $id
				]
			);
	}

	/**
	 * Handle get limit spend
	 * @param  int 	  	$start Start query.
	 * @param  int 		$limit Number of row result.
	 * @return array
	 */
	public function getSpendLimit( $start, $limit ) {
		return $this->db->select(
			$this->table,
			'*',
			[
				'LIMIT' => [$start, $limit]
			]
		);
	}

	/**
	 * Handle count Spend
	 * @return array
	 */
	public function count( $condition = [] ) {
		return $this->db->count( $this->table, $condition );
	}
	/**
	 * Handle remove spend
	 * 
	 * @param  int | array $args Data id spend
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
	public function searchBy( $key ) {
		$listSpend =  $this->db->select(
			$this->table,
			'*',
			[
				"service_name[~]" => $key
			]
		);
		return $listSpend;
	}
}
