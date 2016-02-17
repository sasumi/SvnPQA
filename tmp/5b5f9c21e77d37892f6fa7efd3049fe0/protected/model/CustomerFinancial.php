<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableCustomerFinancial;

/**
 * User: Lite Scaffold
 * Date: 2015-12-12
 * Time: 14:42:20
 */
class CustomerFinancial extends TableCustomerFinancial implements ModelInterface{
	public function __construct($data = array()){
		parent::__construct($data);
	}

    /**
     * 获取模型状态key
     * @return string
     */
    public function getStateKey()
    {
        // TODO: Implement getStateKey() method.
    }
}