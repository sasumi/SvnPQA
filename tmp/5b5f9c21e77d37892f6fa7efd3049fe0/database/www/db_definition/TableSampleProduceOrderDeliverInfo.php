<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSampleProduceOrderDeliverInfo

 * @property-read int $id 
 * @property int $produce_order_id 生产单ID
 * @property string $customer_name 客户名称
 * @property mixed $address 邮寄地址
 * @property string $contact 联系人
 * @property string $phone 电话
 * @property string $deliver_date 邮寄时间
 * @property int $logistics_company 物流公司
 * @property string $logistics_no 物流单号
 * @property mixed $fee_type 费用类型(寄方付,收方付)
 * @property double $fee 物流费用(元)
 * @property int $fee_currency_id 货币
 * @property int $update_time 更新时间
 * @property int $create_time 创建时间
 * @method static TableSampleProduceOrderDeliverInfo|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSampleProduceOrderDeliverInfo::DB_READ)
 * @method static TableSampleProduceOrderDeliverInfo|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSampleProduceOrderDeliverInfo|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSampleProduceOrderDeliverInfo|Query order($statement='')
 * @method static TableSampleProduceOrderDeliverInfo|Query|bool create($data)
 * @method static TableSampleProduceOrderDeliverInfo|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSampleProduceOrderDeliverInfo|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSampleProduceOrderDeliverInfo|Query|array|null one($as_array = false)
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
abstract class TableSampleProduceOrderDeliverInfo extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => 'id',
				'type' => 'int',
				'length' => 10,
				'primary' => true,
				'required' => true,
				'readonly' => true,
				'entity' => true
			),
			'produce_order_id' => array(
				'alias' => '生产单ID',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'entity' => true
			),
			'customer_name' => array(
				'alias' => '客户名称',
				'type' => 'string',
				'length' => 50,
				'required' => true,
				'entity' => true
			),
			'address' => array(
				'alias' => '邮寄地址',
				'type' => 'text',
				'length' => 0,
				'required' => true,
				'entity' => true
			),
			'contact' => array(
				'alias' => '联系人',
				'type' => 'string',
				'length' => 50,
				'required' => true,
				'entity' => true
			),
			'phone' => array(
				'alias' => '电话',
				'type' => 'string',
				'length' => 50,
				'required' => true,
				'entity' => true
			),
			'deliver_date' => array(
				'alias' => '邮寄时间',
				'type' => 'date',
				'length' => 0,
				'required' => true,
				'entity' => true
			),
			'logistics_company' => array(
				'alias' => '物流公司',
				'type' => 'int',
				'length' => 10,
				'default' => 0,
				'entity' => true
			),
			'logistics_no' => array(
				'alias' => '物流单号',
				'type' => 'string',
				'length' => 50,
				'required' => true,
				'entity' => true
			),
			'fee_type' => array(
				'alias' => '费用类型',
				'type' => 'enum',
				'default' => 1,
				'options' => array('1'=>'寄方付', '2'=>'收方付'),
				'entity' => true
			),
			'fee' => array(
				'alias' => '物流费用',
				'type' => 'double',
				'length' => 10,
				'precision' => 2,
				'description' => '元',
				'default' => 0.00,
				'entity' => true
			),
			'fee_currency_id' => array(
				'alias' => '货币',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'entity' => true
			),
			'update_time' => array(
				'alias' => '更新时间',
				'type' => 'timestamp',
				'length' => 0,
				'readonly' => true,
				'default' => '0000-00-00 00:00:00',
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
		));
		parent::__construct($data);
	}

	/**
	 * current model table name
	 * @return string
	 */
	public function getTableName() {
		return 'sample_produce_order_deliver_info';
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
		return '邮寄信息';
	}
}