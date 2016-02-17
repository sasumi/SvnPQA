<?php
namespace www\model;

/**
 * Created by PhpStorm.
 * User: Sasumi
 * Date: 2015/10/10
 * Time: 14:13
 */


class GlobalConf {
	const SAMPLE_TYPE_SINGLE = 1;
	const SAMPLE_TYPE_SUITE = 2;

	public static $sample_type_desc_map = array(
		self::SAMPLE_TYPE_SINGLE => '单件',
		self::SAMPLE_TYPE_SUITE => '套件',
	);

	//色号釉号的配置
	const COLOR_GLAZE_TYPE_COLOR = 1;
	const COLOR_GLAZE_TYPE_GLAZE = 2;

	public static $color_glaze_type_desc_map = array(
		self::COLOR_GLAZE_TYPE_COLOR => '色号',
		self::COLOR_GLAZE_TYPE_GLAZE => '釉号',
	);

	const COLOR_GLAZE_BAKING_ATMOSPHERE_TYPE_OXIDATION = 1;
	const COLOR_GLAZE_BAKING_ATMOSPHERE_TYPE_REDUCTION = 2;

	public static $color_glaze_baking_atmosphere_type_desc_map = array(
		self::COLOR_GLAZE_BAKING_ATMOSPHERE_TYPE_OXIDATION => '氧化',
		self::COLOR_GLAZE_BAKING_ATMOSPHERE_TYPE_REDUCTION => '还原',
	);
}