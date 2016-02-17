<?php
namespace SvnPQA\controller;

use Captcha;
use Lite\Component\Request;
use Lite\Core\Config;
use Lite\Core\Result;
use Lite\Core\Router;
use SvnPQA\Auth;
use SvnPQA\model\User;
use function Lite\func\dump;

class IndexController extends BaseController {
	public function index($search){
	}

	public function login($get, $post) {
		$access = Auth::instance();
		$use_captcha = Config::get('app/login/use_captcha');

		if($access->isLogin()){
			Router::jumpTo('user');
		}

		if($post){
			if($use_captcha){
				if(empty($post['captcha'])){
					return new Result('请输入验证码', false, 'captcha');
				}
				if(strtolower($post['captcha']) != strtolower(Auth::getCaptcha())){
					Auth::setCaptcha('');
					return new Result('您输入的验证码不正确，请重新输入', false, 'captcha');
				}
				Auth::setCaptcha('');
			}

			if(!User::find('name=?',$post['name'])->count()){
				return new Result('当前用户名未登记');
			}

			$user_info = User::validatePsw($post['name'], $post['password']);
			if($user_info){
				if($post['auto_login']){
					$access->setCookieExpired(Config::get('app/login/expired'));
				} else {
					$access->setCookieExpired(0);
				}
				Auth::instance()->login($user_info);
				return new Result('登录成功', true, null, Router::getUrl());
			}
			return new Result('用户名或密码错误');
		}

		return array(
			'use_captcha' => $use_captcha
		);
	}

	public function logout() {
		Auth::instance()->logout();
		return new Result('退出成功', true, null, Router::getUrl('index/login'));
	}

	public function captcha(){
		$cfg = Config::get('app/login/captcha');
		$cap = new Captcha();
		$cap->width  = $cfg['width'];
		$cap->height = $cfg['height'];
		$cap->maxWordLength = $cfg['words'];
		$cap->minWordLength = $cfg['words'];
		$cap->fontSize      = $cfg['font_size'];
		$text = null;
		$cap->CreateImage($text);
		Auth::setCaptcha($text);
		die;
	}

	public function uploadImage(){
		if (Router::isPost()) {
			$file = $_FILES['file'];
			if (empty($file['name'])) {
				return new Result('请选择文件', false);
			}

			$ext = $this->getFileExt($file['type']);

			if (!$ext) {
				return new Result('文件类型不符合，请重新选择文件上传', false);
			}

			$rsp = Request::postFiles(Config::get('upload/host'), array(), array('file'=>$file['tmp_name']));
			$result = json_decode($rsp, true);
			if($result['code'] == '0'){
				return new Result('图片上传成功', null, array(
					'src' => Config::get('upload/url').$result['data'],
					'value' => $result['data'],
				));
			}
			return new Result('图片上传失败，请稍候重试', null, $rsp);
		}
		return array(
			'UPLOAD_PAGE_URL' => Router::getUrl('index/uploadImage')
		);
	}

	/**
	 * get file extension
	 *
	 * @param $mime_info
	 * @return mixed
	 */
	private function getFileExt($mime_info)
	{
		$map = array(
			'image/gif' => 'gif',
			'image/jpeg' => 'jpg',
			'image/png' => 'png'
		);
		return $map[$mime_info];
	}
}
