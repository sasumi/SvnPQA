<?php
use Lite\Core\Router;

include $this->resolveTemplate('inc/header.inc.php');
$navs = array(
	'CustomerSource' => '客户来源',
	'CustomerType' => '客户类型',
	'PayType' => '支付类型',
);

?>
<div id="col-aside"><?php echo $this->getSideMenu();?></div>
<div id="col-main">
	<ul class="frm-tab">
		<?php foreach($navs as $k=>$n):?>
		<li id="tab-<?php echo $k;?>" data-tab="<?php echo $k;?>">
			<a href="<?php echo $this->getUrl($k, array('ref'=>'iframe'));?>" target="subpage"><?php echo $n;?></a>
		</li>
		<?php endforeach;?>
	</ul>
	<iframe frameborder="0" name="subpage" id="subpage" style="width:100%; background:transparent"></iframe>
</div>
<script>
	seajs.use(['jquery', 'ywj/net'], function($, net){
		var $subpage = $('#subpage');
		$subpage.height($('#container').height());
		var tab = net.getParam('tab') || 'CustomerSource';
		$subpage.attr('src', $('#tab-'+tab).find('a').attr('href'));

		$('#tab-'+tab).addClass('active');

		$('#col-main .frm-tab li').click(function(){
			location.hash = '#tab='+$(this).data('tab');
			$('#col-main .frm-tab li').removeClass('active');
			$(this).addClass('active');
		});
	});
</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>