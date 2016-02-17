<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\Auth;
use www\db_definition\TableCustomer;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:24:58
 */
class Customer extends TableCustomer implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);

		//extra properties define
		$this->setPropertiesDefine(array(
			'customer_no' => array(
				'description' => '规则：xxx-xx-33',
			),
			'create_time' => array('setter'=>function(){
				return time();
			}),
			'op_user_id' => array(
				'setter'=>function(){
					return Auth::instance()->getLoginUserId();
				},
				'options' => function(){
					$tmp = User::find()->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				}
			),
            'source' => array(
                'options' => function(){
                    $tmp = CustomerSource::find('state = ?', CustomerSource::STATE_ENABLED)->all(true);
                    return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
                },
				'display' => function(self $item){
					$tmp = CustomerSource::findOneByPk($item->source);
					if(!$tmp){
						return '';
					}
					return $tmp->state == CustomerSource::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
				},
            ),
            'type' => array(
                'options' => function(){
                    $tmp = CustomerType::find('state = ?', CustomerType::STATE_ENABLED)->all(true);
                    return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
                },
                'display' => function(self $item){
	                $tmp = CustomerType::findOneByPk($item->type);
	                if(!$tmp){
		                return '';
	                }
	                return $tmp->state == CustomerType::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
                },
            ),
		));
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){

	}
}