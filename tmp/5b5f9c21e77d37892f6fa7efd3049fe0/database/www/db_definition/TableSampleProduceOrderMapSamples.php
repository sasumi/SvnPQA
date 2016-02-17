<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSampleProduceOrderMapSamples

 * @property-read int $id 
 * @property int $produce_order_id 样品生产单id
 * @property int $sample_id 样品id
 * @property mixed $produce_request 生产要求
 * @property int $produce_num 生产数量
 * @property int $produce_process_state 生产工序状态
 * @property int $produce_employee_id 当前生产用户
 * @property mixed $state 状态(默认,已完成)
 * @method static TableSampleProduceOrderMapSamples|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSampleProduceOrderMapSamples::DB_READ)
 * @method static TableSampleProduceOrderMapSamples|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSampleProduceOrderMapSamples|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSampleProduceOrderMapSamples|Query order($statement='')
 * @method static TableSampleProduceOrderMapSamples|Query|bool create($data)
 * @method static TableSampleProduceOrderMapSamples|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSampleProduceOrderMapSamples|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSampleProduceOrderMapSamples|Query|array|null one($as_array = false)
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
abstract class TableSampleProduceOrderMapSamples extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => 'id',
				'type' => 'int',
				'length' => 11,
				'primary' => true,
				'required' => true,
				'readonly' => true,
				'entity' => true
			),
			'produce_order_id' => array(
				'alias' => '样品生产单id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'sample_id' => array(
				'alias' => '样品id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'produce_request' => array(
				'alias' => '生产要求',
				'type' => 'text',
				'length' => 0,
				'default' => null,
				'entity' => true
			),
			'produce_num' => array(
				'alias' => '生产数量',
				'type' => 'int',
				'length' => 45,
				'required' => true,
				'min' => 0,
				'entity' => true
			),
			'produce_process_state' => array(
				'alias' => '生产工序状态',
				'type' => 'int',
				'length' => 10,
				'default' => 0,
				'entity' => true
			),
			'produce_employee_id' => array(
				'alias' => '当前生产用户',
				'type' => 'int',
				'length' => 11,
				'default' => 0,
				'entity' => true
			),
			'state' => array(
				'alias' => '状态',
				'type' => 'enum',
				'default' => 0,
				'options' => array('0'=>'默认', '1'=>'已完成'),
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
		return 'sample_produce_order_map_samples';
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
		return '样品表';
	}
}