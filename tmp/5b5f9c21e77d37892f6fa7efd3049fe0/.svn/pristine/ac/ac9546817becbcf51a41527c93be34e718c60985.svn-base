<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSampleMould

 * @property-read int $id 模具ID
 * @property int $sample_id sku_id
 * @property int $sample_mould_category_id 模具分类
 * @property string $name 模具名称
 * @property double $weight 重量
 * @property int $mould_num 模具块数
 * @property int $product_num 产品数
 * @property string $freight_space 模具仓位
 * @method static TableSampleMould|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSampleMould::DB_READ)
 * @method static TableSampleMould|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSampleMould|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSampleMould|Query order($statement='')
 * @method static TableSampleMould|Query|bool create($data)
 * @method static TableSampleMould|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSampleMould|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSampleMould|Query|array|null one($as_array = false)
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
abstract class TableSampleMould extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => '模具ID',
				'type' => 'int',
				'length' => 11,
				'primary' => true,
				'required' => true,
				'readonly' => true,
				'entity' => true
			),
			'sample_id' => array(
				'alias' => 'sku_id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'sample_mould_category_id' => array(
				'alias' => '模具分类',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'min' => 0,
				'entity' => true
			),
			'name' => array(
				'alias' => '模具名称',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'entity' => true
			),
			'weight' => array(
				'alias' => '重量',
				'type' => 'double',
				'length' => 10,
				'precision' => 2,
				'min' => 0,
				'default' => 0.00,
				'entity' => true
			),
			'mould_num' => array(
				'alias' => '模具块数',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'min' => 0,
				'entity' => true
			),
			'product_num' => array(
				'alias' => '产品数',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'min' => 0,
				'entity' => true
			),
			'freight_space' => array(
				'alias' => '模具仓位',
				'type' => 'string',
				'length' => 50,
				'default' => '',
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
		return 'sample_mould';
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
		return '模具';
	}
}