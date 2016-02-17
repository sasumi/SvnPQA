<?php use Lite\Core\Router;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');?>
<?php $current_controller = Router::getController();?>
	<div id="col-aside">
		<?php echo $this->getSideMenu();?>
	</div>

	<div id="col-main">
		<form action="<?=$this->getUrl($current_controller.'/update', array('id'=>$sample->id));?>" class="frm" rel="async" method="post">
			<table class="frm-tbl">
				<caption><?php echo $data ? '更新' : '新增';?>样品工价</caption>
				<tbody>
				<tr>
					<td class="col-label">货号</td>
					<td>
						<?php echo $sample->sample_no;?>
					</td>
				</tr>
				<?php foreach($technic_flow_list as $flow_id => $flow_name): ?>
					<?php if(in_array($flow_id,explode(',',$sample->technic_flow_id_list))):?>
				<tr>
					<td class="col-label"><?php echo $flow_name;?></td>
					<td>
						<input type="number" step="0.01" class="txt" name="price_list[<?php echo $flow_id;?>]" value="<?php echo $work_account_grp[$flow_id]['price'];?>">
					</td>
				</tr>
					<?php endif;?>
				<?php endforeach;?>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?=$data ? '保存修改' : '新增'?> ，下一步" class="btn" />
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>