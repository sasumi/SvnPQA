<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableCustomerFinancial

 * @property-read int $id 
 * @property int $customer_id 
 * @property string $account_name 账户名
 * @property string $account_bank 开户行
 * @property string $account_no 账号
 * @property string $tax_no 税号
 * @property mixed $desc 备注
 * @method static TableCustomerFinancial|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableCustomerFinancial::DB_READ)
 * @method static TableCustomerFinancial|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableCustomerFinancial|Query find($statement = '', $var = null, ...$var2)
 * @method static TableCustomerFinancial|Query order($statement='')
 * @method static TableCustomerFinancial|Query|bool create($data)
 * @method static TableCustomerFinancial|Query|array findOneByPk($val, $as_array = false)
 * @method static TableCustomerFinancial|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableCustomerFinancial|Query|array|null one($as_array = false)
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
abstract class TableCustomerFinancial extends Model {
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
			'customer_id' => array(
				'alias' => 'customer_id',
				'type' => 'int',
				'length' => 11,
				'default' => null,
				'entity' => true
			),
			'account_name' => array(
				'alias' => '账户名',
				'type' => 'string',
				'length' => 45,
				'default' => null,
				'entity' => true
			),
			'account_bank' => array(
				'alias' => '开户行',
				'type' => 'string',
				'length' => 45,
				'default' => null,
				'entity' => true
			),
			'account_no' => array(
				'alias' => '账号',
				'type' => 'string',
				'length' => 45,
				'default' => null,
				'entity' => true
			),
			'tax_no' => array(
				'alias' => '税号',
				'type' => 'string',
				'length' => 45,
				'default' => null,
				'entity' => true
			),
			'desc' => array(
				'alias' => '备注',
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
		return 'customer_financial';
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
		return '客户财务信息';
	}
}