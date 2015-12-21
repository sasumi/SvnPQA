<?php
namespace SvnPQA\controller;
use Lite\Core\Config;
use Lite\Core\Hooker;
use Lite\Core\View;
use Lite\CRUD\AbstractController;
use Lite\DB\Query;
use Lite\DB\Record;
use Lite\Logger\Logger;
use Lite\Logger\Message\CommonMessage;

abstract class BaseController extends AbstractController {
	public function __construct($ctrl=null, $act=null){
		Hooker::add(Record::EVENT_AFTER_DB_QUERY, function($sql){
			if(Query::isWriteOperation($sql)){
				Logger::instance('CMS')->info(new CommonMessage('DB WRITE', array(
					'sql' => $sql
				)));
			}
		});
	}

	public static function __getTemplate($ctrl, $act){
		$class = get_called_class();
		$interfaces = class_implements($class, true);
		if(!$interfaces['Lite\CRUD\ControllerInterface']){
			return parent::__getTemplate($ctrl, $act);
		}

		/** @var View $viewer */
		$viewer = Config::get('app/render');

		//´æÔÚÈ±Ê¡Ä£°æ
		if($file = $viewer::resolveTemplate()){
			return $file;
		}

		$act = strtolower($act);
		switch($act){
			case 'index':
				return $viewer::resolveTemplate('crud/index.php');

			case 'update':
				return $viewer::resolveTemplate('crud/update.php');

			case 'info':
				return $viewer::resolveTemplate('crud/info.php');
		}
		return parent::__getTemplate($ctrl, $act);
	}
}