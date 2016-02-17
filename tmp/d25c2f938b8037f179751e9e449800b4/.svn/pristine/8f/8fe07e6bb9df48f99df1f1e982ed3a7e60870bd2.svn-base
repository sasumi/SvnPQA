<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableStoreLog

 * @property-read int $id 
 * @property int $store_id 仓库
 * @property string $goods_no 货号
 * @property int $goods_num 数量
 * @property int $confirm_num 确认数量
 * @property mixed $operate_type 操作(进仓,出仓)
 * @property int $create_time 记录时间
 * @method static TableStoreLog|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableStoreLog::DB_READ)
 * @method static TableStoreLog|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableStoreLog|Query find($statement = '', $var = null, ...$var2)
 * @method static TableStoreLog|Query order($statement='')
 * @method static TableStoreLog|Query|bool create($data)
 * @method static TableStoreLog|Query|array findOneByPk($val, $as_array = false)
 * @method static TableStoreLog|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableStoreLog|Query|array|null one($as_array = false)
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
abstract class TableStoreLog extends Model {
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
			'store_id' => array(
				'alias' => '仓库',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'min' => 0,
				'entity' => true
			),
			'goods_no' => array(
				'alias' => '货号',
				'type' => 'string',
				'length' => 50,
				'required' => true,
				'entity' => true
			),
			'goods_num' => array(
				'alias' => '数量',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'min' => 0,
				'entity' => true
			),
			'confirm_num' => array(
				'alias' => '确认数量',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'entity' => true
			),
			'operate_type' => array(
				'alias' => '操作',
				'type' => 'enum',
				'length' => 12,
				'required' => true,
				'options' => array('1'=>'进仓', '2'=>'出仓'),
				'entity' => true
			),
			'create_time' => array(
				'alias' => '记录时间',
				'type' => 'timestamp',
				'length' => 0,
				'required' => true,
				'readonly' => true,
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
		return 'store_log';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '仓库记录';
	}
}