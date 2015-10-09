<?php
namespace SvnPQA;
use Lite\Component\Menu\MenuHelper;
use Lite\Core\Config;
use Lite\Core\View;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2015/9/29
 * Time: 21:52
 */
class ViewBase extends View {
	public static function getMainMenu(){
		$data = Config::get('nav');
		$mnu = new MenuHelper($data, 'SvnPQA\Model\Access::checkUriAccess');
		return $mnu->getMainMenu();
	}

	public static function getSideMenu(){
		$data = Config::get('nav');
		$mnu = new MenuHelper($data, 'www\Model\Access::checkUriAccess');
		return $mnu->getSideMenu();
	}
}