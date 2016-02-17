<?php
namespace www\controller;
use Lite\CRUD\ControllerInterface;
use www\model\SampleTechnic;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class SampleTechnicController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INDEX=>array(),
			self::OP_UPDATE=>array(),
			self::OP_INFO=>array(),
			self::OP_DELETE => array(),
		);
	}

	public function fill($get, $post){
		$sample_id = $post['sample_id'];
		$flow_id = $post['flow_id'];
		$comment = $post['comment'];
		SampleTechnic::deleteWhere(0, 'flow_id=? AND sample_id=?', $flow_id, $sample_id);
		$t = new SampleTechnic();
		$t->sample_id = $sample_id;
		$t->flow_id = $flow_id;
		$t->technic_desc = $comment;
		$t->save();
		return $this->getCommonResult(true);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\SampleTechnic';
	}
}