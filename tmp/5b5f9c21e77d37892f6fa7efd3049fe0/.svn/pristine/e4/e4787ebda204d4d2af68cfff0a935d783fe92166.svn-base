<?php
namespace www\controller;

use Lite\Component\Paginate;
use Lite\Core\Result;
use Lite\CRUD\ControllerInterface;
use www\model\Sample;
use www\model\SampleWorkAccount;
use www\model\SingleSample;
use function Lite\func\array_group;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
class SampleWorkAccountController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INDEX  => array(),
			self::OP_UPDATE => array(),
			self::OP_INFO   => array()
		);
	}

	public function index($search){
		$sample_no = $search['sample_no'];
		$chinese_name = $search['chinese_name'];
		$paginate = Paginate::instance();
		$sample_list = Sample::find('sample_no like ? and chinese_name like ?', "%{$sample_no}%", "%{$chinese_name}%")->paginate($paginate, true);

		$sample_work_account_list_grp = array();
		if($sample_list){
			$sample_work_account_list = SampleWorkAccount::find('sample_id in ?', array_column($sample_list, 'id'))->all(true);
			$sample_work_account_list_grp = \Lite\func\array_group($sample_work_account_list, 'sample_id');
		}
		foreach($sample_list as $key => $value){
			$sample_list[$key]['account_list'] = $sample_work_account_list_grp[$value['id']] ?: array();
			$sample_list[$key]['account_list'] = array_group($sample_list[$key]['account_list'],'technic_flow_id',true);
		}

		$technic_flow_list = (new SingleSample())->getPropertiesDefine('technic_flow_id_list')['options'];

		return array(
			'search'             => $search,
			'paginate'           => $paginate,
			'sample_list' => $sample_list,
			'technic_flow_list'  => $technic_flow_list,
		);
	}

	/**
	 * @param $get
	 * @param $post
	 * @return array
	 */
	public function update($get, $post){
		$sample_id = $get['id'];
		$sample = Sample::findOneByPk($sample_id);

		if($post){
			SampleWorkAccount::deleteWhere(0, 'sample_id = ?', $sample_id);
			foreach($post['price_list'] as $flow_id => $price){
				$work_account = new SampleWorkAccount();
				$work_account->setValues(
					array(
						'sample_id' => $sample_id,
						'technic_flow_id'  => $flow_id,
						'price'            => $price,
					)
				);
				$work_account->save();
			}

			return new Result('操作成功', true);
		}

		$technic_flow_list = (new SingleSample())->getPropertiesDefine('technic_flow_id_list')['options'];
		$work_account = SampleWorkAccount::find('sample_id = ?',$sample_id)->all(true);
		$work_account_grp = array_group($work_account ,'technic_flow_id',true);

		return array(
			'sample'            => $sample,
			'technic_flow_list' => $technic_flow_list,
			'work_account_grp'  => $work_account_grp,
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\SampleWorkAccount';
	}
}