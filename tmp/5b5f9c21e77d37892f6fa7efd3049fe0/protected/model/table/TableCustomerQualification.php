<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableCustomerQualification

 * @property-read int $id 
 * @property int $customer_id 
 * @property mixed $type 资质证件类型(营业执照,税务登记证,制作机构代码证,海关编码)
 * @property string $no 号码
 * @property string $append_file_url 附件地址
 * @method static TableCustomerQualification|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableCustomerQualification::DB_READ)
 * @method static TableCustomerQualification|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableCustomerQualification|Query find($statement = '', $var = null, ...$var2)
 * @method static TableCustomerQualification|Query order($statement='')
 * @method static TableCustomerQualification|Query|bool create($data)
 * @method static TableCustomerQualification|Query|array findOneByPk($val, $as_array = false)
 * @method static TableCustomerQualification|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableCustomerQualification|Query|array|null one($as_array = false)
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
abstract class TableCustomerQualification extends Model {
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
			'customer_id' => array(
				'alias' => 'customer_id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'type' => array(
				'alias' => '资质证件类型',
				'type' => 'enum',
				'length' => 1234,
				'default' => 1,
				'options' => array('1'=>'营业执照', '2'=>'税务登记证', '3'=>'制作机构代码证', '4'=>'海关编码'),
				'entity' => true
			),
			'no' => array(
				'alias' => '号码',
				'type' => 'string',
				'length' => 45,
				'entity' => true
			),
			'append_file_url' => array(
				'alias' => '附件地址',
				'type' => 'string',
				'length' => 45,
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
		return 'customer_qualification';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '客户资质';
	}
}