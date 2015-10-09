<?php
namespace SvnPQA\controller;

use Lite\Core\Config;
use Lite\Component\Paginate;
use Lite\Core\Result;
use SvnPQA\Model\Access;

class AdminController extends BaseController {
	public function index() {
		$this->jumpTo('admin/showAdminList');
	}

	public function login($get, $post) {
		$access = Access::instance();
		$use_captcha = Config::get('app/login_captcha');

		if($access->isLogin()){
			$this->jumpTo('user');
		}

		if($post){
			if($use_captcha){
				if(empty($post['captcha'])){
					return new Result('请输入验证码', false, 'captcha');
				}
				if(strtolower($post['captcha']) != strtolower(Access::getCaptcha())){
					Access::setCaptcha('');
					return new Result('您输入的验证码不正确，请重新输入', false, 'captcha');
				}
				Access::setCaptcha('');
			}

			$rsp = Authentication::login($post['email'], $post['password']);
			if($rsp->success()){
				$login_data = $rsp->getData();
				if($post['auto_login']){
					$access->setCookieExpired($login_data['expired']);
				} else {
					$access->setCookieExpired(0);
				}
				$access->loginById($login_data['uid']);
				$_SESSION['sign'] = $login_data['sign'];
				return new Result('登录成功', true, null, $this->getUrl());
			}
			return new Result($rsp->getMessage(), false, 'email');
		}

		return array(
			'use_captcha' => $use_captcha
		);
	}

	public function logout() {
		Access::instance()->logout();
		$this->login_user = null;
		return new Result('退出成功', true, null, $this->getUrl('admin/login'));
	}

	public function showAdminList($search) {
		$cond = '1=1';
		if(strlen($search['kw'])){
			$cond .= ' AND admin_name LIKE \'%' . addslashes($search['kw']) . '%\'';
		}
		if($search['role_id']){
			$cond .= ' AND role_id = ' . (int)$search['role_id'];
		}

		$page = Paginate::instance();
		$page->setPageSize(15);

		$role_list = AdminRole::find()->all();
		$admin_list = Admin::find($cond)->order('create_time DESC')->paginate($page);

		return array(
			'search' => $search,
			'page' => $page,
			'user_list' => $admin_list,
			'role_list' => $role_list
		);
	}

	public function updateUser($get, $post) {
		$id = (int)$get['id'];
		$user = $id ? Admin::findOneByPk($id) : new Admin();

		if($post){
			if(!$id){
				if($post['password']){
					$post['password'] = md5($post['password']);
				}
				if(Admin::find('admin_name=?', $post['admin_name'])->count()){
					return new Result('该用户名已经存在');
				}
			}
			else {
				if(Admin::find('admin_name=? AND id!=?', $post['admin_name'], $user->id)->count()){
					return new Result('该用户名已经存在');
				}
				if(empty($post['password'])){
					$post['password'] = $user->password;
				}
				else {
					$post['password'] = md5($post['password']);
				}
			}
			$user->setValues($post);
			$result = !!$user->save();
			return new Result($result ? '操作成功' : '操作失败，请重试', $result, null, $result ? $this->getUrl('admin/showAdminList') : null);
		}

		$role_list = AdminRole::find()->all(true);
		return array(
			'role_list' => $role_list,
			'user' => $user
		);
	}

	public function deleteUser($get) {
		$current_id = Access::instance()->getLoginUserId();
		$id = (int)$get['id'];
		$result = false;
		if($id){
			if($current_id == $id){
				return new Result('您不能对自己账号操作');
			}
			$user = Admin::findOneByPk($id);
			if($user){
				$result = $user->delete();
			}
		}
		return new Result($result ? '操作成功' : '操作失败', $result);
	}

	public function enableUser($get) {
		$id = (int)$get['id'];
		return $this->updateUserState($id, true);
	}

	public function disableUser($get) {
		$id = (int)$get['id'];
		return $this->updateUserState($id, false);
	}

	public function updateUserState($get) {
		$id = (int)$get['id'];
		$toState = (int)$get['toState'];
		if($id){
			$current_id = Access::instance()->getLoginUserId();
			if($current_id == $id){
				return new Result('您不能对自己账号操作1');
			}
			$result = Admin::updateByPk($id, array(
				'is_del' => $toState ? 0 : 1
			));
			if($result){
				return new Result('操作成功', true, null, $this->getUrl('admin/showAdminList'));
			}
		}
		return new Result('操作失败，请稍候重试2');
	}

	public function showRoleList() {
		$role_list = AdminRole::find()->all(true);
		if(!empty($role_list)){
			foreach($role_list as $key => $role){
				$role['default_type'] = (int)$role['default_type'];
				$role_list[$key]['default_type_txt'] = AdminRole::$default_type_list[$role['default_type']];
			}
		}
		return array(
			'role_list' => $role_list
		);
	}

	public function deleteRole($get) {
		$id = (int)$get['id'];
		$result = AdminRole::delByPk($id);
		return new Result($result ? '操作成功' : '操作失败，请重试', $result, null, $result ? $this->getUrl('admin/showRoleList') : null);
	}

	public function updateRoleState($get) {
		$id = (int)$get['id'];
		$toState = $get['toState'];

		$result = !!AdminRole::updateByPk($id, array(
			'is_del' => $toState ? '1' : 0
		));
		return new Result($result ? '操作成功' : '操作失败，请重试', $result, null, $result ? $this->getUrl('admin/showRoleList') : null);
	}

	public function updateRole($get, $post) {
		$id = (int)$get['id'];
		$role = $id ? AdminRole::findOneByPk($id) : new AdminRole();
		if($post){
			if(!$id){
				if(AdminRole::find('name=?', $post['name'])->count()){
					return new Result('该角色已经存在');
				}
			}
			else {
				if(AdminRole::find('name=? AND id!=?', $post['name'], $role->id)->count()){
					return new Result('该用户名已经存在');
				}
			}
			$role->setValues($post);
			$result = !!$role->save();
			return new Result($result ? '操作成功' : '操作失败，请重试', $result, null, $result ? $this->getUrl('admin/showRoleList') : null);
		}

		return array(
			'default_type_list' => AdminRole::$default_type_list,
			'role' => $role
		);
	}

	public function access(){
		$access_alias_list = Config::get('access_alias');
		return array(
			'access_alias_list' => $access_alias_list
		);
	}
}