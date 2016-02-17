<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSamplePackage

 * @property-read int $id 包装方式
 * @property int $sample_id 样品ID
 * @property string $pack_name 包装名称
 * @property mixed $pack_desc 包装说明
 * @property float $inner_box_length 内盒长
 * @property float $inner_box_width 内盒宽
 * @property float $inner_box_height 内盒高
 * @property mixed $inner_box_material_type 内盒材质(白盒,单瓦,双瓦)
 * @property mixed $inner_box_clapboard_material_type 内盒隔板材质(白盒,单瓦,双瓦)
 * @property int $inner_box_clapboard_transverse_num 内盒隔板横向数量
 * @property int $inner_box_clapboard_vertical_num 内盒隔板竖向数量
 * @property float $outer_box_length 外盒长
 * @property float $outer_box_width 外盒宽
 * @property float $outer_box_height 外盒高
 * @property float $pack_percent 包装率
 * @property float $weight 净重
 * @property int $outer_box_place_left_right 外盒摆放左右
 * @property int $outer_box_place_front_back 外箱摆放前后
 * @property int $outer_box_place_up_down 外箱摆放上下
 * @property mixed $outer_box_material_type 外盒材质(白盒,单瓦,双瓦)
 * @method static TableSamplePackage|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSamplePackage::DB_READ)
 * @method static TableSamplePackage|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSamplePackage|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSamplePackage|Query order($statement='')
 * @method static TableSamplePackage|Query|bool create($data)
 * @method static TableSamplePackage|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSamplePackage|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSamplePackage|Query|array|null one($as_array = false)
 * @method mixed|null ceil($key)
 * @method bool chunk($size = 1, $handler)
 * @method int count()
 * @method array|null paginate($page = null, $as_array = false)
 * @method number update()
 * @method string|bool insert()
 * @method static array|bool insertMany($data_list, $break_on_fail = true)
 * @method bool delete()
 * @method bool save()
 * @method setPropertiesDefine(array $defines)
 * @method array getPropertiesDefine($key=null)
 * @method array getEntityPropertiesDefine($key=null)
 * @method array getAllPropertiesKey()
 * @method string getPrimaryKey()
 */
abstract class TableSamplePackage extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => '包装方式',
				'type' => 'int',
				'length' => 11,
				'primary' => true,
				'required' => true,
				'readonly' => true,
				'entity' => true
			),
			'sample_id' => array(
				'alias' => '样品ID',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'pack_name' => array(
				'alias' => '包装名称',
				'type' => 'string',
				'length' => 200,
				'default' => '',
				'entity' => true
			),
			'pack_desc' => array(
				'alias' => '包装说明',
				'type' => 'text',
				'length' => 0,
				'default' => null,
				'entity' => true
			),
			'inner_box_length' => array(
				'alias' => '内盒长',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'inner_box_width' => array(
				'alias' => '内盒宽',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'inner_box_height' => array(
				'alias' => '内盒高',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'inner_box_material_type' => array(
				'alias' => '内盒材质',
				'type' => 'enum',
				'default' => 1,
				'options' => array('1'=>'白盒', '2'=>'单瓦', '3'=>'双瓦'),
				'entity' => true
			),
			'inner_box_clapboard_material_type' => array(
				'alias' => '内盒隔板材质',
				'type' => 'enum',
				'default' => 1,
				'options' => array('1'=>'白盒', '2'=>'单瓦', '3'=>'双瓦'),
				'entity' => true
			),
			'inner_box_clapboard_transverse_num' => array(
				'alias' => '内盒隔板横向数量',
				'type' => 'int',
				'length' => 11,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'inner_box_clapboard_vertical_num' => array(
				'alias' => '内盒隔板竖向数量',
				'type' => 'int',
				'length' => 11,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'outer_box_length' => array(
				'alias' => '外盒长',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'outer_box_width' => array(
				'alias' => '外盒宽',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'outer_box_height' => array(
				'alias' => '外盒高',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'pack_percent' => array(
				'alias' => '包装率',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'weight' => array(
				'alias' => '净重',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'outer_box_place_left_right' => array(
				'alias' => '外盒摆放左右',
				'type' => 'int',
				'length' => 11,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'outer_box_place_front_back' => array(
				'alias' => '外箱摆放前后',
				'type' => 'int',
				'length' => 11,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'outer_box_place_up_down' => array(
				'alias' => '外箱摆放上下',
				'type' => 'int',
				'length' => 11,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'outer_box_material_type' => array(
				'alias' => '外盒材质',
				'type' => 'enum',
				'default' => 1,
				'options' => array('1'=>'白盒', '2'=>'单瓦', '3'=>'双瓦'),
				'entity' => true
			),
		));
		parent::__construct($data);
	}

	/**
	 * current model table name
	 * @return string
	 */
	public function getTableName() {
		return 'sample_package';
	}


	/**
	* get database config
	* @return array
	*/
	protected function getDbConfig(){
		return include dirname(__DIR__).'/db.inc.php';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '样品包装';
	}
}