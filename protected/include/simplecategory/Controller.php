<?php
namespace SvnPQA\simplecategory;
use Lite\Core\View;
use SvnPQA\controller\BaseController;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/13
 * Time: 14:46
 */
abstract class Controller extends BaseController {
	/**
	 * @return string
	 */
	abstract function getCatalogName();

	protected function supportCRUDList(){
		return self::OP_ALL;
	}

	public function index($search){
		$result = parent::index($search);
		$result->setItem('catalog_name', $this->getCatalogName());
		$view = new View($result);
		return $view->render('simplecategory/index.php', true);
	}

	public function update($get, $post){
		$result = parent::update($get, $post);
		if($this->isGet()){
			$result->setItem('catalog_name', $this->getCatalogName());
			$view = new View($result);
			return $view->render('simplecategory/update.php', true);
		}
		return $result;
	}
}