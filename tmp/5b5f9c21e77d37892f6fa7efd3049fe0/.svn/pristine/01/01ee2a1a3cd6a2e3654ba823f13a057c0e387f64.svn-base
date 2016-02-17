<?php
namespace log\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableCgi

 * @property-read int $id 
 * @property string $request_url cgi请求url
 * @property string $params 请求参数
 * @property string $client_ip IP
 * @property string $locate_file 发起文件路径
 * @property int $locate_line 所在行数
 * @property int $run_time 运行时间(毫秒)
 * @property int $create_time 记录创建时间
 * @method static TableCgi|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableCgi::DB_READ)
 * @method static TableCgi|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableCgi|Query find($statement = '', $var = null, ...$var2)
 * @method static TableCgi|Query order($statement='')
 * @method static TableCgi|Query|bool create($data)
 * @method static TableCgi|Query|array findOneByPk($val, $as_array = false)
 * @method static TableCgi|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableCgi|Query|array|null one($as_array = false)
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
abstract class TableCgi extends Model {
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
			'request_url' => array(
				'alias' => 'cgi请求url',
				'type' => 'string',
				'length' => 255,
				'required' => true,
				'entity' => true
			),
			'params' => array(
				'alias' => '请求参数',
				'type' => 'string',
				'length' => 500,
				'default' => '',
				'entity' => true
			),
			'client_ip' => array(
				'alias' => 'IP',
				'type' => 'string',
				'length' => 20,
				'default' => null,
				'entity' => true
			),
			'locate_file' => array(
				'alias' => '发起文件路径',
				'type' => 'string',
				'length' => 200,
				'default' => '',
				'entity' => true
			),
			'locate_line' => array(
				'alias' => '所在行数',
				'type' => 'int',
				'length' => 11,
				'default' => null,
				'entity' => true
			),
			'run_time' => array(
				'alias' => '运行时间',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'description' => '毫秒',
				'entity' => true
			),
			'create_time' => array(
				'alias' => '记录创建时间',
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
		return 'cgi';
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
		return 'cgi统计';
	}
}