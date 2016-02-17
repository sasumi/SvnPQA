<?php
namespace www\controller;

use Lite\Core\Result;
use www\model\SampleProduceOrder;
use www\ViewBase;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: Sasumi
 * Date: 2015/10/27
 * Time: 13:56
 */
class BusinessOrderProduceController extends BaseController {
	public function index($get){
		$ctrl = new SampleProduceOrderController();
		$r = Result::convert($ctrl->index(array(
			'page_flag' => 'BusinessOrder',
			'produce_type' => SampleProduceOrder::TYPE_ORDER
		)));

		$view = new ViewBase($r);
		return $view->render('sampleproduceorder/index.php', true);
	}

	public function info($get){
		$ctrl = new SampleProduceOrderController();
		$r = Result::convert($ctrl->info($get));
		$view = new ViewBase($r);
		return $view->render('sampleproduceorder/info.php');
	}
}