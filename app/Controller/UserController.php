<?php
namespace SvnPQA\controller;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
use Lite\Core\Result;
use Lite\CRUD\ControllerInterface;
use SvnPQA\model\User;

class UserController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INDEX => array(
				'fields' => array('name', 'user_group_id', 'real_name', 'state')
			),
			self::OP_STATE => array(),
			self::OP_UPDATE => array(
				'fields' => array('name', 'user_group_id', 'real_name', 'state')
			)
		);
	}

	public function updatePassword($get, $post){
		$id = $get['id'];
		$user = User::findOneByPk($id);

		if($post){
			if(!$post['password']){
				return new Result('请输入密码');
			}
			if($post['password'] != $post['repeat_password']){
				return new Result('两次输入的密码不一致，请重新输入');
			}
			$user->password = md5($post['password']);
			$user->save();
			return new Result('密码修改成功', true);
		}

		return array(
			'data' => $user
		);
	}

	public function index($search){
		$result = Result::convert(parent::index($search));
		$result->addData(array(
			'operation_link_list' => array(function(User $item){
				return '<a href="'.Router::getUrl('user/updatePassword', array('id'=>$item->id)).'" rel="popup">修改密码</a>';
			})
		));
		return $result;
	}

	public function update($get, $post){
		if($post){
			if($post['password']){
				$post['password'] = md5($post['password']);
			}else{
				unset($post['password']);
			}
		}
		return parent::update($get, $post);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'SvnPQA\model\User';
	}
}