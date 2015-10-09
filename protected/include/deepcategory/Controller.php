<?php
namespace SvnPQA\deepcategory;
use Lite\Component\Paginate;
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

	/**
	 * support all operation
	 * @return array|int|string
	 */
	public function supportCRUDList() {
		return self::OP_ALL;
	}

	public function index($search) {
		/** @var Model $model_name */
		$model_name = $this->getModelName();
		$data_list = $model_name::getListByOrder();
		$paginate = Paginate::instance();
		$paginate->setItemTotal(count($data_list));
		$limit_info = $paginate->getLimit();
		$data_list = array_slice($data_list, $limit_info[0], $limit_info[1]);
		$view = new View(array(
			'data_list' => $data_list,
			'paginate' => $paginate,
			'catalog_name' => $this->getCatalogName()
		));
		return $view->render($this->getRenderViewList(), true);
	}

	public function update($get, $post) {
		$result = parent::update($get, $post);

		if ($this->isGet()) {
			/** @var Model $model_name */
			$model_name = $this->getModelName();
			$result->addData(array(
				'category_list' => $model_name::getListByOrder(),
				'catalog_name' => $this->getCatalogName(),
			));
			$view = new View($result);
			$html = $view->render($this->getRenderViewUpdate(), true);
			return $html;
		}
		return $result;
	}

	public function getStateKey() {
		return 'is_del';
	}

	public function getRenderViewList() {
		return 'deepcategory/index.php';
	}

	public function getRenderViewUpdate() {
		return 'deepcategory/update.php';
	}
}