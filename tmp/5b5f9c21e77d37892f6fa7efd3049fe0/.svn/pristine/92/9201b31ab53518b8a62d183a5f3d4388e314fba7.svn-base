<?php
namespace www\controller;

use Lite\Component\Paginate;
use Lite\Core\Result;
use www\model\AccessAction;
use www\model\UserGroupAuth;
use function Lite\func\array_group;
use function Lite\func\array_orderby;
use function Lite\func\dump;

class AccessController extends BaseController {
	public function index(){
		$paginate = Paginate::instance();
		$action_list = AccessAction::find()->order('id DESC')->paginate($paginate);
		return array(
			'action_list' => $action_list,
			'paginate' => $paginate
		);
	}

	public function updateAccess($get, $post){
		$id = $get['id'];
		$action_info = array();
		if($id){
			$action_info = AccessAction::findOneByPk($id);
		}
		if($post){
			if(!$id){
				$action_info = new AccessAction();
			}
			try {
				$action_info->setValues($post);
				$action_info->save();
			} catch (\Exception $ex){
				return new Result('操作失败' . $ex->getMessage(), false);
			}
			return new Result('操作成功', true);
		}
		return array(
			'action_info' => $action_info,
		);
	}

	public function removeAccess($get){
		$id = $get['id'];
		AccessAction::delByPk($id);
		return new Result('操作成功', true);
	}

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
}