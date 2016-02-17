<?php
namespace SvnPQA\controller;
use Lite\Core\Hooker;
use Lite\CRUD\AbstractController;
use Lite\DB\Query;
use Lite\DB\Record;
use function Lite\func\dump;
use Lite\Logger\Logger;
use Lite\Logger\Message\CommonMessage;
use SvnPQA\ViewBase;

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

    /**
     * rebind auto template
     * @param $ctrl
     * @param $act
     * @return string
     */
    public static function __getTemplate($ctrl, $act){
        $class = get_called_class();
        $interfaces = class_implements($class, true);
        if($interfaces['Lite\CRUD\ControllerInterface']){
            $f = parent::__getTemplate('crud', $act);
            if($f){
                return $f;
            }
        }
        return parent::__getTemplate($ctrl, $act);
    }
}