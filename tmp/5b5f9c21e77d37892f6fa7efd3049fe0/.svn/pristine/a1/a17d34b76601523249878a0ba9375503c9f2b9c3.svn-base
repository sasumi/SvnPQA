<?php
namespace www\model\table;

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
 * @property mixed $produce_type 生产类型(新品开发,客户来样,订单确认)
 * @property mixed $produce_request 生产要求
 * @property int $produce_num 生产数量
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
			'produce_type' => array(
				'alias' => '生产类型',
				'type' => 'enum',
				'length' => 123,
				'required' => true,
				'default' => 1,
				'options' => array('1'=>'新品开发', '2'=>'客户来样', '3'=>'订单确认'),
				'entity' => true
			),
			'produce_request' => array(
				'alias' => '生产要求',
				'type' => 'text',
				'length' => 0,
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
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '样品表';
	}
}