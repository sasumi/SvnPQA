<?php
namespace SvnPQA\controller;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
use SvnPQA\deepcategory\Controller;

class DepartmentController extends Controller{
	public function supportCRUDList(){
		return array(self::OP_STATE, self::OP_INFO, self::OP_UPDATE);
	}

	public function getRenderViewList(){
		return 'department/index.php';
	}

	public function getRenderViewUpdate(){
		return 'department/update.php';
	}

	public function getModelName(){
		return 'SvnPQA\model\Department';
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
	 * @return string
	 */
	function getCatalogName(){
		return '部门';
	}
}