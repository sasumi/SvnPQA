<?php
namespace www\model;

use Lite\Core\Config;
use Lite\DB\Model;

class Cgi extends Model {
	public function getTableName(){
		return "cgi";
	}

	public function getPrimaryKey(){
		return "id";
	}

	public function getDbConfig(){
		return Config::get('db_log');
	}
}