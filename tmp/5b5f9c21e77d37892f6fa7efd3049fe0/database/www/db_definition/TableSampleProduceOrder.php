<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSampleProduceOrder

 * @property-read int $id 
 * @property string $order_no 生产单号
 * @property int $customer_id 客户id
 * @property int $contact_id 联系人ID
 * @property mixed $address 地址
 * @property string $book_delivery_date 寄样日期
 * @property string $produce_finish_date 发布日期
 * @property double $product_fee 样品费
 * @property int $currency_id 货币
 * @property int $boss_head_employee_id 负责人id
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 * @property mixed $produce_type 生产类型(新品开发,客户来样,订单确认)
 * @property int $business_order_id 订单
 * @property mixed $state 状态(待接受,生产中,已完成,已邮寄)
 * @method static TableSampleProduceOrder|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSampleProduceOrder::DB_READ)
 * @method static TableSampleProduceOrder|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSampleProduceOrder|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSampleProduceOrder|Query order($statement='')
 * @method static TableSampleProduceOrder|Query|bool create($data)
 * @method static TableSampleProduceOrder|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSampleProduceOrder|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSampleProduceOrder|Query|array|null one($as_array = false)
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
abstract class TableSampleProduceOrder extends Model {
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
			'order_no' => array(
				'alias' => '生产单号',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'unique' => true,
				'entity' => true
			),
			'customer_id' => array(
				'alias' => '客户id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'contact_id' => array(
				'alias' => '联系人ID',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'min' => 0,
				'entity' => true
			),
			'address' => array(
				'alias' => '地址',
				'type' => 'text',
				'length' => 0,
				'required' => true,
				'entity' => true
			),
			'book_delivery_date' => array(
				'alias' => '寄样日期',
				'type' => 'date',
				'length' => 0,
				'default' => '0000-00-00',
				'entity' => true
			),
			'produce_finish_date' => array(
				'alias' => '发布日期',
				'type' => 'date',
				'length' => 0,
				'required' => true,
				'entity' => true
			),
			'product_fee' => array(
				'alias' => '样品费',
				'type' => 'double',
				'length' => 10,
				'precision' => 2,
				'min' => 0,
				'default' => 0.00,
				'entity' => true
			),
			'currency_id' => array(
				'alias' => '货币',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'entity' => true
			),
			'boss_head_employee_id' => array(
				'alias' => '负责人id',
				'type' => 'int',
				'length' => 11,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'create_time' => array(
				'alias' => '创建时间',
				'type' => 'timestamp',
				'length' => 0,
				'readonly' => true,
				'default' => time(),
				'entity' => true
			),
			'update_time' => array(
				'alias' => '更新时间',
				'type' => 'timestamp',
				'length' => 0,
				'readonly' => true,
				'default' => time(),
				'entity' => true
			),
			'produce_type' => array(
				'alias' => '生产类型',
				'type' => 'enum',
				'default' => 1,
				'options' => array('1'=>'新品开发', '2'=>'客户来样', '3'=>'订单确认'),
				'entity' => true
			),
			'business_order_id' => array(
				'alias' => '订单',
				'type' => 'int',
				'length' => 10,
				'default' => 0,
				'entity' => true
			),
			'state' => array(
				'alias' => '状态',
				'type' => 'enum',
				'default' => 0,
				'options' => array('0'=>'待接受', '1'=>'生产中', '2'=>'已完成', '3'=>'已邮寄'),
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
		return 'sample_produce_order';
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
		return '样品生产单';
	}
}