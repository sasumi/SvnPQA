<?php
namespace www\controller;
use Lite\Component\Uploader;
use Lite\Core\Config;
use Lite\Core\Result;
use function Lite\func\array_first;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 30/11/2014
 * Time: 21:47
 */
class UploadController extends BaseController {
	public function file($get){
		if($this->isPost()) {
			$file = $_FILES['file'];
			if (empty($file['name'])) {
				return new Result('请选择文件', false);
			}
			$url_prefix = Config::get('upload/url');
			$uploader = new Uploader(array(
				'upload_dir' => Config::get('upload/path'),
				'file_name_converter' => Config::get('upload/file_name_converter'),
				'max_size' => Config::get('upload/max_size'),
				'file_type' => Config::get('upload/file_type')
			));
			$result = $uploader->upload($errors);

			if($errors){
				return new Result(array_first($errors));
			}
			return new Result('上传成功', true, array(
				'url' => $url_prefix.$result['file'],
				'name' => $result['file'],
				'value' => $result['file']
			));
		}
		return new Result('请选择上传文件');
	}

	/**
	 * check upload progress
	 */
	public function progress(){
		session_start();
		$key = ini_get("session.upload_progress.prefix") . 'file';
		if (!empty($_SESSION[$key])) {
			$current = $_SESSION[$key]["bytes_processed"];
			$total = $_SESSION[$key]["content_length"];
			echo $current < $total ? ceil($current / $total * 100) : 100;
		}
		else {
			echo 100;
		}
		exit;
	}
}