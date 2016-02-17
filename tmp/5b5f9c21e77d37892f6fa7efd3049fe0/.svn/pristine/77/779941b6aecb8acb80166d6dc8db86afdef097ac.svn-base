<?php
namespace www\controller;

/**
 * Created by PhpStorm.
 * Employee: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

use Lite\CRUD\ControllerInterface;

class EmployeeController extends BaseController implements ControllerInterface{

	/**
	 * get curd support operation list
	 * @return array
	 */
	public function supportCRUDList(){
		return array(
			self::OP_INDEX => array(
				'fields' => array(
					'employee_no',
					'name',
					'pay_type',
					'work_flow_type',
					'address',
					'tel',
					'state'
				)
			),
			self::OP_UPDATE => array(),
			self::OP_INFO => array(),
			self::OP_STATE => array(),
			self::OP_DELETE => array()
		);
	}

	public function update($get, $post){
		if($post){
			$post['entry_time'] = $post['entry_time'] ?: 0;
			$post['leave_time'] = $post['leave_time'] ?: 0;
			$post['birthday'] = $post['birthday'] ?: 0;
		}
		return parent::update($get, $post);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\Employee';
	}
}