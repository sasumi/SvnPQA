<?php
namespace SvnPQA\controller;

use Lite\Core\CRUD;
use Lite\Core\Hooker;
use Lite\DB\Query;
use Lite\DB\Record;
use Lite\Logger\Logger;
use Lite\Logger\Message\CommonMessage;

abstract class BaseController extends CRUD {
	public function __construct($ctrl=null, $act=null){
		Hooker::add(Record::EVENT_AFTER_DB_QUERY, function($sql){
			if(Query::isWriteOperation($sql)){
				Logger::instance('CMS')->info(new CommonMessage('DB WRITE', array(
					'sql' => $sql
				)));
			}
		});
	}
}