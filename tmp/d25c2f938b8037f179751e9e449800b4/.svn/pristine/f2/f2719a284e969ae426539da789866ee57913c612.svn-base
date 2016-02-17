<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableWorkProcess

 * @property-read int $id 
 * @property int $work_stage_id 流程
 * @property string $name 工序名称
 * @property int $ord 排序
 * @property mixed $state 状态(禁用,启用)
 * @method static TableWorkProcess|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableWorkProcess::DB_READ)
 * @method static TableWorkProcess|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableWorkProcess|Query find($statement = '', $var = null, ...$var2)
 * @method static TableWorkProcess|Query order($statement='')
 * @method static TableWorkProcess|Query|bool create($data)
 * @method static TableWorkProcess|Query|array findOneByPk($val, $as_array = false)
 * @method static TableWorkProcess|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableWorkProcess|Query|array|null one($as_array = false)
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
abstract class TableWorkProcess extends Model {
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
			'work_stage_id' => array(
				'alias' => '流程',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'name' => array(
				'alias' => '工序名称',
				'type' => 'string',
				'length' => 20,
				'required' => true,
				'entity' => true
			),
			'ord' => array(
				'alias' => '排序',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'default' => 0,
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
		return 'work_process';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '工作流';
	}
}