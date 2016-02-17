<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableCustomerType

 * @property-read int $id 
 * @property string $name 名称
 * @property mixed $state 状态(禁用,启用)
 * @method static TableCustomerType|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableCustomerType::DB_READ)
 * @method static TableCustomerType|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableCustomerType|Query find($statement = '', $var = null, ...$var2)
 * @method static TableCustomerType|Query order($statement='')
 * @method static TableCustomerType|Query|bool create($data)
 * @method static TableCustomerType|Query|array findOneByPk($val, $as_array = false)
 * @method static TableCustomerType|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableCustomerType|Query|array|null one($as_array = false)
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
abstract class TableCustomerType extends Model {
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
			'name' => array(
				'alias' => '名称',
				'type' => 'string',
				'length' => 50,
				'required' => true,
				'entity' => true
			),
			'state' => array(
				'alias' => '状态',
				'type' => 'enum',
				'length' => 1,
				'required' => true,
				'default' => 0,
				'options' => array('0'=>'禁用', '1'=>'启用'),
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
		return 'customer_type';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '客户类型';
	}
}