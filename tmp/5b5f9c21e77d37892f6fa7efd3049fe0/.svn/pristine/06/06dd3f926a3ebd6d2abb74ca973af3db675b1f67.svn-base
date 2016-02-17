<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSamplePackageMaterial

 * @property-read int $id 
 * @property string $paper_type 纸板
 * @property double $thickness 厚度
 * @property double $weight 重量
 * @property mixed $state 状态(禁用,启用)
 * @method static TableSamplePackageMaterial|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSamplePackageMaterial::DB_READ)
 * @method static TableSamplePackageMaterial|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSamplePackageMaterial|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSamplePackageMaterial|Query order($statement='')
 * @method static TableSamplePackageMaterial|Query|bool create($data)
 * @method static TableSamplePackageMaterial|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSamplePackageMaterial|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSamplePackageMaterial|Query|array|null one($as_array = false)
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
abstract class TableSamplePackageMaterial extends Model {
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
			'paper_type' => array(
				'alias' => '纸板',
				'type' => 'string',
				'length' => 40,
				'required' => true,
				'entity' => true
			),
			'thickness' => array(
				'alias' => '厚度',
				'type' => 'double',
				'length' => 102,
				'required' => true,
				'precision' => 2,
				'min' => 0,
				'default' => 0.00,
				'entity' => true
			),
			'weight' => array(
				'alias' => '重量',
				'type' => 'double',
				'length' => 102,
				'required' => true,
				'precision' => 2,
				'default' => 0.00,
				'entity' => true
			),
			'state' => array(
				'alias' => '状态',
				'type' => 'enum',
				'length' => 1,
				'required' => true,
				'default' => 0,
				'options' => array('0'=>'禁用', '1'=>'启用'),
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
		return 'sample_package_material';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '包装材料';
	}
}