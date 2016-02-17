<?php
namespace www\controller;
use Lite\Component\Paginate;
use Lite\Core\Result;
use Lite\Core\Router;
use Lite\CRUD\ControllerInterface;
use www\model\Sample;
use www\model\SampleProduceOrder;
use www\model\SampleProduceOrderMapSamples;
use function Lite\func\array_group;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class SampleProduceOrderMapSamplesController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INFO   => array(),
			self::OP_DELETE => array(),
			self::OP_UPDATE => array(),
			self::OP_STATE => array()
		);
	}

	public function updateProduceState($get, $post){
		$map_ids = $post['map_ids'];
		if(!$map_ids){
			return new Result('请选择样品');
		}

		$produce_process_state = $post['produce_process_state'];
		$produce_employee_id = $post['produce_employee_id'];
		if(!$produce_employee_id){
			return new Result('请选择员工');
		}

		SampleProduceOrderMapSamples::updateByPks($map_ids, array(
			'produce_process_state' => $produce_process_state,
			'produce_employee_id' => $produce_employee_id
		));
		return $this->getCommonResult(true);
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
	 * 修改单个样品单项状态
	 * @param $get
	 * @return Result
	 */
	public function state($get){
		//处理单条记录状态
		$r = Result::convert(parent::state($get));
		if($r->isSuccess() && $get['state'] == SampleProduceOrderMapSamples::STATE_FINISH){
			$map = SampleProduceOrderMapSamples::findOneByPk($get['id']);

			//处理样品生产单
			$this->updateProduceOrderState($map->produce_order_id);

			//处理样品状态
			$n = new SampleController();
			$n->state(array(
				'id' => $map->sample_id,
				'state' => Sample::STATE_NORMAL
			));

		}
		return $r;
	}

	/**
	 * 更新生产单的状态
	 * @param $produce_order_id
	 */
	private function updateProduceOrderState($produce_order_id){
		$order = SampleProduceOrder::findOneByPk($produce_order_id);

		//处理生产单状态
		$has_no_finish_count = SampleProduceOrderMapSamples::find('produce_order_id=? AND state <> ?',
			$produce_order_id, SampleProduceOrderMapSamples::STATE_FINISH)->count();

		//所有子项都完成了，改为完成
		if(!$has_no_finish_count){
			$ctrl = new SampleProduceOrderController();
			$ctrl->state(array(
				'id' => $produce_order_id,
				'state' => SampleProduceOrder::STATE_FINISH
			));
		}

		//如果已经完成，回退为生产中
		else if($order->state == SampleProduceOrder::STATE_FINISH){
			$order->state = SampleProduceOrder::STATE_PRODUCING;
			$order->save();
		}
	}

	public function delete($get, $post){
		$produce_order_id = SampleProduceOrderMapSamples::findOneByPk($get['id'])->produce_order_id;
		$r = Result::convert(parent::delete($get));
		if($r->isSuccess()){
			$this->updateProduceOrderState($produce_order_id);
		}
		return $r;
	}

	public function update($get, $post){
		$r = Result::convert(parent::update($get, $post));
		if($post && $r->isSuccess()){
			$this->updateProduceOrderState($post['produce_order_id']);
		}
		return $r;
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\SampleProduceOrderMapSamples';
	}
}