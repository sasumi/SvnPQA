<?php
namespace SvnPQA\controller;
use Lite\Component\Paginate;
use Lite\CRUD\ControllerInterface;
use function Lite\func\array_last;
use function Lite\func\array_merge_recursive_distinct;
use function Lite\func\dump;
use function Lite\func\format_size;
use function Lite\func\get_folder_size;
use function Lite\func\glob_recursive;
use SvnPQA\model\Repository;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2015/12/7
 * Time: 21:52
 */

class RepositoryController extends BaseController implements ControllerInterface {
    /**
     * get curd support operation list
     * @return array
     */
    public function supportCRUDList(){
        return array(
            self::OP_INDEX => array(),
            self::OP_UPDATE => array(),
            self::OP_DELETE => array()
        );
    }

    /**
     * get relate model name
     * @return string
     */
    public function getModel(){
        return 'SvnPQA\model\Repository';
    }
}