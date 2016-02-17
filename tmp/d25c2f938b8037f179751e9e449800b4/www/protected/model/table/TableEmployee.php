<?php
namespace www\model\table;

/**
 * User: Lite Scaffold
 */
use Lite\DB\Model as Model;
use Lite\DB\Query as Query;

/**
 * Class TableEmployee

 * @property-read int $id 员工(开发人员)ID
 * @property string $employee_no 工号
 * @property string $name 姓名
 * @property mixed $pay_type 工资形式(固定,计时,计件)
 * @property int $work_process 负责工序
 * @property string $id_card_number 身份证号
 * @property string $birthday 生日
 * @property mixed $address 地址
 * @property string $tel 电话
 * @property string $urgent_tel 紧急电话
 * @property string $entry_time 入职时间
 * @property string $leave_time 离职时间
 * @property mixed $state 是否在职(离职,在职)
 * @method static TableEmployee|Query meta()
 * @method boolean onBeforeSave()
 * @method boolean onBeforeUpdate()
 * @method boolean onBeforeInsert()
 * @method static string getDbTablePrefix($type = TableEmployee::DB_READ)
 * @method static TableEmployee|Query setQuery($query = null, $db_config = array())
 * @method Query getQuery()
 * @method static \Exception transaction($handler)
 * @method \PDOStatement execute()
 * @method static TableEmployee|Query find($statement = '', $var = null, ...$var2)
 * @method static TableEmployee|Query order($statement='')
 * @method static TableEmployee|Query|bool create($data)
 * @method static TableEmployee|Query|array findOneByPk($val, $as_array = false)
 * @method static TableEmployee|Query|array findByPks(array $pks, $as_array = false)
 * @method static bool delByPk($val)
 * @method static bool updateByPk($val, $data)
 * @method static bool updateWhere(array $data, $limit = 1, $statement, ...$var2)
 * @method static bool deleteWhere($limit = 1, $statement, ...$var2)
 * @method array all($as_array = false)
 * @method TableEmployee|Query|array|null one($as_array = false)
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
abstract class TableEmployee extends Model {
	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'id' => array(
				'alias' => '员工',
				'type' => 'int',
				'length' => 11,
				'primary' => true,
				'required' => true,
				'readonly' => true,
				'min' => 0,
				'entity' => true
			),
			'employee_no' => array(
				'alias' => '工号',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'default' => '',
				'entity' => true
			),
			'name' => array(
				'alias' => '姓名',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'entity' => true
			),
			'pay_type' => array(
				'alias' => '工资形式',
				'type' => 'enum',
				'length' => 123,
				'required' => true,
				'default' => 1,
				'options' => array('1'=>'固定', '2'=>'计时', '3'=>'计件'),
				'entity' => true
			),
			'work_process' => array(
				'alias' => '负责工序',
				'type' => 'int',
				'length' => 10,
				'required' => true,
				'entity' => true
			),
			'id_card_number' => array(
				'alias' => '身份证号',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'default' => '',
				'entity' => true
			),
			'birthday' => array(
				'alias' => '生日',
				'type' => 'date',
				'length' => 0,
				'required' => true,
				'default' => '',
				'entity' => true
			),
			'address' => array(
				'alias' => '地址',
				'type' => 'text',
				'length' => 0,
				'required' => true,
				'entity' => true
			),
			'tel' => array(
				'alias' => '电话',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'default' => '',
				'entity' => true
			),
			'urgent_tel' => array(
				'alias' => '紧急电话',
				'type' => 'string',
				'length' => 45,
				'required' => true,
				'default' => '',
				'entity' => true
			),
			'entry_time' => array(
				'alias' => '入职时间',
				'type' => 'datetime',
				'length' => 0,
				'required' => true,
				'default' => '',
				'entity' => true
			),
			'leave_time' => array(
				'alias' => '离职时间',
				'type' => 'datetime',
				'length' => 0,
				'required' => true,
				'default' => '',
				'entity' => true
			),
			'state' => array(
				'alias' => '是否在职',
				'type' => 'enum',
				'length' => 1,
				'required' => true,
				'default' => 0,
				'options' => array('0'=>'离职', '1'=>'在职'),
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
		return 'employee';
	}

	/**
	* 获取模块名称
	* @return string
	*/
	public function getModelDesc(){
		return '员工';
	}
}