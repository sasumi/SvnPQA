<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableCustomerContact

 * @property-read int $id 
 * @property int $customer_id 客户id
 * @property string $chinese_name 中文名
 * @property string $english_name 英文名
 * @property string $birthday 生日
 * @property string $office_position 职位
 * @property string $mobile 手机
 * @property string $tel 电话
 * @property string $email 邮箱
 * @property mixed $desc 备注
 * @method static TableCustomerContact|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableCustomerContact::DB_READ)
 * @method static TableCustomerContact|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableCustomerContact|Query find($statement = '', $var = null, ...$var2)
 * @method static TableCustomerContact|Query order($statement='')
 * @method static TableCustomerContact|Query|bool create($data)
 * @method static TableCustomerContact|Query|array findOneByPk($val, $as_array = false)
 * @method static TableCustomerContact|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableCustomerContact|Query|array|null one($as_array = false)
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
abstract class TableCustomerContact extends Model {
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
				'alias' => '客户id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'min' => 0,
				'entity' => true
			),
			'chinese_name' => array(
				'alias' => '中文名',
				'type' => 'string',
				'length' => 45,
				'default' => null,
				'entity' => true
			),
			'english_name' => array(
				'alias' => '英文名',
				'type' => 'string',
				'length' => 45,
				'default' => null,
				'entity' => true
			),
			'birthday' => array(
				'alias' => '生日',
				'type' => 'date',
				'length' => 0,
				'default' => '0000-00-00',
				'entity' => true
			),
			'office_position' => array(
				'alias' => '职位',
				'type' => 'string',
				'length' => 45,
				'default' => null,
				'entity' => true
			),
			'mobile' => array(
				'alias' => '手机',
				'type' => 'string',
				'length' => 45,
				'default' => null,
				'entity' => true
			),
			'tel' => array(
				'alias' => '电话',
				'type' => 'string',
				'length' => 45,
				'default' => null,
				'entity' => true
			),
			'email' => array(
				'alias' => '邮箱',
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
		return 'customer_contact';
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
		return '客户联系人';
	}
}