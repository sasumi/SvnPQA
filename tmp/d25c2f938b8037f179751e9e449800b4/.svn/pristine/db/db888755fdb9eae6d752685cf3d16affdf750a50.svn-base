<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableDepartment

 * @property-read int $id 
 * @property string $name 部门名称
 * @property int $parent_id 上级部门ID
 * @property int $manager_id 部门负责人id
 * @property int $stage_id 负责流程
 * @property mixed $description 描述
 * @property mixed $state 状态(禁用,启用)
 * @method static TableDepartment|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableDepartment::DB_READ)
 * @method static TableDepartment|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableDepartment|Query find($statement = '', $var = null, ...$var2)
 * @method static TableDepartment|Query order($statement='')
 * @method static TableDepartment|Query|bool create($data)
 * @method static TableDepartment|Query|array findOneByPk($val, $as_array = false)
 * @method static TableDepartment|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableDepartment|Query|array|null one($as_array = false)
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
abstract class TableDepartment extends Model {
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
			'name' => array(
				'alias' => '部门名称',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'entity' => true
			),
			'parent_id' => array(
				'alias' => '上级部门ID',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'default' => 0,
				'entity' => true
			),
			'manager_id' => array(
				'alias' => '部门负责人id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'default' => 0,
				'entity' => true
			),
			'stage_id' => array(
				'alias' => '负责流程',
				'type' => 'int',
				'length' => 2,
				'required' => true,
				'default' => 0,
				'entity' => true
			),
			'description' => array(
				'alias' => '描述',
				'type' => 'text',
				'length' => 0,
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
		return 'department';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '部门';
	}
}