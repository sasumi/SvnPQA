<?php
namespace log\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableLog

 * @property-read int $id 
 * @property string $level ´íÎó¼¶±ð
 * @property string $tag ´íÎó±êÇ©
 * @property string $file ÎÄ¼þ
 * @property int $line ³ö´íÎÄ¼þÐÐÊý
 * @property string $content ÄÚÈÝ
 * @property int $state ×´Ì¬£º0£ºÎ´È·ÈÏ£¬1£ºÒÑÈ·ÈÏ£¬2£ºÒÑ´¦Àí
 * @property string $datetime Ê±¼ä
 * @method static TableLog|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableLog::DB_READ)
 * @method static TableLog|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableLog|Query find($statement = '', $var = null, ...$var2)
 * @method static TableLog|Query order($statement='')
 * @method static TableLog|Query|bool create($data)
 * @method static TableLog|Query|array findOneByPk($val, $as_array = false)
 * @method static TableLog|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableLog|Query|array|null one($as_array = false)
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
abstract class TableLog extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => 'id',
				'type' => 'int',
				'length' => 11,
				'primary' => true,
				'required' => true,
				'readonly' => true,
				'min' => 0,
				'entity' => true
			),
			'level' => array(
				'alias' => '´íÎó¼¶±ð',
				'type' => 'string',
				'length' => 1,
				'default' => 'v',
				'entity' => true
			),
			'tag' => array(
				'alias' => '´íÎó±êÇ©',
				'type' => 'string',
				'length' => 500,
				'default' => null,
				'entity' => true
			),
			'file' => array(
				'alias' => 'ÎÄ¼þ',
				'type' => 'string',
				'length' => 200,
				'default' => null,
				'entity' => true
			),
			'line' => array(
				'alias' => '³ö´íÎÄ¼þÐÐÊý',
				'type' => 'int',
				'length' => 5,
				'min' => 0,
				'default' => null,
				'entity' => true
			),
			'content' => array(
				'alias' => 'ÄÚÈÝ',
				'type' => 'string',
				'length' => 255,
				'default' => null,
				'entity' => true
			),
			'state' => array(
				'alias' => '×´Ì¬£º0£ºÎ´È·ÈÏ£¬1£ºÒÑÈ·ÈÏ£¬2£ºÒÑ´¦Àí',
				'type' => 'int',
				'length' => 2,
				'default' => 0,
				'entity' => true
			),
			'datetime' => array(
				'alias' => 'Ê±¼ä',
				'type' => 'datetime',
				'length' => 0,
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
		return 'log';
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
		return '记录表';
	}
}