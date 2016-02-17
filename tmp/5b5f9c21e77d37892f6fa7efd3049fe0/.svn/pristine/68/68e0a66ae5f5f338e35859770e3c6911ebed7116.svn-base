<?php
namespace www\controller;

use Lite\Core\Result;
use Lite\CRUD\ControllerInterface;
use www\model\SamplePackage;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
class SamplePackageController extends BaseController implements ControllerInterface {

	/**
	 * get curd support operation list
	 * @return array
	 */
	public function supportCRUDList(){
		return array(
			self::OP_INDEX  => array(),
			self::OP_UPDATE => array(
				'fields' => array(
					'pack_name',
					'pack_type',
					'pack_desc',
					'inner_box_length',
					'inner_box_width',
					'inner_box_height',
					'inner_box_material_type',
					'inner_box_clapboard_material_type',
					'inner_box_clapboard_transverse_num',
					'inner_box_clapboard_vertical_num',
					'outer_box_length',
					'outer_box_width',
					'outer_box_height',
					'pack_percent',
					'weight',
					'outer_box_place_left_right',
					'outer_box_place_front_back',
					'outer_box_place_up_down',
					'outer_box_material_type',
				),
			),
			self::OP_DELETE => array(),
		);
	}

	/**
	 * 样品包装列表
	 * @param $get
	 * @return array|Result
	 */
	public function  showSamplePackageList($get){
		$sample_id = $get['sample_id'];
		$sample_package_list = SamplePackage::find('sample_id = ?', $sample_id)->all();

		return array(
			'sample_id'           => $sample_id,
			'sample_package_list' => $sample_package_list,
		);
	}

	/**
	 * 删除样品包装
	 * @param $get
	 * @return Result
	 */
	public function delete($get){
		$id = $get['id'];
		$sample_id = $get['sample_id'];

		SamplePackage::delByPk($id);

		return new Result('操作成功', true, null, $this->getUrl('SamplePackage/showSamplePackageList', array(
			'sample_id'   => $sample_id,
		)));
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\SamplePackage';
	}
}