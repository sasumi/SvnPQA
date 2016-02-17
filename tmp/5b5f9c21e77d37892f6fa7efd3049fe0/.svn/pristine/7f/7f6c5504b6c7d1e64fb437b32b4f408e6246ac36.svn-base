<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSampleWorkAccount

 * @property-read int $id 工价核算ID
 * @property int $sample_id 样品ID
 * @property int $technic_flow_id 工艺流程id
 * @property float $price 价格
 * @method static TableSampleWorkAccount|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSampleWorkAccount::DB_READ)
 * @method static TableSampleWorkAccount|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSampleWorkAccount|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSampleWorkAccount|Query order($statement='')
 * @method static TableSampleWorkAccount|Query|bool create($data)
 * @method static TableSampleWorkAccount|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSampleWorkAccount|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSampleWorkAccount|Query|array|null one($as_array = false)
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
abstract class TableSampleWorkAccount extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => '工价核算ID',
				'type' => 'int',
				'length' => 11,
				'primary' => true,
				'required' => true,
				'readonly' => true,
				'entity' => true
			),
			'sample_id' => array(
				'alias' => '样品ID',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'technic_flow_id' => array(
				'alias' => '工艺流程id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'price' => array(
				'alias' => '价格',
				'type' => 'float',
				'length' => 112,
				'required' => true,
				'precision' => 2,
				'default' => 0.00,
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
		return 'sample_work_account';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '样品工价';
	}
}