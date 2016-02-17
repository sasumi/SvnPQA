<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSingleSample

 * @property-read int $id 
 * @property int $sample_id 样品ID
 * @property float $length 长
 * @property float $width 宽
 * @property float $height 高
 * @property float $volume 容积
 * @property float $weight 重量
 * @property mixed $technic_flow_id_list 工艺流程(模具,成型,素烧,釉下工艺,釉烧,釉上工艺,烘烤,包装)
 * @method static TableSingleSample|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSingleSample::DB_READ)
 * @method static TableSingleSample|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSingleSample|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSingleSample|Query order($statement='')
 * @method static TableSingleSample|Query|bool create($data)
 * @method static TableSingleSample|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSingleSample|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSingleSample|Query|array|null one($as_array = false)
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
abstract class TableSingleSample extends Model {
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
			'sample_id' => array(
				'alias' => '样品ID',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'min' => 0,
				'entity' => true
			),
			'length' => array(
				'alias' => '长',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'width' => array(
				'alias' => '宽',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'height' => array(
				'alias' => '高',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'volume' => array(
				'alias' => '容积',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'weight' => array(
				'alias' => '重量',
				'type' => 'float',
				'length' => 0,
				'min' => 0,
				'default' => 0,
				'entity' => true
			),
			'technic_flow_id_list' => array(
				'alias' => '工艺流程',
				'type' => 'set',
				'length' => 12345678,
				'options' => array('1'=>'模具', '2'=>'成型', '3'=>'素烧', '4'=>'釉下工艺', '5'=>'釉烧', '6'=>'釉上工艺', '7'=>'烘烤', '8'=>'包装'),
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
		return 'single_sample';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '单件';
	}
}