<?php
namespace SvnPQA\controller;
use Lite\Component\Paginate;
use Lite\Core\Config;
use Lite\CRUD\ControllerInterface;
use function Lite\func\array_last;
use function Lite\func\array_merge_recursive_distinct;
use function Lite\func\dump;
use function Lite\func\format_size;
use function Lite\func\get_folder_size;
use function Lite\func\glob_recursive;
use SvnPQA\model\Repository;
use SvnPQA\SvnHelper;

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

    public function load($get){
        $id = $get['id'];
        $repo = Repository::findOneByPk($id);
        if($repo){
            $tmp_dir = Config::get('code/tmp_dir');
            $dir_name = md5($repo->address);
            if(!is_dir($tmp_dir.'/'.$dir_name)){
                mkdir($tmp_dir.'/'.$dir_name);
            }
            $s = new SvnHelper($repo->address, $repo->user, $repo->password);
            $s->checkOut($tmp_dir.'/'.$dir_name);
        }
    }

    /**
     * get relate model name
     * @return string
     */
    public function getModel(){
        return 'SvnPQA\model\Repository';
    }
}