<?php
namespace www\controller;
use Lite\CRUD\ControllerInterface;
use www\model\SampleCategory;
use function Lite\func\array_filter_subtree;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class SampleCategoryController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INDEX => array(),
			self::OP_STATE=>array(),
			self::OP_INFO=>array(),
			self::OP_UPDATE=>array(),
			self::OP_QUICK_SEARCH => array(
				'fields' => array('name')
			)
		);
	}

	public function update($get, $post){
		$current_category = $get['id'] ? SampleCategory::findOneByPk($get['id']) : new SampleCategory();

		if($post){
			$current_category->setValues($post);
			$current_category->save();
			return $this->getCommonResult(true);
		}

		$tmp = SampleCategory::find()->all(true);
		$tmp = array_filter_subtree(0, $tmp);
		$all = array();
		foreach($tmp as $item){
			$item['name'] = str_repeat('&nbsp;', $item['tree_level']*5).'|-'.$item['name'];
			if($item['id'] == $current_category->id){
				$current_category->tree_level = $item['tree_level'];
			}
			$all[] = new SampleCategory($item);
		}

		return array(
			'all_categories' => $all,
			'current_category' => $current_category
		);
	}

	public function getModel(){
		return 'www\model\SampleCategory';
	}
}