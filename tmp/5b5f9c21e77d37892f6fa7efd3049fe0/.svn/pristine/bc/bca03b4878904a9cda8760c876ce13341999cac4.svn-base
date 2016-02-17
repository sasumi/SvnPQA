<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableBusinessOrderPayment

 * @property-read int $id 
 * @property int $business_order_id 订单ID
 * @property float $earnest_money 已付定金(元)
 * @property string $receipt_date 收款日期
 * @property int $pay_type_id 支付方式
 * @property string $append_file_url 附件
 * @property string $delivery_date 交货日期
 * @property mixed $desc 备注
 * @property int $create_time 创建时间
 * @method static TableBusinessOrderPayment|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableBusinessOrderPayment::DB_READ)
 * @method static TableBusinessOrderPayment|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableBusinessOrderPayment|Query find($statement = '', $var = null, ...$var2)
 * @method static TableBusinessOrderPayment|Query order($statement='')
 * @method static TableBusinessOrderPayment|Query|bool create($data)
 * @method static TableBusinessOrderPayment|Query|array findOneByPk($val, $as_array = false)
 * @method static TableBusinessOrderPayment|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableBusinessOrderPayment|Query|array|null one($as_array = false)
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
abstract class TableBusinessOrderPayment extends Model {
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
			'business_order_id' => array(
				'alias' => '订单ID',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'earnest_money' => array(
				'alias' => '已付定金',
				'type' => 'float',
				'length' => 10,
				'precision' => 2,
				'description' => '元',
				'default' => 0.00,
				'entity' => true
			),
			'receipt_date' => array(
				'alias' => '收款日期',
				'type' => 'date',
				'length' => 0,
				'default' => null,
				'entity' => true
			),
			'pay_type_id' => array(
				'alias' => '支付方式',
				'type' => 'int',
				'length' => 11,
				'default' => 0,
				'entity' => true
			),
			'append_file_url' => array(
				'alias' => '附件',
				'type' => 'string',
				'length' => 200,
				'default' => '',
				'entity' => true
			),
			'delivery_date' => array(
				'alias' => '交货日期',
				'type' => 'date',
				'length' => 0,
				'required' => true,
				'entity' => true
			),
			'desc' => array(
				'alias' => '备注',
				'type' => 'text',
				'length' => 0,
				'required' => true,
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
		return 'business_order_payment';
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
		return '订单支付信息';
	}
}