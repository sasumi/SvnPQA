<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableBusinessOrderPriceDescHis

 * @property-read int $id 
 * @property string $business_order_id 订单ｉｄ
 * @property string $product_price_desc 商品价格备注
 * @property string $create_time 创建时间
 * @method static TableBusinessOrderPriceDescHis|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableBusinessOrderPriceDescHis::DB_READ)
 * @method static TableBusinessOrderPriceDescHis|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableBusinessOrderPriceDescHis|Query find($statement = '', $var = null, ...$var2)
 * @method static TableBusinessOrderPriceDescHis|Query order($statement='')
 * @method static TableBusinessOrderPriceDescHis|Query|bool create($data)
 * @method static TableBusinessOrderPriceDescHis|Query|array findOneByPk($val, $as_array = false)
 * @method static TableBusinessOrderPriceDescHis|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableBusinessOrderPriceDescHis|Query|array|null one($as_array = false)
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
abstract class TableBusinessOrderPriceDescHis extends Model {
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
				'alias' => '订单ｉｄ',
				'type' => 'string',
				'length' => 45,
				'entity' => true
			),
			'product_price_desc' => array(
				'alias' => '商品价格备注',
				'type' => 'string',
				'length' => 300,
				'entity' => true
			),
			'create_time' => array(
				'alias' => '创建时间',
				'type' => 'datetime',
				'length' => 1,
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
		return 'business_order_price_desc_his';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '订单商品价格历史记录';
	}
}