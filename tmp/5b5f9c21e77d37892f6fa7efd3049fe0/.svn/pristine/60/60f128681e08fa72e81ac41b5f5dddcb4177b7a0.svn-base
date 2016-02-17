<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSample

 * @property-read int $id 
 * @property string $sample_no 货号
 * @property mixed $sample_type 样品类型(单件,套件)
 * @property mixed $category 分类(杯,碗,盘,罐)
 * @property string $chinese_name 中文名称
 * @property string $english_name 英文名称
 * @property mixed $key_words 关键字
 * @property mixed $material 材质(轻质,重质)
 * @property mixed $tags 标签
 * @method static TableSample|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSample::DB_READ)
 * @method static TableSample|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSample|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSample|Query order($statement='')
 * @method static TableSample|Query|bool create($data)
 * @method static TableSample|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSample|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSample|Query|array|null one($as_array = false)
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
abstract class TableSample extends Model {
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
			'sample_no' => array(
				'alias' => '货号',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'entity' => true
			),
			'sample_type' => array(
				'alias' => '样品类型',
				'type' => 'enum',
				'length' => 12,
				'required' => true,
				'options' => array('1'=>'单件', '2'=>'套件'),
				'entity' => true
			),
			'category' => array(
				'alias' => '分类',
				'type' => 'enum',
				'length' => 1234,
				'required' => true,
				'options' => array('1'=>'杯', '2'=>'碗', '3'=>'盘', '4'=>'罐'),
				'entity' => true
			),
			'chinese_name' => array(
				'alias' => '中文名称',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'entity' => true
			),
			'english_name' => array(
				'alias' => '英文名称',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'default' => '',
				'entity' => true
			),
			'key_words' => array(
				'alias' => '关键字',
				'type' => 'text',
				'length' => 0,
				'entity' => true
			),
			'material' => array(
				'alias' => '材质',
				'type' => 'enum',
				'length' => 12,
				'required' => true,
				'options' => array('1'=>'轻质', '2'=>'重质'),
				'entity' => true
			),
			'tags' => array(
				'alias' => '标签',
				'type' => 'text',
				'length' => 0,
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
		return 'sample';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '样品';
	}
}