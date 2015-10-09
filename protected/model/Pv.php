<?php
namespace SvnPQA\Model;

use Lite\Core\Config;
use Lite\DB\Model;

class Pv extends Model {
	public function getTableName(){
		return "pv";
	}

	public function getPrimaryKey(){
		return "id";
	}

	public function getDbConfig(){
		return Config::get('db_log');
	}

}