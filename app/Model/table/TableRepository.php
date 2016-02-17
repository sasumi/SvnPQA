<?php
namespace SvnPQA\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableRepository

 * @property-read int $id 
 * @property mixed $address 地址
 * @property string $user 用户名
 * @property string $password 密码
 * @property int $update_time 更新时间
 * @property int $create_time 创建时间
 * @method static TableRepository|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableRepository::DB_READ)
 * @method static TableRepository|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableRepository|Query find($statement = '', $var = null, ...$var2)
 * @method static TableRepository|Query order($statement='')
 * @method static TableRepository|Query|bool create($data)
 * @method static TableRepository|Query|array findOneByPk($val, $as_array = false)
 * @method static TableRepository|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableRepository|Query|array|null one($as_array = false)
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
abstract class TableRepository extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => 'id',
				'type' => 'int',
				'length' => 10,
				'primary' => true,
				'required' => true,
				'readonly' => true,
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
			'user' => array(
				'alias' => '用户名',
				'type' => 'string',
				'length' => 50,
				'required' => true,
				'entity' => true
			),
			'password' => array(
				'alias' => '密码',
				'type' => 'string',
				'length' => 50,
				'required' => true,
				'entity' => true
			),
			'update_time' => array(
				'alias' => '更新时间',
				'type' => 'timestamp',
				'length' => 0,
				'required' => true,
				'readonly' => true,
				'default' => '',
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
		));
		parent::__construct($data);
	}

	/**
	 * current model table name
	 * @return string
	 */
	public function getTableName() {
		return 'repository';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '资源库';
	}
}