<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableBusinessOrderSamples;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-12-07
 * Time: 23:46:35
 */
class BusinessOrderSamples extends TableBusinessOrderSamples implements ModelInterface{
	public function __construct($data = array()){
		parent::__construct($data);
        $this->setPropertiesDefine(array(
            'sample_no' => array(
                'getter' => function(BusinessOrderSamples $item){
                    $tmp = Sample::findOneByPk($item->sample_id);
                    return $tmp ? $tmp->sample_no : '已删除';
                },
                'alias' => '货号'
            ),
            'sample_first_image_src' => array(
                'getter'=>function(BusinessOrderSamples $item){
                    $p = SampleImage::find('sample_id=?', $item->sample_id)->one();
                    if($p){
                        return $p->image_url;
                    }
                    return '';
                },
                'rel' => 'upload-image',
                'alias' => '样张'
            ),
            'outer_box_size' => array('getter' => function (BusinessOrderSamples $item){
                $p = SamplePackage::findOneByPk($item->sample_package_id);
                return ($p->outer_box_length ?: 0) . ' x ' .
                ($p->outer_box_width ?: 0) . ' x ' .
                ($p->outer_box_height ?: 0);
            }, 'alias' => '外箱尺寸'),
            'pack_name' => array('getter' => function (BusinessOrderSamples $item){
                $p = SamplePackage::findOneByPk($item->sample_package_id);
                return $p->pack_name;
            }, 'alias' => '包装方式'),
            'sample_sum' => array('getter'=>function(self $item){
                return $item->sample_num*$item->sample_unit_price;
            }, 'alias' => '小计'
            ),
            'pack_desc' => array('getter' => function (BusinessOrderSamples $item){
                $p = SamplePackage::findOneByPk($item->sample_package_id);
                return $p->pack_desc;
            }, 'alias' => '包装描述'),
        ));
	}

    /**
     * 获取模型状态key
     * @return string
     */
    public function getStateKey()
    {
        // TODO: Implement getStateKey() method.
    }
}