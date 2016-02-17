<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSampleProduceData

 * @property-read int $id 
 * @property int $sample_id 样品ID
 * @property double $mud_volume 泥浆体积(ML)
 * @property double $adobe_weight 土坯重量(KG)
 * @property int $color_glaze_id 色料釉料
 * @property int $flower_paper 花纸
 * @property string $shelf_no 货架展位
 * @method static TableSampleProduceData|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSampleProduceData::DB_READ)
 * @method static TableSampleProduceData|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSampleProduceData|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSampleProduceData|Query order($statement='')
 * @method static TableSampleProduceData|Query|bool create($data)
 * @method static TableSampleProduceData|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSampleProduceData|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSampleProduceData|Query|array|null one($as_array = false)
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
abstract class TableSampleProduceData extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => 'id',
				'type' => 'int',
				'length' => 10,
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
				'entity' => true
			),
			'mud_volume' => array(
				'alias' => '泥浆体积',
				'type' => 'double',
				'length' => 10,
				'precision' => 2,
				'min' => 0,
				'description' => 'ML',
				'default' => 0.00,
				'entity' => true
			),
			'adobe_weight' => array(
				'alias' => '土坯重量',
				'type' => 'double',
				'length' => 10,
				'precision' => 2,
				'min' => 0,
				'description' => 'KG',
				'default' => 0.00,
				'entity' => true
			),
			'color_glaze_id' => array(
				'alias' => '色料釉料',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'entity' => true
			),
			'flower_paper' => array(
				'alias' => '花纸',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'entity' => true
			),
			'shelf_no' => array(
				'alias' => '货架展位',
				'type' => 'string',
				'length' => 20,
				'default' => '',
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
		return 'sample_produce_data';
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
		return '样品生产数据';
	}
}