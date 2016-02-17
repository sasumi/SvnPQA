<?php
namespace www\controller;

use Lite\Component\Paginate;
use Lite\Core\Result;
use Lite\Core\Router;
use Lite\CRUD\ControllerInterface;
use Lite\DB\Model;
use Lite\DB\Query;
use www\model\GlobalConf;
use www\model\Sample;
use www\model\SampleCategory;
use www\model\SampleImage;
use www\model\SampleMaterial;
use www\model\SampleMould;
use www\model\SamplePackage;
use www\model\SampleTechnic;
use www\model\SingleSample;
use www\model\SuiteSampleMapSingleSample;
use www\ViewBase;
use function Lite\func\array_filter_subtree;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class SampleController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INDEX        => array(),
			self::OP_UPDATE       => array(
				'fields' => array(
					'sample_no',
					'chinese_name',
					'english_name',
					'key_words',
					'tags',
					'category_id',
					'material_id'
				)
			),
			self::OP_STATE        => array(),
			self::OP_QUICK_SEARCH => array(
				'fields' => array('sample_no','chinese_name','english_name', 'tags','state')
			),
			self::OP_DELETE       => array(),
		);
	}

	public function getSampleInfoByNo($get) {
		$no = trim($get['no']);
		$sample_type = $get['sample_type'];

		$query = Sample::find('sample_no =?', $no);
		if($sample_type){
			$query->addWhere(Query::OP_AND, 'sample_type', '=', $sample_type);
		}
		$ss = $query->one();

		if($ss){
			$extend_info = null;
			if($ss->sample_type == GlobalConf::SAMPLE_TYPE_SINGLE){
				$extend_info = SingleSample::find('sample_id=?', $ss->id)->one(true);
			}
			$image_list = SampleImage::find('sample_id=?',$ss->id)->all(true);
			foreach($image_list as $k=>$img){
				$image_list[$k]['image_url'] = ViewBase::buildUploadImage($img['image_url']);
			}
			$package_list = SamplePackage::find('sample_id=?', $ss->id)->all(true);
			return new Result('success', true, array(
				'sample_id' => $ss->id,
				'base_info' => $ss->toArray(),
				'extend_info' => $extend_info,
				'image_list' => $image_list,
				'package_list' => $package_list
			));
		}
		return new Result('no found');
	}

	public function update($get, $post){
		$result = Result::convert(parent::update($get, $post));

		//接管提交成功后的处理
		if($post && $result->isSuccess()){
			$id = $result->getData()['id'];
			$sample_type = Sample::findOneByPk($id)->sample_type;
			if($sample_type == GlobalConf::SAMPLE_TYPE_SINGLE){
				$ext = SingleSample::find('sample_id=?', $id)->one() ?: new SingleSample(array('sample_id'=>$id));
				unset($post['id']);
				$ext->setValues($post);
				$ext->save();
			}
			$result->setJumpUrl(Router::getUrl('Sample/info', array('id'=>$id)));
		}
		return $result;
	}

	public function delete($get, $post){
		$r = parent::delete($get);
		if($r->isSuccess()){
			$r->setJumpUrl(Router::getUrl('Sample'));
		}
		return $r;
	}

	public function info($get){
		$id = $get['id'];
		$sample = Sample::findOneByPk($id);
		$mould_list = SampleMould::find('sample_id=?', $id)->all();
		$package_type_list = SamplePackage::find('sample_id=?', $id)->all();
		$sample_image_list = SampleImage::find('sample_id=?', $id)->all();

		$tpl = $sample->sample_type == GlobalConf::SAMPLE_TYPE_SINGLE ? 'sample/single_info.php' : 'sample/suite_info.php';
		$v = new ViewBase(array(
			'mould_list' => $mould_list,
			'package_type_list' => $package_type_list,
			'sample_image_list' => $sample_image_list,
			'sample' => $sample,
		));
		return $v->render($tpl,true);
	}

	/**
	 * 单件样品的工艺信息列表
	 * @param $get
	 * @return array|Result
	 */
	public function showSampleTechnicList($get){
		$sample_id = $get['sample_id'];
		$sample_technic_list = SampleTechnic::find('sample_id = ?', $sample_id)->all();

		return array(
			'sample_id'           => $sample_id,
			'sample_technic_list' => $sample_technic_list,
		);
	}

	public function quickAddSample($get, $post){
		if($post){
			$ex = Model::transaction(function()use($post){
				$sample = new Sample();
				$sample->setValues(array(
					'sample_type' => $post['sample_type'],
					'category_id' => $post['category_id'],
					'material_id' => $post['material_id'],
					'sample_no' => $post['sample_no'],
					'chinese_name' => $post['chinese_name'],
				));
				$sample->save();

				if($post['sample_type'] == GlobalConf::SAMPLE_TYPE_SINGLE){
					$ss = new SingleSample();
					$ss->sample_id = $sample->id;
					$ss->technic_flow_id_list = $post['technic_flow_id_list'];
					$ss->save();
				}

				$si = new SampleImage();
				$si->setValues(array(
					'sample_id' => $sample->id,
					'image_url' => $post['image_url'],
				));
				$si->save();

				$sp = new SamplePackage();
				$sp->setValues(array(
					'sample_id' => $sample->id,
					'pack_name' => $post['pack_name'],
					'pack_desc' => $post['pack_desc']
				));
				$sp->save();
			});
			if($ex){
				return new Result($ex->getMessage());
			}
			else {
				return new Result('样品添加成功', true, $post['sample_no']);
			}
		}

		$tmp = SampleCategory::find()->all(true);
		$tmp = array_filter_subtree(0, $tmp);
		foreach($tmp as $k=>$item){
			$tmp[$k]['name'] = str_repeat('&nbsp;', $item['tree_level']*5).'|-'.$item['name'];
		}
		$category_list = array_combine(array_column($tmp, 'id'),array_column($tmp, 'name'));
		$material_list = SampleMaterial::find('state=?', SampleMaterial::STATE_ENABLED)->all();

		return array(
			'material_list' => $material_list,
			'category_list' => $category_list
		);
	}

	/**
	 * 编辑单件样品的工艺信息
	 * @param $get
	 * @param $post
	 * @return array|Result
	 */
	public function updateSampleTechnic($get, $post){
		$id = $get['id'];
		$sample_id = $get['sample_id'];
		$sample = Sample::findOneByPk($sample_id);

		$sample_tech_data = SampleTechnic::find('id = ?', $id)->one();
		$sample_tech_data = $sample_tech_data ?: new SampleTechnic;
		if( !$sample_tech_data->sample_id){
			$sample_tech_data->setvalue('sample_id', $sample_id);
		}

		if($post){
			$sample_tech_data->setValues($post);
			$sample_tech_data->save();
			return new Result('操作成功', true, null, Router::getUrl('Sample/showSampleTechnicList', array(
				'id'               => $id,
				'sample_id' => $sample_id
			)));
		}
		$flow_list = $sample->getPropertiesDefine('technic_flow_id_list')['options'];
		$flow_list = array_diff_key($flow_list,array_diff_key($flow_list,array_flip(explode(',',$sample->technic_flow_id_list))));

		return array(
			'flow_list' => $flow_list,
			'data'      => $sample_tech_data,
		);
	}

	public function searchSingleSample($get){
		$sample = Sample::findOneByPk($get['id']);
		$tmp = SuiteSampleMapSingleSample::find('suite_sample_id = ?', $get['id'])->all(true);
		$single_sample_id_list = array_column($tmp, 'single_sample_id');
		$paginate = Paginate::instance();
		$paginate->setPageSize(8);

		if($get['sample_no']){
			$no = addslashes($get['sample_no']);
			$all_single_sample_list = Sample::find("sample_no LIKE '%$no%' AND sample_type=?", GlobalConf::SAMPLE_TYPE_SINGLE)->paginate($paginate);
		} else {
			$all_single_sample_list = Sample::find('sample_type=?',GlobalConf::SAMPLE_TYPE_SINGLE)->paginate($paginate);
		}

		return array(
			'search' => $get,
			'single_sample_id_list' => $single_sample_id_list,
			'sample' => $sample,
			'paginate' => $paginate,
			'all_single_sample_list' => $all_single_sample_list,
		);
	}

	public function addSingleSample($get){
		$map = new SuiteSampleMapSingleSample(array(
			'suite_sample_id' => $get['suite_sample_id'],
			'single_sample_id' => $get['single_sample_id']
		));
		$map->save();
		return $this->getCommonResult(true);
	}

	public function removeSingleSample($get){
		SuiteSampleMapSingleSample::deleteWhere(1, 'suite_sample_id =? AND single_sample_id=?', $get['id'], $get['single_sample_id']);
		return $this->getCommonResult(true);
	}

	/**
	 * 删除单件眼样品的工艺
	 * @param $get
	 * @return Result
	 */
	public function deleteSampleTechnic($get){
		$id = $get['id'];
		$sample_id = $get['sample_id'];

		SampleTechnic::delByPk($id);

		return new Result('操作成功', true, null, Router::getUrl('Sample/updateSampleTechnic', array(
			'sample_id' => $sample_id
		)));
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel() {
		return 'www\model\Sample';
	}
}