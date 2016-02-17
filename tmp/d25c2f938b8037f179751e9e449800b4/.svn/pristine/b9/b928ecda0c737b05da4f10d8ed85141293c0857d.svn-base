<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableDepartmentUser

 * @property-read int $id 
 * @property int $department_id 部门ID
 * @property int $uid 用户id
 * @property int $utype 用户类型 1:工人，2:用户
 * @property int $create_time 添加时间
 * @property int $create_by 操作用户id
 * @method static TableDepartmentUser|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableDepartmentUser::DB_READ)
 * @method static TableDepartmentUser|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableDepartmentUser|Query find($statement = '', $var = null, ...$var2)
 * @method static TableDepartmentUser|Query order($statement='')
 * @method static TableDepartmentUser|Query|bool create($data)
 * @method static TableDepartmentUser|Query|array findOneByPk($val, $as_array = false)
 * @method static TableDepartmentUser|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableDepartmentUser|Query|array|null one($as_array = false)
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
abstract class TableDepartmentUser extends Model {
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
			'department_id' => array(
				'alias' => '部门ID',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'uid' => array(
				'alias' => '用户id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'utype' => array(
				'alias' => '用户类型 1:工人，2:用户',
				'type' => 'int',
				'length' => 1,
				'required' => true,
				'entity' => true
			),
			'create_time' => array(
				'alias' => '添加时间',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'create_by' => array(
				'alias' => '操作用户id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
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
		return 'department_user';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '部门用户';
	}
}