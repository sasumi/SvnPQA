<?php
namespace www\controller;

use Lite\Component\Paginate;
use Lite\Core\Result;
use Lite\CRUD\ControllerInterface;
use www\model\Sample;
use www\model\SampleWorkCost;
use www\model\SingleSample;
use function Lite\func\array_group;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
class SampleWorkCostController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INDEX  => array(),
			self::OP_UPDATE => array(),
			self::OP_INFO   => array(),
			self::OP_DELETE => array()
		);
	}

	public function index($search){
		$sample_no = $search['sample_no'];
		$chinese_name = $search['chinese_name'];
		$paginate = Paginate::instance();
		$sample_list = Sample::find('sample_no like ? and chinese_name like ?', "%{$sample_no}%", "%{$chinese_name}%")->paginate($paginate, true);

		$sample_work_cost_list_grp = array();
		if($sample_list){
			$sample_work_cost_list = SampleWorkCost::find('sample_id in ?', array_column($sample_list, 'id'))->all(true);
			$sample_work_cost_list_grp = array_group($sample_work_cost_list, 'sample_id');
		}
		foreach($sample_list as $key => $value){
			if(!$sample_work_cost_list_grp[$value['id']]){
				unset($sample_list[$key]);
			} else {
				$sample_list[$key]['cost_list'] = $sample_work_cost_list_grp[$value['id']];
				$sample_list[$key]['cost_list'] = array_group($sample_list[$key]['cost_list'],'technic_flow_id',true);
			}
		}

		$technic_flow_list = (new SingleSample())->getPropertiesDefine('technic_flow_id_list')['options'];

		return array(
			'search' => $search,
			'paginate' => $paginate,
			'sample_list' => $sample_list,
			'technic_flow_list' => $technic_flow_list,
		);
	}

	public function delete($get){
		SampleWorkCost::deleteWhere(0, 'sample_id = ?', $get['sample_id']);
		return $this->getCommonResult(true);
	}

	/**
	 * @param $get
	 * @param $post
	 * @return array
	 */
	public function update($get, $post){
		$sample_id = $get['sample_id'] ?: $post['sample_id'];
		$sample_info = Sample::findOneByPk($sample_id);

		if($post){
			SampleWorkCost::deleteWhere(0, 'sample_id = ?', $sample_id);
			$data = array();
			foreach ($post['price_list'] as $flow_id => $price) {
				$data[] = array(
					'sample_id'       => $sample_id,
					'technic_flow_id' => $flow_id,
					'price'           => $price,
				);
			}
			SampleWorkCost::insertMany($data);
			return new Result('操作成功', true);
		}

		$technic_flow_list = (new SingleSample())->getPropertiesDefine('technic_flow_id_list')['options'];
		$tmp = SampleWorkCost::find('sample_id = ?',$sample_id)->all(true);
		$cost_data = array_group($tmp ,'technic_flow_id',true);

		return array(
			'sample_info' => $sample_info,
			'technic_flow_list' => $technic_flow_list,
			'cost_data' => $cost_data,
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\SampleWorkCost';
	}
}