<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use Lite\CRUD\MultiLevelModelInterface;
use www\db_definition\TableDepartment;
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
class Department extends TableDepartment implements ModelInterface, MultiLevelModelInterface {
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
					$data = User::find('state=?', User::STATE_ENABLED)->field('id', 'name')->all(true);
					return array_combine(array_column($data, 'id'), array_column($data, 'name'));
				},
				'display' => function(self $item){
					$tmp = User::findOneByPk($item->manager_id);
					if(!$tmp){
						return '';
					}
					return $tmp->state == User::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
				},
			),
			'stage_id' => array(
				'options' => function(){
					return WorkStage::$work_stage_list;
				},
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

	/**
	 * 上级ID标识
	 * @return mixed
	 */
	public function getParentIdField(){
		return 'parent_id';
	}

	/**
	 * 用于显示的字段名
	 * @return mixed
	 */
	public function getDisplayField(){
		return 'name';
	}

	/**
	 * 最大限制层级深度（缺省|0 为不限制）
	 * @return mixed
	 */
	public function getMaxLevelCount(){
		return 0;
	}
}