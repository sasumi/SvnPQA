<?php
namespace www\controller;

use Lite\Component\Paginate;
use Lite\Core\Config;
use Lite\Core\Hooker;
use Lite\Core\RefParam;
use Lite\Core\Router;
use Lite\Core\View;
use Lite\CRUD\AbstractController;
use Lite\DB\Query;
use Lite\DB\Record;
use Lite\Logger\Logger;
use Lite\Logger\Message\CommonMessage;
use www\Auth;
use function Lite\func\dump;

abstract class BaseController extends AbstractController {
	public static function __getTemplate($ctrl, $act){
		$class = get_called_class();
		$interfaces = class_implements($class, true);
		if(!$interfaces['Lite\CRUD\ControllerInterface']){
			return parent::__getTemplate($ctrl, $act);
		}

		/** @var View $viewer */
		$viewer = Config::get('app/render');

		//存在缺省模版
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

	public function __construct($ctrl=null, $act=null){
		if($ctrl && $act){
			Auth::checkAuth($ctrl, $act);
		}

		//静态资源版本号
		Hooker::add(Router::EVENT_GET_STATIC_URL, function(RefParam $ref){
			$url = $ref->get('url');
			if(strpos($url, '?') === false){
				$ref->set('url', $ref->get('url').'?v'.date('Ym'));
			}
		});

		$paginate = Paginate::instance();
		$paginate->setPageSize(15);
		Hooker::add(Record::EVENT_AFTER_DB_QUERY, function($sql){
			if(Query::isWriteOperation($sql)){
				Logger::instance('CMS')->info(new CommonMessage('DB WRITE', array(
					'sql' => $sql
				)));
			}
		});
		return parent::__construct();
	}
}