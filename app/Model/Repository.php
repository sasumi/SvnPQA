<?php
namespace SvnPQA\model;
use Lite\CRUD\ModelInterface;
use function Lite\func\dump;
use SvnPQA\model\table\TableRepository;

/**
 * User: Lite Scaffold
 * Date: 2015-12-22
 * Time: 09:16:49
 */
class Repository extends TableRepository implements ModelInterface{
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'password' => array(
				'type' => 'password',
			),
		));
	}

	public function getStateKey()
	{
		// TODO: Implement getStateKey() method.
	}
}