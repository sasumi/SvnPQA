<?php
namespace www\model;

use Lite\Core\Config;
use Lite\DB\Model;
use Lite\Exception\Exception;

class Log extends Model {
	const LEVEL_VERBOSE = 'v';
	const LEVEL_DEBUG = 'd';
	const LEVEL_INFO = 'i';
	const LEVEL_WARNING = 'w';
	const LEVEL_ERROR = 'e';
	const LEVEL_FATAL = 'f';
	const LEVEL_SILENT = 's';

	public function getTableName(){
		return "log";
	}

	public function getPrimaryKey(){
		return "id";
	}

	public function getDbConfig(){
		return Config::get('db_log');
	}

	/**
	 * 插入log
	 * @param $tag_or_param
	 * @param null $content
	 * @param null $level
	 * @throws Exception
	 * @return bool
	 */
	public static function insertLog($tag_or_param, $content=null, $level=null){
		if(is_array($tag_or_param)){
			$data = array_merge(array(
				'level' => 'v',
				'tag' => '',        //必填
				'content' => '',
				'file' => '',
				'line' => '0',
				'state' => '0',
				'datetime' => date('Y-m-d H:i:s')
			), $tag_or_param);
		} else {
			$data = array(
				'level' => $level || self::LEVEL_INFO,
				'tag' => $tag_or_param,        //必填
				'content' => $content,
				'file' =>'',
				'line' => '',
				'state' => '0',
				'datetime' => date('Y-m-d H:i:s')
			);
		}

		if(empty($data['tag'])){
			throw new Exception('LOG TAG REQUIRE');
		}

		$log = new self();
		$log->setValues($data);
		return !!$log->save();
	}
}