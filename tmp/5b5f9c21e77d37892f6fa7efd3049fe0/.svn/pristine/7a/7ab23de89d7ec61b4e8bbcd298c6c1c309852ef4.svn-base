<?php
namespace log\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TablePv

 * @property-read int $id 
 * @property string $uid 登录客户身份ID标识
 * @property string $ua UA信息
 * @property string $catalog 统计栏目
 * @property string $sub_catalog 子统计栏目
 * @property string $url 页面路径URL
 * @property int $add_time 上报时间
 * @method static TablePv|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TablePv::DB_READ)
 * @method static TablePv|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TablePv|Query find($statement = '', $var = null, ...$var2)
 * @method static TablePv|Query order($statement='')
 * @method static TablePv|Query|bool create($data)
 * @method static TablePv|Query|array findOneByPk($val, $as_array = false)
 * @method static TablePv|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TablePv|Query|array|null one($as_array = false)
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
abstract class TablePv extends Model {
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
			'uid' => array(
				'alias' => '登录客户身份ID标识',
				'type' => 'string',
				'length' => 32,
				'default' => null,
				'entity' => true
			),
			'ua' => array(
				'alias' => 'UA信息',
				'type' => 'string',
				'length' => 500,
				'default' => null,
				'entity' => true
			),
			'catalog' => array(
				'alias' => '统计栏目',
				'type' => 'string',
				'length' => 50,
				'required' => true,
				'entity' => true
			),
			'sub_catalog' => array(
				'alias' => '子统计栏目',
				'type' => 'string',
				'length' => 200,
				'default' => null,
				'entity' => true
			),
			'url' => array(
				'alias' => '页面路径URL',
				'type' => 'string',
				'length' => 100,
				'default' => null,
				'entity' => true
			),
			'add_time' => array(
				'alias' => '上报时间',
				'type' => 'int',
				'length' => 11,
				'required' => true,
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
		return 'pv';
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
		return 'pv统计表';
	}
}