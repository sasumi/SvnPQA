<?php
namespace www;

use Lite\Component\AccessAdapter;
use Lite\Core\Router;
use www\model\AccessAction;
use www\model\User;
use www\model\UserGroupAuth;
use function Lite\func\array_group;
use function Lite\func\dump;

session_start();

class Auth extends AccessAdapter{
	public static function setCaptcha($code){
		$_SESSION['captcha'] = $code;
	}

	/**
	 * get captcha
	 * @return mixed
	 */
	public static function getCaptcha(){
		return $_SESSION['captcha'];
	}

	/**
	 * 权限白名单列表
	 * @var array
	 */
	private static $white_list = array(
		'index/login',
		'index/logout',
		'index/captcha',
		'exporter/*',
		'upload/*',
		'richeditor/*',
	);

	/**
	 * 是否对当前的action有权限
	 * @param $ctrl_act
	 * @param array $param
	 * @return string
	 */
	public static function getUrlAccessFlag($ctrl_act, $param=array()){
		$auth_tail_flag = 'HAS_NO_AUTH_TO_DISPLAY';
		list($controller, $action) = explode('/', trim($ctrl_act, '/'));
		if(!self::isAuthAction($controller, $action)){
			return $auth_tail_flag;
		}
		return '';
	}

	/**
	 * 检测URI是否为白名单
	 * @param $controller
	 * @param $action
	 * @return bool
	 */
	private static function inWhiteList($controller, $action){
		foreach(self::$white_list as $uri){
			if(self::uriCheck($controller, $action, $uri)){
				return true;
			}
		}
		return false;
	}

	public static function checkUriAccess($uri){
		list($c, $a) = explode('/', $uri);
		$a = $a ?: Router::getDefaultAction();
		return self::isAuthAction($c, $a);
	}

	private static function uriCheck($controller, $action, $uri){
		$controller = strtolower($controller);
		$action = strtolower($action);
		$uri = strtolower($uri);
		list($c, $a) = explode('/', $uri);
		if($c == '*'){
			return true;
		}
		if($c == $controller && ($a == '*' || $a == $action)){
			return true;
		}
		return false;
	}

	public static function checkAuth($controller, $action){
		if(!$controller || !$action){
			return;
		}

		$result = self::isAuthAction($controller, $action);
		if(!$result){
			if(!self::instance()->isLogin()){
				$url = Router::getUrl('index/login');
				$html = <<<EOT
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script>top.location.href="$url";</script>
</head>
<body>
	正在登录系统...
</body>
</html>
EOT;
				die($html);
			} else {
				//暂时不返回
				$viewer = new ViewBase();
				echo $viewer->render('index/deny.php', true);
				die;
			}
		}
	}

	/**
	 * 判断当前用户是否对action具有权限
	 * @param $controller
	 * @param $action
	 * @return bool
	 */
	public static function isAuthAction($controller, $action){
		$user_info = self::instance()->getLoginInfo();
		$user_group_id = $user_info['user_group_id'];

		if(self::inWhiteList($controller, $action)){
			return true;
		}

		//检测黑名单，如果命中，则立即返回
		$black_list = self::getActionList($user_group_id, UserGroupAuth::TYPE_BLACK);
		foreach($black_list as $act){
			if(self::uriCheck($controller, $action, $act['uri'])){
				return false;
			}
		}
		$white_list = self::getActionList($user_group_id, UserGroupAuth::TYPE_WHITE);
		foreach($white_list as $act){
			if(self::uriCheck($controller, $action, $act['uri'])){
				return true;
			}
		}
		return false;
	}

	public static function getLoginUserName(){
		$u = Auth::instance()->getLoginInfo();
		return $u['name'];
	}

	/**
	 * 获取所有权限列表
	 * @description 这里为了强制后台权限更新之后，刷新用户最新权限，
	 * 因此不做cache
	 * @param $user_group_id
	 * @param int $type 白名单0，黑名单1
	 * @return mixed
	 */
	private static function getActionList($user_group_id, $type=0){
		$tmp = UserGroupAuth::find('user_group_id = ? AND type = ?', $user_group_id, $type)->all(true);
		$action_id_list = array_column($tmp, 'action_id');
		$action_list = AccessAction::find('id IN ?', $action_id_list)->all(true);
		$action_list = array_group($action_list, 'id', true);
		foreach($tmp as $k=>$item){
			$tmp[$k]['uri'] = $action_list[$item['action_id']]['uri'];
		}
		return $tmp;
	}

	/**
	 * 从用户信息中获取用户ID
	 * @param $user
	 * @return mixed
	 */
	public function getIdFromUserInfo($user){
		return $user['id'];
	}

	/**
	 * 从用户ID中获取用户信息
	 * @param $user_id
	 * @return array | null
	 */
	public function getUserInfoFromId($user_id){
		return User::findOneByPk($user_id, true);
	}
}