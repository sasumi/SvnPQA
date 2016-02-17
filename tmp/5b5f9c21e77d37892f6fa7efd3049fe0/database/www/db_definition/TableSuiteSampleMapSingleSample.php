<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSuiteSampleMapSingleSample

 * @property-read int $id 
 * @property int $suite_sample_id 
 * @property int $single_sample_id 
 * @method static TableSuiteSampleMapSingleSample|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSuiteSampleMapSingleSample::DB_READ)
 * @method static TableSuiteSampleMapSingleSample|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSuiteSampleMapSingleSample|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSuiteSampleMapSingleSample|Query order($statement='')
 * @method static TableSuiteSampleMapSingleSample|Query|bool create($data)
 * @method static TableSuiteSampleMapSingleSample|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSuiteSampleMapSingleSample|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSuiteSampleMapSingleSample|Query|array|null one($as_array = false)
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
abstract class TableSuiteSampleMapSingleSample extends Model {
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
			'suite_sample_id' => array(
				'alias' => 'suite_sample_id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'single_sample_id' => array(
				'alias' => 'single_sample_id',
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
		return 'suite_sample_map_single_sample';
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
		return '套件单件清单';
	}
}