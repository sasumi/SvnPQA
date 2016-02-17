<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableBusinessOrder

 * @property-read int $id 
 * @property string $order_no 订单号
 * @property int $customer_id 顾客ID
 * @property int $customer_contact_id 联系人ID
 * @property mixed $order_type 订单类型(外贸,内贸)
 * @property string $fob FOB
 * @property string $destination_port 目的港
 * @property int $pay_type_id 支付类型
 * @property string $delivery_date 交货期
 * @property mixed $settle_currency 结算币种(人民币,美元)
 * @property float $total_price 总价(元)
 * @property float $total_volume 总体积(m³)
 * @property int $create_time 创建时间
 * @property int $update_time 修改时间
 * @property mixed $state 状态(草稿,确认订单,关闭)
 * @method static TableBusinessOrder|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableBusinessOrder::DB_READ)
 * @method static TableBusinessOrder|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableBusinessOrder|Query find($statement = '', $var = null, ...$var2)
 * @method static TableBusinessOrder|Query order($statement='')
 * @method static TableBusinessOrder|Query|bool create($data)
 * @method static TableBusinessOrder|Query|array findOneByPk($val, $as_array = false)
 * @method static TableBusinessOrder|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableBusinessOrder|Query|array|null one($as_array = false)
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
abstract class TableBusinessOrder extends Model {
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
				'alias' => '订单号',
				'type' => 'string',
				'length' => 100,
				'default' => '',
				'entity' => true
			),
			'customer_id' => array(
				'alias' => '顾客ID',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'customer_contact_id' => array(
				'alias' => '联系人ID',
				'type' => 'int',
				'length' => 11,
				'default' => 0,
				'entity' => true
			),
			'order_type' => array(
				'alias' => '订单类型',
				'type' => 'enum',
				'default' => 1,
				'options' => array('1'=>'外贸', '2'=>'内贸'),
				'entity' => true
			),
			'fob' => array(
				'alias' => 'FOB',
				'type' => 'string',
				'length' => 100,
				'default' => '',
				'entity' => true
			),
			'destination_port' => array(
				'alias' => '目的港',
				'type' => 'string',
				'length' => 50,
				'default' => '',
				'entity' => true
			),
			'pay_type_id' => array(
				'alias' => '支付类型',
				'type' => 'int',
				'length' => 11,
				'default' => 1,
				'entity' => true
			),
			'delivery_date' => array(
				'alias' => '交货期',
				'type' => 'date',
				'length' => 0,
				'default' => null,
				'entity' => true
			),
			'settle_currency' => array(
				'alias' => '结算币种',
				'type' => 'enum',
				'default' => 1,
				'options' => array('1'=>'人民币', '2'=>'美元'),
				'entity' => true
			),
			'total_price' => array(
				'alias' => '总价',
				'type' => 'float',
				'length' => 10,
				'precision' => 2,
				'description' => '元',
				'default' => 0.00,
				'entity' => true
			),
			'total_volume' => array(
				'alias' => '总体积',
				'type' => 'float',
				'length' => 10,
				'precision' => 2,
				'description' => 'm³',
				'default' => 0.00,
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
				'alias' => '修改时间',
				'type' => 'timestamp',
				'length' => 0,
				'readonly' => true,
				'default' => time(),
				'entity' => true
			),
			'state' => array(
				'alias' => '状态',
				'type' => 'enum',
				'default' => 0,
				'options' => array('0'=>'草稿', '1'=>'确认订单', '2'=>'关闭'),
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
		return 'business_order';
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
		return '订单';
	}
}