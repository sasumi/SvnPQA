<?php
namespace www\controller;
use Lite\CRUD\ControllerInterface;
use www\model\WorkProcess;
use www\model\WorkStage;
use function Lite\func\array_group;
use function Lite\func\array_orderby;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: Sasumi
 * Date: 2015/10/18
 * Time: 16:34
 */
class WorkProcessController extends BaseController implements ControllerInterface {
	public function index(){
		$process_list = array();
		$all_process = WorkProcess::find()->all(true);
		$all_process = array_group($all_process, 'work_stage_id');

		foreach(WorkStage::$work_stage_list as $stage_id=>$name){
			$rs = array();
			$ps = $all_process[$stage_id] ?: array();
			array_orderby($ps, 'ord', SORT_DESC);
			foreach($ps as $p){
				$rs[] = new WorkProcess($p);
			}
			$process_list[$stage_id] = $rs;
		}

		return array(
			'process_list' => $process_list
		);
	}

	/**
	 * get curd support operation list
	 * @return array
	 */
	public function supportCRUDList(){
		return array(
			self::OP_STATE => array(),
			self::OP_UPDATE => array(
				'fields' => array('work_stage_id', 'name','state')
			)
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\WorkProcess';
	}
}