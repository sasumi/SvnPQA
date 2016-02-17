<?php
namespace log\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableSmsLog

 * @property-read int $id 
 * @property int $send_time 发送时间
 * @property int $send_state 发送结果
 * @property string $mobile 手机号码
 * @property string $content 短信内容
 * @method static TableSmsLog|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableSmsLog::DB_READ)
 * @method static TableSmsLog|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableSmsLog|Query find($statement = '', $var = null, ...$var2)
 * @method static TableSmsLog|Query order($statement='')
 * @method static TableSmsLog|Query|bool create($data)
 * @method static TableSmsLog|Query|array findOneByPk($val, $as_array = false)
 * @method static TableSmsLog|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableSmsLog|Query|array|null one($as_array = false)
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
abstract class TableSmsLog extends Model {
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
			'send_time' => array(
				'alias' => '发送时间',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'send_state' => array(
				'alias' => '发送结果',
				'type' => 'int',
				'length' => 1,
				'required' => true,
				'entity' => true
			),
			'mobile' => array(
				'alias' => '手机号码',
				'type' => 'string',
				'length' => 20,
				'required' => true,
				'entity' => true
			),
			'content' => array(
				'alias' => '短信内容',
				'type' => 'string',
				'length' => 500,
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
		return 'sms_log';
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
		return '短信发送记录';
	}
}