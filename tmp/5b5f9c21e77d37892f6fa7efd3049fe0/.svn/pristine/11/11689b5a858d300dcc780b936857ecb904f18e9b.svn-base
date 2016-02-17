<?php
namespace www\controller;
use Exception;
use Lite\Component\Request;
use Lite\Core\Config;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/12
 * Time: 17:21
 */
class RichEditorController extends BaseController {
	public function index($get) {
		switch ($get['action']) {
			case 'config':
				$result = $this->loadConfig();
				$this->output($result, $get['callback']);
				die();

			case 'uploadimage':
				$upload_file = $_FILES['upfile'];

				if($upload_file['size'] > Config::get('upload/upload_size')){
					$this->output(array(
						"state" => '文件大小超出 '.Config::get('upload/upload_size').'字节 限制', //message
						"url" => '', //文件路径
						"title" => '', //新文件名
						"original" => '',//原文件名,
						"type" => '',   //文件扩展�?
						"size" => 0,    //上传后的文件大小（B�?
					), $get['callback']);
				}

				$result = Request::postFiles(Config::get('upload/host'), array('ext'=>end(explode('.', $upload_file['name']))), array('file'=>$upload_file['tmp_name']));
				$result = json_decode($result, true);
				if($result['code'] == '0'){
					$url = $result['data'];
					$file = array_pop(explode('/',$url));
					$this->outputHtml(array(
						"state" => 'SUCCESS',
						"url" => $url,
						"title" => $file,
						"original" => $upload_file['name'],
						"type" => '.'.array_pop(explode('.', $file)),
						"size" => $upload_file['size']
					), $get['callback']);
				}

				$this->outputHtml(array(
					"state" => $result['message'] ?: '文件上传失败',
					"size" => $upload_file['size']
				), $get['callback']);

		}

		throw new Exception('action error');
	}

	/**
	 * load ueditor config
	 * @return array
	 */
	private function loadConfig() {
		return Config::get('ueditor');
	}

	private function output($data, $callback=null, $return=false){
		$string = json_encode($data);
		if ($callback) {
			if (preg_match('/^[\w_]+$/', $_GET["callback"])) {
				$string = htmlspecialchars($_GET["callback"]) . '(' . $string . ')';
			} else {
				$string = json_encode(array(
					'state' => 'callback参数不合�?'
				));
			}
		}
		if($return){
			return $string;
		}
		echo $string;
		exit;
	}

	/**
	 * 输出结果
	 * @param $data
	 * @param null $callback
	 */
	private function outputHtml($data, $callback = null) {
		$string = $this->output($data, $callback, true);
		if(stripos($_SERVER['HTTP_X_REQUESTED_WITH'], 'flash')){
			die($string);
		}

		$html = <<<EOT
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script>document.domain = "erp.com"</script>
</head>
<body>
	$string
</body>
</html>
EOT;
		echo $html;
		exit;
	}
}