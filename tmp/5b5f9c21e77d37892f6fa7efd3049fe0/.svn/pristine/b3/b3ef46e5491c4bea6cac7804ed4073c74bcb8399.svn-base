<?php
namespace www;
use Lite\Component\Menu\MenuHelper;
use Lite\Core\Config;
use Lite\Core\View;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use Lite\Exception\Exception;
use function Lite\func\array_clear_empty;
use function Lite\func\array_clear_null;
use function Lite\func\array_filter_subtree;
use function Lite\func\array_group;
use function Lite\func\array_trim;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2015/9/29
 * Time: 21:52
 */
class ViewBase extends View {
	const CLASS_DRAFT = 'state-flag state-flag-draft';
	const CLASS_NORMAL = 'state-flag state-flag-normal';
	const CLASS_DONE = 'state-flag state-flag-done';
	const CLASS_WARN = 'state-flag state-flag-warn';
	const CLASS_DISABLED = 'state-flag state-flag-disabled';

	/**
	 * add access
	 * @param string $uri
	 * @param array $param
	 * @param null $router_mode
	 * @return string
	 */
	public static function getUrl($uri='', $param=array(), $router_mode=null){
		$url = parent::getUrl($uri, $param, $router_mode);
		$flag = Auth::getUrlAccessFlag($uri, $param);
		if($flag){
			$url .= '#'.$flag;
		}
		return $url;
	}

	public function getMainMenu(){
		$data = Config::get('nav');
		$mnu = new MenuHelper($data, 'www\Auth::checkUriAccess');
		return $mnu->getMainMenu();
	}

	public function getSideMenu(){
		$data = Config::get('nav');
		$mnu = new MenuHelper($data, 'www\Auth::checkUriAccess');
		return $mnu->getSideMenu();
	}

	public static function getImgUrl($file_name){
		return parent::getImgUrl($file_name ?: Config::get('app/default_image'));
	}

	/**
	 * 处理上传图片和上传文件
	 * @param string $field
	 * @param \Lite\DB\Model $model_instance
	 * @return string
	 */
	public static function displayField($field, Model $model_instance){
		$value = $model_instance->$field;
		$define = $model_instance->getPropertiesDefine($field);
		if($define['rel'] == 'upload-image'){
			$value = $value ?: Config::get('app/default_image'); //todo merge params
			return '<span class="image-thumb">'.self::getImg(Config::get('upload/url').$value).'</span>';
		}
		else if($define['rel'] == 'upload-file'){
			$value = $value ?: Config::get('app/default_image');
			return '<a href="'.Config::get('upload/url').$value.'" target="_blank" title="'.h($value).'">下载</a>';
		}
		else if($define['rel'] == 'keywords' || $define['rel'] == 'tags'){
			$t = explode(',', $value);
			$t = array_clear_empty(array_trim($t));
			if($t){
				return '<ul class="tags"><li>'.join('</li><li>',$t).'</li></ul>';
			}
			return '';
		} else {
			return parent::displayField($field, $model_instance);
		}
	}

	/**
	 * display color state
	 * @param Model $model_instance
	 * @param null $field
	 * @param array $class_map
	 * @return string
	 * @throws Exception
	 */
	public static function displayColorState(Model $model_instance, $field=null, $class_map=array()){
		$class_map = $class_map ?: array(self::CLASS_DRAFT, self::CLASS_NORMAL, self::CLASS_DONE, self::CLASS_DISABLED);
		if(!$field && $model_instance instanceof ModelInterface){
			$field  = $model_instance->getStateKey();
		}
		if(!$field){
			throw new Exception('displayColorState() need field name specified');
		}

		$def = $model_instance->getPropertiesDefine($field);
		$options = is_callable($def['options']) ? call_user_func($def['options'], $model_instance) : $def['options'];
		$val = $model_instance->$field;
		foreach($options as $k=>$name){
			if($k == $val){
				return '<span class="'.$class_map[$k].'">'.$name.'</span>';
			}
		}
		return self::displayField($field, $model_instance);
	}

	/**
	 * display $model_instance
	 * @param \Lite\CRUD\ModelInterface|Model $model_instance
	 * @return string
	 * @throws \Lite\Exception\Exception
	 */
	public static function displayStateSwitcher(ModelInterface $model_instance){
		$state_key = $model_instance->getStateKey();
		if(!$state_key){
			throw new Exception('non state key found');
		}
		$define = $model_instance->getPropertiesDefine($state_key);
		$t = self::displayField($state_key, $model_instance);
		$pk = $model_instance->getPrimaryKey();

		$html = '<dl class="drop-list drop-list-left">'.
				'<dt><span>'.$t.'</span></dt><dd>';

		foreach($define['options'] as $k=>$n){
			if($n != $t){
				$html .= '<a href="'.self::getUrl(self::getController().'/state', array($pk=>$model_instance->$pk, 'state'=>$k)).'" rel="async">'.h($n).'</a>';
			}
		}
		$html .= '</dd></dl>';
		return $html;
	}

