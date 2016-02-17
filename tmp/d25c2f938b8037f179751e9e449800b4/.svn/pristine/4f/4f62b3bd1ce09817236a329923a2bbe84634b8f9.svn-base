<?php
namespace www\controller;
use Lite\Component\Paginate;
use Lite\Core\Result;
use Lite\Core\Router;
use Lite\CRUD\ControllerInterface;
use www\model\Sample;
use www\model\SampleImage;
use www\model\SampleProduceOrder;
use www\model\SampleProduceOrderMapSamples;
use www\ViewBase;
use function Lite\func\array_group;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class SampleProduceOrderMapSamplesController extends BaseController implements ControllerInterface {
	public function __construct(){
		parent::__construct();
	}

	public function supportCRUDList(){
		return array(
			self::OP_INFO   => array(),
			self::OP_DELETE => array(),
			self::OP_UPDATE => array(),
		);
	}

	public function index($get){
		$order_info = SampleProduceOrder::findOneByPk($get['id']);
		$paginate = Paginate::instance();
		$data_list = SampleProduceOrderMapSamples::find('sample_produce_id =?', $get['id'])->paginate($paginate);
		return array(
			'paginate' => $paginate,
			'order_info' => $order_info,
			'data_list' => $data_list,
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\SampleProduceOrderMapSamples';
	}
}