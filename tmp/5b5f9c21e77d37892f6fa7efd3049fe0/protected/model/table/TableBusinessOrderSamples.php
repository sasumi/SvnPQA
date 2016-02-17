<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableBusinessOrderSamples

 * @property-read int $id 
 * @property int $business_order_id 订单
 * @property int $sample_id 样品
 * @property int $sample_package_id 样品包装
 * @property float $sample_num 样品数量
 * @property float $sample_unit_price 样品单价(元)
 * @method static TableBusinessOrderSamples|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableBusinessOrderSamples::DB_READ)
 * @method static TableBusinessOrderSamples|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableBusinessOrderSamples|Query find($statement = '', $var = null, ...$var2)
 * @method static TableBusinessOrderSamples|Query order($statement='')
 * @method static TableBusinessOrderSamples|Query|bool create($data)
 * @method static TableBusinessOrderSamples|Query|array findOneByPk($val, $as_array = false)
 * @method static TableBusinessOrderSamples|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableBusinessOrderSamples|Query|array|null one($as_array = false)
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
abstract class TableBusinessOrderSamples extends Model {
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
			'business_order_id' => array(
				'alias' => '订单',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'sample_id' => array(
				'alias' => '样品',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'sample_package_id' => array(
				'alias' => '样品包装',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'sample_num' => array(
				'alias' => '样品数量',
				'type' => 'float',
				'length' => 102,
				'required' => true,
				'precision' => 2,
				'default' => 0.00,
				'entity' => true
			),
			'sample_unit_price' => array(
				'alias' => '样品单价',
				'type' => 'float',
				'length' => 102,
				'required' => true,
				'precision' => 2,
				'description' => '元',
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
		return 'business_order_samples';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '订单商品';
	}
}