<?php
use Lite\Core\Config as Config;
use SvnPQA\ViewBase;

$cdn_url = Config::get('app/cdn_url');
?>
<!DOCTYPE html>
<html class="<?php echo $_GET['ref'] == 'iframe' ? 'page-iframe' : '';?> SERVER-IDENTIFY-DEV">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php echo Config::get('app/site_name');?></title>
	<script>
		var FRONTEND_HOST = '<?php echo $cdn_url;?>';
	</script>
	<?php
	echo $this->getCss($cdn_url.'ywj/ui/backend/default.css');
	echo $this->getCss($cdn_url.'ywj/ui/backend/font-awesome.css');
	echo $this->getJs($cdn_url.'seajs/sea.js');
	echo $this->getJs($cdn_url.'seajs/config.js');
	echo $this->getJs($cdn_url.'ywj/component/imagescale.js');
	echo $this->getJs('global.js');
	echo $this->getCss('common.css');
	?>
	<script>
		seajs.use('ywj/auto');
	</script>
    <?php echo $PAGE_HTML_HEAD ?: '';?>
</head>
<body>
<div id="page">
	<div id="header">
		<h1 id="logo">
			<a href="<?php echo $this->getUrl();?>"><?php echo Config::get('app/site_name');?></a>
		</h1>
		<?php include 'shortcut.inc.php';?>
		<?php echo ViewBase::getMainMenu();?>
	</div>
	<div id="container">