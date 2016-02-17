<?php
namespace www\controller;

use Lite\CRUD\ControllerInterface;
use www\model\SampleImage;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
class SampleImageController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_UPDATE => array(
				'fields' => array('image_url')
			),
			self::OP_DELETE => array()
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\SampleImage';
	}

	public function showSampleImages($get, $post){
		$sample_id = $get['sample_id'];
		$sample_image_list = SampleImage::find('sample_id = ?', $sample_id)->all();

		return array(
			'sample_id'         => $sample_id,
			'sample_image_list' => $sample_image_list,
		);
	}
}