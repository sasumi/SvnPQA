<?php
namespace SvnPQA\Model;

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