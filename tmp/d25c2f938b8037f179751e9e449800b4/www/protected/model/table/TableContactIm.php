<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableContactIm

 * @property int $id 
 * @property string $contact_id 
 * @property string $im_type im类型　　QQ SKYPE MSN WECHAT
 * @property string $im_no Im 号码
 * @method static TableContactIm|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableContactIm::DB_READ)
 * @method static TableContactIm|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableContactIm|Query find($statement = '', $var = null, ...$var2)
 * @method static TableContactIm|Query order($statement='')
 * @method static TableContactIm|Query|bool create($data)
 * @method static TableContactIm|Query|array findOneByPk($val, $as_array = false)
 * @method static TableContactIm|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableContactIm|Query|array|null one($as_array = false)
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
abstract class TableContactIm extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => 'id',
				'type' => 'int',
				'length' => 11,
				'primary' => true,
				'required' => true,
				'entity' => true
			),
			'contact_id' => array(
				'alias' => 'contact_id',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'entity' => true
			),
			'im_type' => array(
				'alias' => 'im类型　　QQ SKYPE MSN WECHAT',
				'type' => 'string',
				'length' => 45,
				'entity' => true
			),
			'im_no' => array(
				'alias' => 'Im 号码',
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
		return 'contact_im';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '联系方式';
	}
}