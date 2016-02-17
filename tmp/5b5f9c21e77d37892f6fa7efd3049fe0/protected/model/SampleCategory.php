<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableSampleCategory;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:01
 */
class SampleCategory extends TableSampleCategory implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'parent_id' => array(
				'options' => function($item=null){
					if($item){
						$tmp = self::find('id !=? AND parent_id = 0',$item->id)->order('id ASC')->all(true);
					} else {
						$tmp = self::find()->order('id ASC')->all(true);
					}
					$tmp[] = array(
						'id' => 0,
						'name' => '顶级分类'
					);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
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
}