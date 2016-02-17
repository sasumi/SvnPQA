<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableDepartment;
use www\ViewBase;
use function Lite\func\array_filter_subtree;
use function Lite\func\array_group;
use function Lite\func\array_unshift_assoc;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:29
 */
class Department extends TableDepartment implements ModelInterface {
	public function __construct($data=array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'parent_id' => array(
				'alias'=>'上级部门',
				'options' => function(){
					$data = Department::find()->field('id', 'parent_id', 'name')->all(true);
					$tmp = array_combine(array_column($data, 'id'), array_column($data, 'name'));
					array_unshift_assoc($tmp, 0, '顶级');
					return $tmp;
				},
				'form' => function($val=null, self $instance=null){
					$data = Department::find()->field('id', 'parent_id', 'name')->all(true);
					return ViewBase::generateParentTreeSelector($data, $instance);
				},
			),
			'manager_id' => array(
				'alias'=>'负责人',
				'options' => function(){
					$data = User::find('state=?', User::STATE_ENABLE)->field('id', 'name')->all(true);
					return array_combine(array_column($data, 'id'), array_column($data, 'name'));
				}
			),
			'stage_id' => array(
				'options' => function(){
					$tree = WorkProcess::getProcessInOrder();
					foreach($tree as $k=>$item){
						$tree[$k]['name_deep'] = $item['state_name'].' - '.$item['name'];
					}
					return array_combine(array_column($tree, 'id'), array_column($tree, 'name_deep'));
				}
			),
			'stage_name' => array(
				'getter'=>function($item){
					if($item->stage_id){
						return WorkStage::$work_stage_list[$item->stage_id];
					}
					return '';
				},
				'alias'=>'负责流程'
			),
		));
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
		return 'state';
	}
}