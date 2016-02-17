<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableWorkProcess;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-10-18
 * Time: 16:49:16
 */
class WorkProcess extends TableWorkProcess implements ModelInterface {
	const STATE_DISABLED = 0;
	const STATE_ENABLED = 1;

	public function __construct($data = array()){
		parent::__construct($data);

		$this->setPropertiesDefine(array(
			'work_stage_id' => array(
				'type' => 'enum',
				'options' => function(){
					return WorkStage::$work_stage_list;
				}
			),
			'state_text' => array('getter'=>function($item){
				return !$item->state ? '禁用': '启用';
			})
		));
	}

	public static function getProcessInOrder($all=false){
		$data = self::find('state=?', self::STATE_ENABLED)->order('id ASC')->all(true);
		foreach($data as $k=>$item){
			$data[$k]['state_name'] = WorkStage::$work_stage_list[$item['work_stage_id']];
		}
		return $data;
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
		return 'state';
	}
}