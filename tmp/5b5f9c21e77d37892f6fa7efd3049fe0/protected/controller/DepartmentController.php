<?php
namespace www\controller;
use Lite\Component\Paginate;
use Lite\Core\Result;
use Lite\CRUD\ControllerInterface;
use www\model\Department;
use function Lite\func\array_filter_subtree;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class DepartmentController extends BaseController implements ControllerInterface{
	public function supportCRUDList(){
		return array(
			self::OP_INDEX => array(),
			self::OP_UPDATE => array(
				'fields' => array('name', 'manager_id', 'parent_id', 'stage_id', 'description', 'state')
			),
			self::OP_STATE => array(),
		);
	}

	public function index($search){
		$result = Result::convert(parent::index($search)) ;
		$list = Department::find()->all(true);
		$list = array_filter_subtree(0, $list);
		$data_list = array();

		foreach($list as $k=>$item){
			$item['name'] = str_repeat('　',$item['tree_level']*3).'|-'.$item['name'];
			$data_list[] = new Department($item);
		}
		$paginate = Paginate::instance();
		$paginate->paginateData($data_list);
		$result->addData(array(
			'data_list' => $data_list,
			'paginate' => $paginate
		));
		return $result;
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\Department';
	}
}