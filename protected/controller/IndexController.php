<?php
namespace SvnPQA\controller;

use Lite\Core\Config;
use Lite\Component\Request;
use Lite\Core\Result;
use function Lite\func\dump;

class IndexController extends BaseController {
	public function index(){

	}

	public function uploadImage(){
		if ($this->isPost()) {
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
			'UPLOAD_PAGE_URL' => $this->getUrl('index/uploadImage')
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
