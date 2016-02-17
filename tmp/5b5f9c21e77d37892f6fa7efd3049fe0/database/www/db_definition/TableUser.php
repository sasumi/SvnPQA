<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableUser

 * @property-read int $id 
 * @property int $user_group_id 用户组
 * @property string $name 用户名
 * @property string $password 密码
 * @property string $real_name 真实姓名
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 * @property string $last_login_time 最后登录时间
 * @property string $last_login_ip 最后登录IP
 * @property mixed $state 状态(禁用,启用)
 * @method static TableUser|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableUser::DB_READ)
 * @method static TableUser|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableUser|Query find($statement = '', $var = null, ...$var2)
 * @method static TableUser|Query order($statement='')
 * @method static TableUser|Query|bool create($data)
 * @method static TableUser|Query|array findOneByPk($val, $as_array = false)
 * @method static TableUser|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableUser|Query|array|null one($as_array = false)
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
abstract class TableUser extends Model {
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
			'user_group_id' => array(
				'alias' => '用户组',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'entity' => true
			),
			'name' => array(
				'alias' => '用户名',
				'type' => 'string',
				'length' => 32,
				'required' => true,
				'unique' => true,
				'entity' => true
			),
			'password' => array(
				'alias' => '密码',
				'type' => 'string',
				'length' => 32,
				'required' => true,
				'entity' => true
			),
			'real_name' => array(
				'alias' => '真实姓名',
				'type' => 'string',
				'length' => 45,
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
			'update_time' => array(
				'alias' => '更新时间',
				'type' => 'timestamp',
				'length' => 0,
				'readonly' => true,
				'default' => '0000-00-00 00:00:00',
				'entity' => true
			),
			'last_login_time' => array(
				'alias' => '最后登录时间',
				'type' => 'datetime',
				'length' => 0,
				'default' => '0000-00-00 00:00:00',
				'entity' => true
			),
			'last_login_ip' => array(
				'alias' => '最后登录IP',
				'type' => 'string',
				'length' => 15,
				'default' => '',
				'entity' => true
			),
			'state' => array(
				'alias' => '状态',
				'type' => 'enum',
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
		return 'user';
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
		return '用户';
	}
}