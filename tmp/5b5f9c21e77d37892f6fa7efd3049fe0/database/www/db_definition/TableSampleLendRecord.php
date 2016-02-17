<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSampleLendRecord

 * @property-read int $id 样品借出记录ID
 * @property int $sample_id 样品id
 * @property int $apply_user_id 申请人id
 * @property int $create_time 申请时间
 * @property mixed $desc 备注说明
 * @method static TableSampleLendRecord|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSampleLendRecord::DB_READ)
 * @method static TableSampleLendRecord|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSampleLendRecord|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSampleLendRecord|Query order($statement='')
 * @method static TableSampleLendRecord|Query|bool create($data)
 * @method static TableSampleLendRecord|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSampleLendRecord|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSampleLendRecord|Query|array|null one($as_array = false)
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
abstract class TableSampleLendRecord extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => '样品借出记录ID',
				'type' => 'int',
				'length' => 11,
				'primary' => true,
				'required' => true,
				'readonly' => true,
				'entity' => true
			),
			'sample_id' => array(
				'alias' => '样品id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'apply_user_id' => array(
				'alias' => '申请人id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'create_time' => array(
				'alias' => '申请时间',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'desc' => array(
				'alias' => '备注说明',
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
		return 'sample_lend_record';
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
		return '样品借出日志';
	}
}