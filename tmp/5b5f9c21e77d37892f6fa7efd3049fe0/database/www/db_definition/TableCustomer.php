<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableCustomer

 * @property-read int $id 
 * @property string $customer_no 客户号
 * @property string $company_alias_name 公司简称
 * @property string $company_full_name 公司全称
 * @property int $source 客户来源
 * @property mixed $source_desc 来源备注
 * @property int $type 客户类型
 * @property string $type_desc 类型备注
 * @property string $country 国家
 * @property string $city 城市
 * @property string $post_code 邮编
 * @property mixed $address 地址
 * @property string $tel 电话
 * @property string $fax 传真
 * @property string $site 网址
 * @property mixed $desc 备注
 * @property int $create_time 创建时间
 * @property int $op_user_id 操作员ID
 * @method static TableCustomer|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableCustomer::DB_READ)
 * @method static TableCustomer|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableCustomer|Query find($statement = '', $var = null, ...$var2)
 * @method static TableCustomer|Query order($statement='')
 * @method static TableCustomer|Query|bool create($data)
 * @method static TableCustomer|Query|array findOneByPk($val, $as_array = false)
 * @method static TableCustomer|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableCustomer|Query|array|null one($as_array = false)
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
abstract class TableCustomer extends Model {
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
			'customer_no' => array(
				'alias' => '客户号',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'entity' => true
			),
			'company_alias_name' => array(
				'alias' => '公司简称',
				'type' => 'string',
				'length' => 100,
				'default' => '',
				'entity' => true
			),
			'company_full_name' => array(
				'alias' => '公司全称',
				'type' => 'string',
				'length' => 100,
				'default' => '',
				'entity' => true
			),
			'source' => array(
				'alias' => '客户来源',
				'type' => 'int',
				'length' => 10,
				'default' => 1,
				'entity' => true
			),
			'source_desc' => array(
				'alias' => '来源备注',
				'type' => 'text',
				'length' => 0,
				'default' => null,
				'entity' => true
			),
			'type' => array(
				'alias' => '客户类型',
				'type' => 'int',
				'length' => 10,
				'default' => 1,
				'entity' => true
			),
			'type_desc' => array(
				'alias' => '类型备注',
				'type' => 'string',
				'length' => 200,
				'default' => '',
				'entity' => true
			),
			'country' => array(
				'alias' => '国家',
				'type' => 'string',
				'length' => 50,
				'default' => '',
				'entity' => true
			),
			'city' => array(
				'alias' => '城市',
				'type' => 'string',
				'length' => 45,
				'default' => '',
				'entity' => true
			),
			'post_code' => array(
				'alias' => '邮编',
				'type' => 'string',
				'length' => 45,
				'default' => '',
				'entity' => true
			),
			'address' => array(
				'alias' => '地址',
				'type' => 'text',
				'length' => 0,
				'default' => null,
				'entity' => true
			),
			'tel' => array(
				'alias' => '电话',
				'type' => 'string',
				'length' => 45,
				'default' => '',
				'entity' => true
			),
			'fax' => array(
				'alias' => '传真',
				'type' => 'string',
				'length' => 45,
				'default' => '',
				'entity' => true
			),
			'site' => array(
				'alias' => '网址',
				'type' => 'string',
				'length' => 100,
				'default' => '',
				'entity' => true
			),
			'desc' => array(
				'alias' => '备注',
				'type' => 'text',
				'length' => 0,
				'default' => null,
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
			'op_user_id' => array(
				'alias' => '操作员ID',
				'type' => 'int',
				'length' => 11,
				'default' => 0,
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
		return 'customer';
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
		return '客户';
	}
}