<?php
use Lite\Core\Config as Config;
use Lite\Core\Router;
use function Lite\func\dump;

$cdn_url = Config::get('app/cdn_url');
?>
<!DOCTYPE html>
<html class="<?php echo $_GET['ref'] == 'iframe' ? 'page-iframe' : '';?> SERVER-IDENTIFY-DEV">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php echo Config::get('app/site_name');?></title>
	<script>
		var FRONTEND_HOST = '<?php echo $cdn_url;?>';
		var UEDITOR_INT_URL = '<?php echo Router::getUrl('richeditor');?>';
		var UEDITOR_HOME_URL = '<?php echo Config::get('app/static_url');?>js/ueditor/';
		var UPLOAD_URL = '<?php echo Router::getUrl('upload/file', array('ref'=>'json'));?>';
		var UPLOAD_PROGRESS_URL = '<?php echo Router::getUrl('upload/progress', array('ref'=>'json'));?>';
	</script>
	<?php
	echo $this->getCss($cdn_url.'ywj/ui/backend/default.css');
	echo $this->getCss($cdn_url.'ywj/ui/backend/theme-sidelayout.css');
	echo $this->getCss($cdn_url.'ywj/ui/backend/font-awesome.css');
	echo $this->getCss('patch.css');
	echo $this->getJs($cdn_url.'seajs/sea.js');
	echo $this->getJs($cdn_url.'seajs/config.js');
	echo $this->getJs($cdn_url.'ywj/component/imagescale.js');
	echo $this->getJs('global.js');?>
	<script>
		seajs.use('ywj/auto');
	</script>
	<?php echo $PAGE_HEAD_HTML ?: '';?>
</head>
<body>
<div id="page">
	<div id="header">
		<h1 id="logo">
			<a href="<?php echo $this->getUrl();?>"><?php echo Config::get('app/site_name');?></a>
		</h1>
		<?php include 'shortcut.inc.php';?>
		<?php echo $this->getMainMenu();?>
	</div>
	<div id="container">
		<div id="resizer"></div>
		<style scoped="scoped">
			.page-iframe #resizer {display:none}
			#resizer {width:5px; height:100%; position:absolute; left:0; top:0; background-color:rgba(212, 212, 212, 0.53); cursor:col-resize;}
			#resizer:hover {background-color:rgba(104, 130, 156, 0.53)}
			<?php if($_COOKIE['resizer_hd_w']):?>
			#header {width:<?php echo $_COOKIE['resizer_hd_w'];?>px}
			<?php endif;?>
		</style>
		<script>
			seajs.use(['jquery', 'jquery/cookie'], function($){
				var $resizer = $('#resizer');
				var $body = $('body');
				var resizing = false;
				var start_region = null;
				var start_pos = null;
				$resizer.mousedown(function(e){
					resizing = true;
					start_pos = {
						left: e.clientX,
						top: e.clientY
					};
					start_region = {
						top: parseInt($resizer.css('top'), 10),
						left: parseInt($resizer.css('left'), 10),
						width: $resizer.width()
					};
				});

				$body.mousemove(function(e){
					if(resizing){
						var offset_left = e.clientX - start_pos.left;
						$resizer.css('left', (start_region.left + offset_left) + 'px');
						return false;
					}
				});

				$body.mouseup(function(){
					if(resizing){
						$('#header').css('width', $resizer.offset().left+'px');
						$resizer.css('left',0);
						$.cookie('resizer_hd_w', $resizer.offset().left);
					}
					resizing = false;
				});
			});
		</script>