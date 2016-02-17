<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableStoreLog;

/**
 * User: Lite Scaffold
 * Date: 2015-11-17
 * Time: 16:36:09
 */
class StoreLog extends TableStoreLog implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'store_id' => array(
				'options' => function(){
					$tmp = Store::find('state=?', Store::STATE_ENABLED)->all(true);
					return array_combine(array_column($tmp, 'id'),array_column($tmp, 'name'));
				},
				'display' => function(self $item){
					$tmp = Store::findOneByPk($item->store_id);
					if(!$tmp){
						return '';
					}
					return $tmp->state == Store::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
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