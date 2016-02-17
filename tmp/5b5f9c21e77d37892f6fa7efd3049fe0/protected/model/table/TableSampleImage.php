<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSampleImage

 * @property-read int $id 
 * @property int $sample_id 样品id
 * @property string $image_url 图片URL
 * @method static TableSampleImage|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSampleImage::DB_READ)
 * @method static TableSampleImage|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSampleImage|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSampleImage|Query order($statement='')
 * @method static TableSampleImage|Query|bool create($data)
 * @method static TableSampleImage|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSampleImage|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSampleImage|Query|array|null one($as_array = false)
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
abstract class TableSampleImage extends Model {
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
				'alias' => '样品id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'image_url' => array(
				'alias' => '图片URL',
				'type' => 'string',
				'length' => 200,
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
		return 'sample_image';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '样品图片';
	}
}