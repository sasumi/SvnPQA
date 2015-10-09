<?php
namespace SvnPQA\Model;

use Lite\DB\Model;

class Admin extends Model {
	private static $del_state_list = array(
		'0' => '正常',
		'1' => '禁用'
	);

	public function __construct(){
		$del_state_list = self::$del_state_list;

		$this->setPropertiesDefine(array(
			'admin_name' => array('unique'=>'当前账户名称已存在'),
			'role' => array('has_one'=>'AdminRole', 'source_key' => 'role_id'),
			'del_state' => array('getter' => function($item)use($del_state_list){
				return $del_state_list[$item->is_del];
			}),
			'del_state_class' => array('getter' => function($item){
				return $item->is_del ? 'label-warning' : 'label-normal';
			}),
			'del_state_html' => array('getter' => function($item){
				return '<span class="'.($item->del_state_class).'">'.$item->del_state.'</span>';
			}),
		));

		$this->setFilterRules(
			array(
				'admin_name' => array(
					'TO_TRIM' => '',
					'REQUIRE' => '必须输入账号名称',
				),
				'password' => array(
					'REQUIRE' => '必须输入密码',
					'MINLEN' => array('密码长度必须超过4个字符', 4)
				),
				'role_id' => array(
					'REQUIRE' => '请选择角色',
					'TO_INT' => ''
				),
				'email' => array(
					'TO_TRIM' => '',
				),
				'create_time' => array(
					'DEFAULT' => date('Y-m-d H:i:s')
				),
				'is_del' => array(
					'DEFAULT' => 1,
					'TO_INT' => '',
					'MAX' => array('系统错误', 1),
					'MIN' => array('系统错误', 0)
				)
			)
		);
	}

	public function getTableName(){
		return "admin";
	}

	public function getPrimaryKey(){
		return "id";
	}
}