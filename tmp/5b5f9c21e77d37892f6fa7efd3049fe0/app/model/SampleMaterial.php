<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableSampleMaterial;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:02
 */
class SampleMaterial extends TableSampleMaterial implements ModelInterface {
	const STATE_DISABLED = 0;
	const STATE_ENABLED = 1;

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
		return 'state';
	}
}