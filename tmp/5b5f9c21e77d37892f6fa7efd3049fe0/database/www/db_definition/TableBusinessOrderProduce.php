<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableBusinessOrderProduce

 * @property-read int $id 
 * @property string $deliver_date 发货日期
 * @property string $contract_no 合同号
 * @property mixed $state 状态(待接受,生产中,生产完成,已配送)
 * @method static TableBusinessOrderProduce|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableBusinessOrderProduce::DB_READ)
 * @method static TableBusinessOrderProduce|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableBusinessOrderProduce|Query find($statement = '', $var = null, ...$var2)
 * @method static TableBusinessOrderProduce|Query order($statement='')
 * @method static TableBusinessOrderProduce|Query|bool create($data)
 * @method static TableBusinessOrderProduce|Query|array findOneByPk($val, $as_array = false)
 * @method static TableBusinessOrderProduce|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableBusinessOrderProduce|Query|array|null one($as_array = false)
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
abstract class TableBusinessOrderProduce extends Model {
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
			'deliver_date' => array(
				'alias' => '发货日期',
				'type' => 'datetime',
				'length' => 0,
				'required' => true,
				'entity' => true
			),
			'contract_no' => array(
				'alias' => '合同号',
				'type' => 'string',
				'length' => 20,
				'required' => true,
				'entity' => true
			),
			'state' => array(
				'alias' => '状态',
				'type' => 'enum',
				'required' => true,
				'options' => array('1'=>'待接受', '2'=>'生产中', '3'=>'生产完成', '4'=>'已配送'),
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
		return 'business_order_produce';
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
		return 'business_order_produce';
	}
}