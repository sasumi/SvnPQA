<?php
namespace SvnPQA\Model;

use Lite\Component\AccessAdapter;
use Lite\Core\Router;

class Access extends AccessAdapter {
	/**
	 * get user id from user info
	 * @param $user
	 * @return mixed
	 */
	public function getIdFromUserInfo($user) {
		return $user['uid'];
	}

	public static function checkLogin(){
		$access = self::instance();
		if(!$access->isLogin()){
			Router::jumpTo('user/login');
		}
	}

	/**
	 * get user info from user id
	 * @param $user_id
	 * @return array
	 */
	public function getUserInfoFromId($user_id) {
		//return Authentication::getUserInfo($user_id);
	}

	public static function setCaptcha($text){
		$_SESSION['captcha'] = $text;
	}

	public static function getCaptcha(){
		return $_SESSION['captcha'];
	}

	public static function checkUriAccess($uri){
		$uri = strtolower($uri);
		return true;
	}

	public static function getUrlAccessFlag($uri){
		$flag = self::checkUriAccess($uri);
		if($flag){
			return '';
		}
		return '#AUTH_DENY';
	}
}
