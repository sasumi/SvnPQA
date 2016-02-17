<?php
namespace www\controller;

use Lite\Component\Paginate;
use Lite\Core\Result;
use Lite\CRUD\ControllerInterface;
use www\model\UserGroupAuth;
use function Lite\func\array_group;
use function Lite\func\array_orderby;
use function Lite\func\dump;

class AccessController extends BaseController implements ControllerInterface {
	public function userGroup(){
		$paginate = Paginate::instance();
		$auth_list = UserGroupAuth::find()->paginate($paginate);
		return array(
			'auth_list' => $auth_list,
			'paginate' => $paginate
		);
	}

	public function removeUserGroup($get){
		UserGroupAuth::delByPk($get['id']);
		return new Result('操作成功', true);
	}

	/**
	 * get curd support operation list
	 * @return array
	 */
	public function supportCRUDList(){
		return array(
			self::OP_INDEX => array(),
			self::OP_DELETE => array(),
			self::OP_UPDATE => array(),
			self::OP_QUICK_SEARCH => array(
				'fields'=>array('uri','desc')
			),
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\AccessAction';
	}
}