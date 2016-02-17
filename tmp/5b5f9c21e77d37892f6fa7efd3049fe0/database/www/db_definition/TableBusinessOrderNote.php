<?php
namespace www\db_definition;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableBusinessOrderNote

 * @property-read int $id 主键
 * @property int $business_order_id 订单id
 * @property mixed $note_content 便签内容
 * @property int $update_time 更新时间
 * @property int $create_time 创建时间
 * @method static TableBusinessOrderNote|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableBusinessOrderNote::DB_READ)
 * @method static TableBusinessOrderNote|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableBusinessOrderNote|Query find($statement = '', $var = null, ...$var2)
 * @method static TableBusinessOrderNote|Query order($statement='')
 * @method static TableBusinessOrderNote|Query|bool create($data)
 * @method static TableBusinessOrderNote|Query|array findOneByPk($val, $as_array = false)
 * @method static TableBusinessOrderNote|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableBusinessOrderNote|Query|array|null one($as_array = false)
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
abstract class TableBusinessOrderNote extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => '主键',
				'type' => 'int',
				'length' => 11,
				'primary' => true,
				'required' => true,
				'readonly' => true,
				'entity' => true
			),
			'business_order_id' => array(
				'alias' => '订单id',
				'type' => 'int',
				'length' => 11,
				'required' => true,
				'entity' => true
			),
			'note_content' => array(
				'alias' => '便签内容',
				'type' => 'text',
				'length' => 0,
				'required' => true,
				'entity' => true
			),
			'update_time' => array(
				'alias' => '更新时间',
				'type' => 'timestamp',
				'length' => 0,
				'readonly' => true,
				'default' => time(),
				'entity' => true
			),
			'create_time' => array(
				'alias' => '创建时间',
				'type' => 'timestamp',
				'length' => 0,
				'readonly' => true,
				'default' => time(),
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
		return 'business_order_note';
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
		return '订单便签';
	}
}