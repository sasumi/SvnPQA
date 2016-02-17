<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableSampleMouldCategory;

/**
 * User: Lite Scaffold
 * Date: 2016-01-07
 * Time: 23:10:58
 */
class SampleMouldCategory extends TableSampleMouldCategory implements ModelInterface {
	const STATE_DISABLED = 0;
	const STATE_ENABLED = 1;

	public function __construct($data = array()){
		parent::__construct($data);
	}

	/**
	* get state key
	* @return string
	*/
	public function getStateKey(){
		return 'state';
	}
}