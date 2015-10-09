<?php
namespace SvnPQA\deepcategory;
use Lite\DB\Model as DBModel;
use function Lite\func\array_group;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/12
 * Time: 10:42
 */
abstract class Model extends DBModel {

	const ENABLE_DEEP_LEVEL = false;//下拉是否启用多级 3级以上

	const STATE_ENABLE = 0;
	const STATE_DISABLE = 1;

	public static $state_list = array(
		self::STATE_ENABLE => '正常',
		self::STATE_DISABLE => '禁用'
	);

	public static $state_css_list = array(
		self::STATE_ENABLE => 'state-label-success',
		self::STATE_DISABLE => 'state-label-disable'
	);

	public static function getList() {
		/** @var self $class */
		$class = null;
		$class = get_called_class();

		return $class::find()->all();
	}

	public function __construct() {
		/* @var Model $called_class */
		$called_class = get_called_class();

		$this->addPropertiesDefine(array(
			'name' => array('unique' => '名称已存在'),
			'deep_name' => array('getter' => function ($item) {
				return str_repeat('&nbsp;', ($item->level) * 7) . '|-' . $item->name;
			}),
			'level' => array('getter' => function ($item) use ($called_class) {
				$all = $called_class::getListByOrder();
				return $all[$item->id]['level'];
			}),
			'state_text' => array('getter' => function ($item) use ($called_class) {
				return $called_class::$state_list[$item->is_del];
			}),
			'state_css_class' => array('getter' => function ($item) use ($called_class) {
				return $called_class::$state_css_list[$item->is_del];
			}),
			'parent_category' => array('getter' => function ($item) use ($called_class) {
				if ($item->parent_id) {
					$parent = $called_class::findOneByPk($item->parent_id);
					return $parent->name;
				}
				return '';
			}),
		));

		$this->addFilterRules(array(
			'name' => array(
				'TO_TRIM' => '',
				'REQUIRE' => '请输入名称'
			),
			'parent_id' => array(
				'TO_INT' => '',
				'DEFAULT' => 0
			),
			'is_del' => array(
				'TO_INT' => '',
				'DEFAULT' => 0
			),
		));
		parent::__construct();
	}

	/**
	 * @param $parent_id
	 * @param int $level
	 * @param $all
	 * @return array
	 */
	public static function getSubChildrenCategories($parent_id, $level = 0, $all) {
		$result = array();
		$has_children = array_group($all, 'parent_id');
		foreach ($all as $item) {
			if ($item['parent_id'] == $parent_id) {
				$item['level'] = $level;
				$result[] = $item;
				if ($has_children[$item['id']]) {
					$sub = self::getSubChildrenCategories($item['id'], $level + 1, $all);
					foreach ($sub as $k => $s) {
						$sub[$k]['level'] = $item['level'] + 1;
					}
					$result = array_merge($result, $sub);
				}
			}
		}
		return $result;
	}

	/**
	 * 获取已经排序（根据层级）的分类
	 * @param bool $as_array
	 * @return array
	 */
	public static function getListByOrder($as_array = false) {
		/* @var Model $called_class */
		$called_class = get_called_class();

		$all = $called_class::find()->order('id ASC')->all(true);
		$roots = array_filter($all, function ($cat) {
			return $cat['parent_id'] == 0;
		});

		$result = array();
		foreach ($roots as $root) {
			$root['level'] = 0;
			$tmp = self::getSubChildrenCategories($root['id'], 1, $all);
			$result[] = $root;
			$result = array_merge($result, $tmp);
		}
		$result = array_group($result, 'id', true);
		if (!$as_array) {
			$tmp = array();
			foreach ($result as $id => $item) {
				$obj = new $called_class();
				$obj->setValues($item);
				$tmp[$id] = $obj;
			}
			return $tmp;
		}
		return $result;
	}

	/**
	 * 获取分类类型
	 * @return mixed|string
	 */
	public static function getCategoryType() {
		$called_class = get_called_class();
		$cate_type = strtolower(array_pop(explode('_', $called_class)));
		$cate_type = str_replace('category', '', $cate_type);
		return $cate_type;
	}
}