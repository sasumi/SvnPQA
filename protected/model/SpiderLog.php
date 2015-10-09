<?php
namespace SvnPQA\Model;

use Lite\Core\Config;
use Lite\DB\Model;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/24
 * Time: 9:48
 */

class SpiderLog extends Model {
	public function __construct(){
		$this->setFilterRules(array(
			'ua' => array(
				'TO_TRIM' => '',
			),
			'ip' => array(
				'TO_TRIM' => '',
			),
			'url' => array(
				'TO_TRIM' => '',
			),
			'create_time' => array(
				'DEFAULT' => time(),
			),
		));
	}

	public function getDbConfig(){
		return Config::get('db_log');
	}

	/**
	 * current model table name
	 * @return string
	 */
	public function getTableName(){
		return 'spider_log';
	}

	/**
	 * current mode primary key
	 * @return string
	 */
	public function getPrimaryKey(){
		return 'id';
	}
}