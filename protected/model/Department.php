<?php
namespace SvnPQA\Model;
use function Lite\func\array_group;
use function Lite\func\dump;
use SvnPQA\deepcategory\Model;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:29
 */
class Department extends Model {
	public function __construct(){
		$this->setFilterRules(
			array(
				'manager_id'=>array(
					'TO_INT'=>''
				),
				'description' => array(
					'TO_TRIM' => '',
				)
			)
		);
		$this->setPropertiesDefine(array(
			'manager' => array('getter'=>function($item){
				$user_list = User::find()->all(true);
				$user_list = array_group($user_list, 'id', true);
				return new User($user_list[$item->manager_id]);
			})
		));
		parent::__construct();
	}

	/**
	 * current model table name
	 * @return string
	 */
	public function getTableName() {
		return 'department';
	}

	/**
	 * current mode primary key
	 * @return string
	 */
	public function getPrimaryKey() {
		return 'id';
	}
}