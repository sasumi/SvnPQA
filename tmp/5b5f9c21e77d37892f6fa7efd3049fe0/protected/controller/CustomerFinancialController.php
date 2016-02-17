<?php
namespace www\controller;

use Lite\CRUD\ControllerInterface;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
class CustomerFinancialController extends BaseController implements ControllerInterface {
	public function __construct(){
		parent::__construct();
	}

	public function supportCRUDList(){
		return array(
			self::OP_INDEX  => array(
				'fields' => array(
					'account_name',
					'account_bank',
					'account_no',
					'tax_no',
				),
			),
			self::OP_UPDATE => array(
				'fields' => array(
					'account_name',
					'account_bank',
					'account_no',
					'tax_no',
					'desc',
				),
			),
			self::OP_INFO   => array(),
			self::OP_DELETE   => array(),
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\CustomerFinancial';
	}
}