<?php
namespace www\controller;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
use Lite\Core\Result;
use Lite\CRUD\ControllerInterface;
use Lite\DB\Model;
use www\model\AccessAction;
use www\model\UserGroup;
use www\model\UserGroupAuth;
use function Lite\func\array_orderby;

class UserGroupController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INDEX => array(),
			self::OP_STATE => array(),
			self::OP_UPDATE => array()
		);
	}

	public function index($search){
		$result = Result::convert(parent::index($search));
		$result->addData(array(
			'operation_link_list' => array(function(UserGroup $item){
				return '<a href="'.$this->getUrl('UserGroup/updateUserGroupAccess', array('user_group_id'=>$item->id)).'">权限列表</a>';
			})
		));
		return $result;
	}

	public function updateUserGroupAccess($get, $post){
		$user_group_id = $get['user_group_id'] ?: $post['user_group_id'];

		if(self::isPost()){
			$ex = Model::transaction(function()use($post, $user_group_id){
				$con = "user_group_id = '".addslashes($user_group_id)."'";
				UserGroupAuth::deleteWhere(0, $con);
				$data = array();
				if($post['act_bids']){
					foreach($post['act_bids'] as $act_id){
						$data[] = array(
							'user_group_id' => $user_group_id,
							'action_id' => $act_id,
							'type' => UserGroupAuth::TYPE_BLACK
						);
					}
				}
				if($post['act_wids']){
					foreach($post['act_wids'] as $act_id){
						$data[] = array(
							'user_group_id' => $user_group_id,
							'action_id' => $act_id,
							'type' => UserGroupAuth::TYPE_BLACK
						);
					}
				}
				if($data){
					UserGroupAuth::insertMany($data);
				}
			});
			return new Result(!$ex ? '操作成功' : $ex->getMessage(), !$ex, null, $this->getUrl('UserGroup'));
		}

		if(!$user_group_id){
			$tmp = UserGroup::find()->one();
			$user_group_id = $tmp->id;
		}

		$act_list = AccessAction::find()->all(true);
		$act_ids = array_column($act_list, 'id');

		//user_group values
		$w_user_group_values = $b_user_group_values = array();
		if($act_ids){
			$user_group_values = UserGroupAuth::find('action_id IN ? AND user_group_id = ?', $act_ids, $user_group_id)->all(true);
			foreach($user_group_values as $val){
				if($val['type'] == UserGroupAuth::TYPE_WHITE){
					$w_user_group_values[$val['action_id']] = $val;
				} else {
					$b_user_group_values[$val['action_id']] = $val;
				}
			}
		}

		array_orderby($act_list, 'desc', SORT_DESC);
		$white_list = $black_list = array();

		foreach($act_list as $act){
			$a = $this->convertPathToArray('全部/'.$act['desc'], array($act['id'], $act['uri'], !!$w_user_group_values[$act['id']]));
			$white_list = array_merge_recursive($white_list, $a);

			$b = $this->convertPathToArray('全部/'.$act['desc'], array($act['id'], $act['uri'], !!$b_user_group_values[$act['id']]));
			$black_list = array_merge_recursive($black_list, $b);
		}

		return array(
			'user_group_id' => $user_group_id,
			'auth_list' => array($white_list, $black_list),
			'user_group_list' => UserGroup::find()->all()
		);
	}


	/**
	 * convert path to array
	 * @param $path
	 * @param array $bind_data
	 * @param string $delimiter
	 * @return array
	 */
	private function convertPathToArray($path, $bind_data = array(), $delimiter = '/'){
		$ps = explode($delimiter, $path);

		$ret = array();
		$k = array_shift($ps);
		if(count($ps) > 1){
			$ret[$k] = $this->convertPathToArray(join($delimiter, $ps), $bind_data, $delimiter);
		} else {
			$ret[$k][$ps[0]] = $bind_data;
		}
		return $ret;
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\UserGroup';
	}
}