<?php use Lite\Core\Router;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');?>
<?php $current_controller = Router::getController();?>
	<div id="col-aside">
		<?php echo $this->getSideMenu();?>
	</div>
	<div id="col-main">
		<div class="operate-bar">
			<a href="<?php echo $this->getUrl('BusinessOrderNote/update', array('business_order_id'=>$business_order_id))?>" class="btn" rel="popup">新增</a>
		</div>
		<table class="data-tbl" data-empty-fill="1">
		<?php foreach($note_paper_list as $note_paper): ?>
			<tbody>
				<tr>
					<td style="background-color: #FFC;width: 50px">时间</td>
					<td><?php echo $note_paper->create_time;?></td>
				</tr>
				<tr>
					<td style="background-color: #FFC;width: 50px">内容</td>
					<td><?php echo $note_paper->note_content ;?></td>
				</tr>
			</tbody>
		<?php endforeach;?>
		</table>
	</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>