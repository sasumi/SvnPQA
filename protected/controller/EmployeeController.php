<?php
namespace SvnPQA\controller;

/**
 * Created by PhpStorm.
 * Employee: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
use Lite\Component\Paginate as Paginate;
use SvnPQA\Model\Employee;

class EmployeeController extends BaseController{
	public function supportCRUDList(){
		return array(self::OP_STATE, self::OP_INFO, self::OP_UPDATE);
	}

	public function getModelName(){
		return 'SvnPQA\model\Employee';
	}

	public function index($search){
		$con = '1=1';
		if($search['kw']){
			$con .= " AND name LIKE '%".addslashes($search['kw'])."%' OR real_name LIKE '%".$search['kw']."%'";
		}

		$paginate = Paginate::instance();
		$employee_list = Employee::find($con)->order('id DESC')->paginate($paginate);
		return array(
			'search' => $search,
			'paginate' => $paginate,
			'employee_list' => $employee_list
		);
	}
}