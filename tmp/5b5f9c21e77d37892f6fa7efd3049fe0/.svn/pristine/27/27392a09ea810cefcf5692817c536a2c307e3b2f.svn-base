<?php
namespace log\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSpiderLog

 * @property-read int $id 
 * @property string $ua 
 * @property string $ip 
 * @property string $url 
 * @property int $create_time 爬取时间
 * @method static TableSpiderLog|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSpiderLog::DB_READ)
 * @method static TableSpiderLog|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSpiderLog|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSpiderLog|Query order($statement='')
 * @method static TableSpiderLog|Query|bool create($data)
 * @method static TableSpiderLog|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSpiderLog|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSpiderLog|Query|array|null one($as_array = false)
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
abstract class TableSpiderLog extends Model {
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
			'ua' => array(
				'alias' => 'ua',
				'type' => 'string',
				'length' => 200,
				'default' => '',
				'entity' => true
			),
			'ip' => array(
				'alias' => 'ip',
				'type' => 'string',
				'length' => 15,
				'required' => true,
				'entity' => true
			),
			'url' => array(
				'alias' => 'url',
				'type' => 'string',
				'length' => 100,
				'default' => '',
				'entity' => true
			),
			'create_time' => array(
				'alias' => '爬取时间',
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
		return 'spider_log';
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
		return '爬虫log';
	}
}