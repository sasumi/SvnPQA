<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use Lite\CRUD\MultiLevelModelInterface;
use www\db_definition\TableSampleCategory;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:01
 */
class SampleCategory extends TableSampleCategory implements ModelInterface, MultiLevelModelInterface{
	const STATE_DISABLED = 0;
	const STATE_ENABLED = 1;

	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'parent_id' => array(
				'options' => function(self $item=null){
					$tmp = self::find('state=?', self::STATE_ENABLED)->order('id ASC')->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				},
				'display' => function(self $item=null){
					if($item->parent_id){
						$tmp = self::findOneByPk($item->parent_id);
						if(!$tmp){
							return '';
						}
						return $tmp->state == SampleCategory::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
					}
					return '顶级';
				}
			)
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
	public function getParentIdField() {
		return 'parent_id';
	}

	/**
	 * 用于显示的字段名
	 * @return mixed
	 */
	public function getDisplayField() {
		return 'name';
	}

	/**
	 * 最大限制层级深度（缺省|0 为不限制）
	 * @return mixed
	 */
	public function getMaxLevelCount() {
		return 0;
	}
}