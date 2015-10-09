<?php
namespace SvnPQA\controller;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
use Lite\Component\Paginate as Paginate;
use SvnPQA\Model\User;

class UserController extends BaseController{
	public function supportCRUDList(){
		return array(self::OP_STATE, self::OP_INFO, self::OP_UPDATE);
	}

	public function getModelName(){
		return 'SvnPQA\model\User';
	}

	public function getStateKey(){
		return 'state';
	}

	public function index($search){
		$con = '1=1';
		if($search['kw']){
			$con .= " AND name LIKE '%".addslashes($search['kw'])."%' OR real_name LIKE '%".$search['kw']."%'";
		}

		$paginate = Paginate::instance();
		$user_list = User::find($con)->order('id DESC')->paginate($paginate);
		return array(
			'search' => $search,
			'paginate' => $paginate,
			'user_list' => $user_list
		);
	}

	public function updatePassword(){

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
}