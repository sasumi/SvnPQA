<?php
namespace SvnPQA\Model;

use Lite\DB\Model;
use Lite\Core\Hooker;

class AdminRole extends Model {
	const DEFAULT_DENY = 0;		//默认缺省权限为阻止
	const DEFAULT_ALLOW = 1;

	public static $default_type_list = array(
		'0' => '禁止',
		'1' => '开放'
	);

	public function __construct(){
		$filters = array(
			'name' => array(
				'TO_TRIM' => '',
				'REQUIRE' => '必须输入角色名称',
			),
			'allow' => array(
				'TO_TRIM' => '',
			),
			'deny' => array(
				'TO_TRIM' => '',
			),
			'default_type' => array(
				'TO_INT' => '',
			),
			'is_del' => array(
				'DEFAULT' => 0,
				'TO_INT' => ''
			)
		);
		$this->setFilterRules($filters);
	}
	public function getTableName(){
		return "admin_role";
	}

	public function getPrimaryKey(){
		return "id";
	}

	public function checkRuleAllow($rule='', &$message=''){
		if($this->is_del){
			$message = 'ROLE DISABLED';
			Hooker::fire('ACCESS_CHECK_DENY', $message);
			return false;
		}

		$allow_list = explode(',', $this->allow);
		array_walk($allow_list, 'trim');
		array_walk($allow_list, function($val){
			return strtolower($val);
		});

		$deny_list = explode(',', $this->deny);
		array_walk($deny_list, 'trim');
		array_walk($deny_list, function($val){
			return strtolower($val);
		});

		//deny优先
		foreach($deny_list as $deny){
			if($this->checkRuleIn($rule, $deny)){
				$message = $rule.' 《 '.$deny;
				Hooker::fire('ACCESS_CHECK_DENY', $message);
				return false;
			}
		}

		if($this->default_type == self::DEFAULT_ALLOW){
			$message = 'default_type:'.$this->default_type;
			Hooker::fire('ACCESS_CHECK_ALLOW', $message);
			return true;
		}

		//allow
		foreach($allow_list as $allow){
			if($this->checkRuleIn($rule, $allow)){
				$message = $rule.' 《 '.$allow;
				Hooker::fire('ACCESS_CHECK_ALLOW', $message);
				return true;
			}
		}
		$message = 'ACCESS RULE NO RULES MATCH';
		Hooker::fire('ACCESS_CHECK_DENY', $message);
		return false;
	}

	/**
	 * 检测 source_rule是否在target_rule之内
	 * @param string $source_rule
	 * @param string $target_rule
	 * @return boolean
	 */
	private function checkRuleIn($source_rule, $target_rule){
		$source_rule = strtolower($source_rule);
		$target_rule = strtolower($target_rule);

		list($src_ctrl, $src_act) = explode('/', $source_rule);
		$src_act = $src_act ?: '*';

		list($tag_ctrl, $tag_act) = explode('/', $target_rule);
		$tag_act = $tag_act ?: '*';


		if($tag_ctrl == '*' || $tag_ctrl == $src_ctrl){
			if($tag_act == '*' || $tag_act == $src_act){
				return true;
			}
		}
		return false;
	}
}