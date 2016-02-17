<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableColorGlaze

 * @property-read int $id 色号
 * @property mixed $type 类型(色釉,色料)
 * @property string $color_no 色号
 * @property string $pantone_no 潘通号
 * @property string $image_url 图片
 * @property mixed $baking_atmosphere 烧成氛围(氧化,还原)
 * @property mixed $temperature_type 烧成温度(低温,中温,高温)
 * @property int $adapt_material 适配材料
 * @property mixed $formula 配方组成
 * @property mixed $desc 备注说明
 * @method static TableColorGlaze|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableColorGlaze::DB_READ)
 * @method static TableColorGlaze|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableColorGlaze|Query find($statement = '', $var = null, ...$var2)
 * @method static TableColorGlaze|Query order($statement='')
 * @method static TableColorGlaze|Query|bool create($data)
 * @method static TableColorGlaze|Query|array findOneByPk($val, $as_array = false)
 * @method static TableColorGlaze|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableColorGlaze|Query|array|null one($as_array = false)
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
abstract class TableColorGlaze extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => '色号',
				'type' => 'int',
				'length' => 11,
				'primary' => true,
				'required' => true,
				'readonly' => true,
				'entity' => true
			),
			'type' => array(
				'alias' => '类型',
				'type' => 'enum',
				'primary' => true,
				'required' => true,
				'options' => array('1'=>'色釉', '2'=>'色料'),
				'entity' => true
			),
			'color_no' => array(
				'alias' => '色号',
				'type' => 'string',
				'length' => 45,
				'default' => '',
				'entity' => true
			),
			'pantone_no' => array(
				'alias' => '潘通号',
				'type' => 'string',
				'length' => 45,
				'default' => '',
				'entity' => true
			),
			'image_url' => array(
				'alias' => '图片',
				'type' => 'string',
				'length' => 45,
				'default' => null,
				'entity' => true
			),
			'baking_atmosphere' => array(
				'alias' => '烧成氛围',
				'type' => 'enum',
				'default' => 1,
				'options' => array('1'=>'氧化', '2'=>'还原'),
				'entity' => true
			),
			'temperature_type' => array(
				'alias' => '烧成温度',
				'type' => 'enum',
				'default' => 1,
				'options' => array('1'=>'低温', '2'=>'中温', '3'=>'高温'),
				'entity' => true
			),
			'adapt_material' => array(
				'alias' => '适配材料',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'formula' => array(
				'alias' => '配方组成',
				'type' => 'text',
				'length' => 0,
				'default' => null,
				'entity' => true
			),
			'desc' => array(
				'alias' => '备注说明',
				'type' => 'text',
				'length' => 0,
				'default' => null,
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
		return 'color_glaze';
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
		return '色号';
	}
}