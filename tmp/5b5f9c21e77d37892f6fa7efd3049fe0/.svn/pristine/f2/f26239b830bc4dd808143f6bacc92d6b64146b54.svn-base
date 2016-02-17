<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableFlowerPaper

 * @property-read int $id ID
 * @property int $flower_paper_type 花纸类型
 * @property string $paper_no 花纸号
 * @property string $image_url 图片
 * @property int $color_num 颜色数
 * @property string $supplier_id 供应商id
 * @property string $supplier_desc 供应商描述
 * @property string $desc 备注说明
 * @method static TableFlowerPaper|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableFlowerPaper::DB_READ)
 * @method static TableFlowerPaper|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableFlowerPaper|Query find($statement = '', $var = null, ...$var2)
 * @method static TableFlowerPaper|Query order($statement='')
 * @method static TableFlowerPaper|Query|bool create($data)
 * @method static TableFlowerPaper|Query|array findOneByPk($val, $as_array = false)
 * @method static TableFlowerPaper|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableFlowerPaper|Query|array|null one($as_array = false)
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
abstract class TableFlowerPaper extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => 'ID',
				'type' => 'int',
				'length' => 11,
				'primary' => true,
				'required' => true,
				'readonly' => true,
				'entity' => true
			),
			'flower_paper_type' => array(
				'alias' => '花纸类型',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'min' => 0,
				'entity' => true
			),
			'paper_no' => array(
				'alias' => '花纸号',
				'type' => 'string',
				'length' => 45,
				'entity' => true
			),
			'image_url' => array(
				'alias' => '图片',
				'type' => 'string',
				'length' => 100,
				'entity' => true
			),
			'color_num' => array(
				'alias' => '颜色数',
				'type' => 'int',
				'length' => 11,
				'entity' => true
			),
			'supplier_id' => array(
				'alias' => '供应商id',
				'type' => 'string',
				'length' => 45,
				'entity' => true
			),
			'supplier_desc' => array(
				'alias' => '供应商描述',
				'type' => 'string',
				'length' => 200,
				'entity' => true
			),
			'desc' => array(
				'alias' => '备注说明',
				'type' => 'string',
				'length' => 200,
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
		return 'flower_paper';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '花纸';
	}
}