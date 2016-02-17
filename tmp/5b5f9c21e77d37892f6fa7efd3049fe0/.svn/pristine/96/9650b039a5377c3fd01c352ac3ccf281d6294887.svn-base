<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableUserGroupAuth

 * @property-read int $id 主键
 * @property int $user_group_id 用户组
 * @property int $action_id 权限
 * @property mixed $type 类型(白名单,黑名单)
 * @method static TableUserGroupAuth|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableUserGroupAuth::DB_READ)
 * @method static TableUserGroupAuth|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableUserGroupAuth|Query find($statement = '', $var = null, ...$var2)
 * @method static TableUserGroupAuth|Query order($statement='')
 * @method static TableUserGroupAuth|Query|bool create($data)
 * @method static TableUserGroupAuth|Query|array findOneByPk($val, $as_array = false)
 * @method static TableUserGroupAuth|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableUserGroupAuth|Query|array|null one($as_array = false)
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
abstract class TableUserGroupAuth extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => '主键',
				'type' => 'int',
				'length' => 10,
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
			'action_id' => array(
				'alias' => '权限',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'entity' => true
			),
			'type' => array(
				'alias' => '类型',
				'type' => 'enum',
				'length' => 1,
				'required' => true,
				'default' => 0,
				'options' => array('0'=>'白名单', '1'=>'黑名单'),
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
		return 'user_group_auth';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '用户组权限';
	}
}