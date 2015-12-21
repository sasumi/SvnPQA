<?php
namespace SvnPQA\model;
use Lite\DB\Model;
use function Lite\func\array_group;

/**
 * Created by PhpStorm.
 * User: Sasumi
 * Date: 2015/10/10
 * Time: 14:26
 */

class UserAuth extends Model{
	const TYPE_WHITE = 0;
	const TYPE_BLACK = 1;

	public static $type_list = array(
		self::TYPE_BLACK => '黑名单',
		self::TYPE_WHITE => '白名单',
	);

	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'user' => array('getter'=>function($item){
				return User::findOneByPk($item->user_id);
			}),
			'action' => array('getter'=>function($item){
				$all = AccessAction::find()->all(true);
				$all = array_group($all, 'id', true);
				return new AccessAction($all[$item->action_id]);
			}),
			'type_text' => array('getter'=>function($item){
				return self::$type_list[$item->type];
			})
		));
		parent::__construct($data);
	}

	/**
	 * 当前表名接口
	 * @return string
	 */
	public function getTableName(){
		return 'user_auth';
	}

	/**
	 * 获取当前设置主键
	 * @return string
	 */
	public function getPrimaryKey(){
		return 'id';
	}
}