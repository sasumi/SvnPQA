<?php
namespace www\controller;

use Lite\CRUD\ControllerInterface;
use www\model\CustomerContact;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
class CustomerContactController extends BaseController implements ControllerInterface {
	public function __construct(){
		parent::__construct();
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\CustomerContact';
	}

	public function supportCRUDList(){
		return array(
			self::OP_INDEX  => array(),
			self::OP_UPDATE => array(
				'fields' => array(
					'id',
					'chinese_name',
					'english_name',
					'birthday',
					'office_position',
					'mobile',
					'tel',
					'email',
					'desc',
				),
			),
			self::OP_INFO   => array()
		);
	}

	/**
	 * @param $get
	 */
	public function ajaxGetCustomerConTactList($get){
		$customer_id = $get['customer_id'];
		$customer_contact_list = CustomerContact::find("customer_id = ?", $customer_id)
			->select('id, chinese_name, tel, email ')
			->order('id asc')
			->all(true);

		echo json_encode($customer_contact_list);
		exit;
	}
}