	/**
	 * 获取状态变更按钮
	 * 如果是最后一个状态，则不扭转
	 * @param \Lite\DB\Model $model 数据模型
	 * @param null $field 状态字段名
	 * @param array $state_options 状态扭转选项（缺省读取options）
	 * @return string
	 * @throws \Lite\Exception\Exception
	 */
	public static function getNextStateBtn(Model $model, $field=null, $state_options=array()){
		if(!$field && $model instanceof ModelInterface){
			$field = $model->getStateKey();
		}
		if(!$field){
			throw new Exception('next state field not found');
		}
		$options = $state_options ?: $model->getPropertiesDefine($field)['options'];
		$val = $model->$field;
		$pk = $model->getPrimaryKey();

		$matched = false;
		foreach($options as $k=>$opt_name){
			if($val == $k){
				$matched = true;
			}
			else if($matched){
				return '<a href="'.self::getUrl(self::getController().'/state', array($field=>$k, $pk=>$model->$pk)).'" rel="async" class="state-changer btn">'.$opt_name.'</a>';
			}
		}
		return '';
	}

	/**
	 * 显示集合
	 * @param $sets
	 * @param $options
	 * @param \Lite\DB\Model $model_instance
	 * @return string
	 */
	public static function displaySet($sets, $options, Model $model_instance){
		$vs = explode(',',$sets);
		$t = array();
		foreach($vs as $v){
			$t[] = $options[$v];
		}
		$html = '<ul class="tags"><li>'.join('</li><li>',$t).'</li></ul>';
		return $html;
	}

	public static function renderDateRangeElement($value_range, $field, $define, $model_instance=null, $extend_attr=array()){
		return '<span class="date-range-input">'.
			parent::renderDateRangeElement($value_range, $field, $define, $model_instance, $extend_attr).
		'</span>';
	}

	/**
	 * add element class
	 * @param $tag
	 * @param array $attributes
	 * @param array $define
	 * @return string
	 */
	public static function buildElement($tag, $attributes=array(), $define=array()){
		if($define['rel'] == 'keywords' || $define['rel'] == 'tags'){
			return self::buildTagsInput($tag, $attributes, $define);
		}

		$tag = strtolower($tag);
		$class = $attributes['class'];
		switch($tag){
			case 'input':
				if($attributes['type'] == 'text' ||
					$attributes['type'] == 'password' ||
					$attributes['type'] == 'number'){
					$class .= ' txt';
				}
				if($define['type'] == 'date'){
					$class .= ' date-txt';
				}
				if($define['type'] == 'datetime' || $define['type'] == 'timestamp'){
					$class .= ' datetime-txt';
				}
				if($define['type'] == 'time'){
					$class .= ' time-txt';
				}
				break;

			case 'textarea':
				$class = ' txt';
				if($define['type'] == 'simple_rich_text'){
					$attributes['rel'] = 'simple-rich';
					$class .= ' medium-txt';
				}
				else if($define['type'] == 'rich_text'){
					$attributes['rel'] = 'rich';
					$class .= ' large-txt';
				}
				else {
					$class .= ' small-txt';
				}
				break;
		}

		if($class){
			$attributes['class'] = $class;
		}
		return parent::buildElement($tag, $attributes, $define);
	}

	private static function buildTagsInput($tag, $attributes=array(), $define=array()){
		$values = array_clear_empty(array_trim(explode(',', $attributes['text'])));
		$name = $attributes['name'];

		$html = '';
		$html .= '<div class="tags-input">';
		$html .= '<input type="hidden" name="'.$name.'" value="'.h($attributes['text']).'"/>';
		if($values){
			$del = '<span class="del-tag" title="删除">x</span><span>';
			$html .= '<ul class="tags"><li>'.$del.join('</span></li><li>'.$del,$values).'</span></li></ul>';
		} else {
			$html .= '<ul class="tags"></ul>';
		}
		$html .= '<input type="text" value="" placeholder="回车输入" class="txt"/>';
		$html .= '</div>';
		return $html;
	}

	/**
	 * @param $data
	 * @param $current
	 * @param array $opt
	 * @return string
	 */
	public static function generateParentTreeSelector($data, $current, $opt=array()){
		$opt = array_merge(array(
			'return_as_tree' => false,             //以目录树返回，还是以平铺数组形式返回
			'level_key' => 'tree_level',          //返回数据中是否追加等级信息,如果选项为空, 则不追加等级信息
			'id_key' => 'id',                     //主键键名
			'name_key' => 'name', //ext
			'parent_id_key' => 'parent_id',       //父级键名
			'children_key' => 'children'          //返回子集key(如果是平铺方式返回,该选项无效
		), $opt);

		$data = array_filter_subtree(0, $data, $opt);
		/** @var array $data */
		$data = array_group($data, $opt['id_key'], true);

		$match = false;
		foreach($data as $k=>$item){
			if($item[$opt['id_key']] == $current[$opt['id_key']]){
				$match = true;
				$data[$k]['__current__'] = true;
			} else if($match && $item[$opt['level_key']] <= $current[$opt['level_key']]){
				$match = false;
			} else if($match && $item[$opt['level_key']] > $current[$opt['level_key']]){
				$data[$k]['__belongs__'] = true;
			} else {
				$match = false;
			}
			$data[$k]['tree_name'] = str_repeat('&nbsp;', $item[$opt['level_key']]*5).'|-'.$item[$opt['name_key']];
		}

		$html = '<select size="1" name="'.$opt['parent_id_key'].'">';
		$html .= '<option value="0">顶级</option>';
		foreach($data as $item){
			$html .= '<option value="'.$item[$opt['id_key']].'" '.($item[$opt['id_key']] == $current[$opt['parent_id_key']] ? 'selected="selected"' : '').
				($item['__belongs__'] || $item['__current__'] ? ' disabled="disabled"' : '').
				'>'.$item['tree_name'].'</option>';
		}
		$html .= '</select>';
		return $html;
	}

	public static function buildUploadImage($src){
		return Config::get('upload/url').$src;
	}
}