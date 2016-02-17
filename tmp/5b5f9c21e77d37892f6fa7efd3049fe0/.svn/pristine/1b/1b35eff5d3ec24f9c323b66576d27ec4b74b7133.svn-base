<?php
namespace www;
use Lite\Component\Menu\MenuHelper;
use Lite\Core\Config;
use Lite\Core\View;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use Lite\Exception\Exception;
use function Lite\func\array_clear_null;
use function Lite\func\array_filter_subtree;
use function Lite\func\array_group;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2015/9/29
 * Time: 21:52
 */
class ViewBase extends View {
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
		} else {
			return parent::displayField($field, $model_instance);
		}
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

	/**
	 * add element class
	 * @param $tag
	 * @param array $attributes
	 * @param array $define
	 * @return string
	 */
	public static function buildElement($tag, $attributes=array(), $define=array()){
		$tag = strtolower($tag);

		//绑定 class
		$class = '';
		switch($tag){
			case 'input':
				if($attributes['type'] == 'text' ||
					$attributes['type'] == 'password' ||
					$attributes['type'] == 'number'){
					$class = 'txt';
				}
				if($define['type'] == 'date'){
					$class .= ' date-txt';
				}
				if($define['type'] == 'datetime'){
					$class .= ' datetime-txt';
				}
				if($define['type'] == 'time'){
					$class .= ' time-txt';
				}
				break;

			case 'textarea':
				$class = 'txt small-txt';
				break;
		}

		$attributes['class'] = $class;
		return parent::buildElement($tag, $attributes, $define);
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
		$html .= '<option>顶级</option>';
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