<?php
namespace www\model\table;

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
 * @property mixed $source 客户来源(广交会,国际站,诚信通,官网)
 * @property mixed $source_desc 来源备注
 * @property mixed $type 客户类型(国外采购商,超市连锁店,小经营者,外贸公司,电商)
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
				'required' => true,
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
				'type' => 'enum',
				'length' => 1234,
				'required' => true,
				'default' => 2,
				'options' => array('1'=>'广交会', '2'=>'国际站', '3'=>'诚信通', '4'=>'官网'),
				'entity' => true
			),
			'source_desc' => array(
				'alias' => '来源备注',
				'type' => 'text',
				'length' => 0,
				'entity' => true
			),
			'type' => array(
				'alias' => '客户类型',
				'type' => 'enum',
				'length' => 12345,
				'default' => 1,
				'options' => array('1'=>'国外采购商', '2'=>'超市连锁店', '3'=>'小经营者', '4'=>'外贸公司', '5'=>'电商'),
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
				'entity' => true
			),
			'create_time' => array(
				'alias' => '创建时间',
				'type' => 'timestamp',
				'length' => 0,
				'required' => true,
				'readonly' => true,
				'entity' => true
			),
			'op_user_id' => array(
				'alias' => '操作员ID',
				'type' => 'int',
				'length' => 11,
				'required' => true,
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
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '客户';
	}
}