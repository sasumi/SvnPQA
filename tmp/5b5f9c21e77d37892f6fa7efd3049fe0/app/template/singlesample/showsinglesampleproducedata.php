<?php use Lite\Core\Router;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');?>
<?php $current_controller = Router::getController();?>
	<div id="col-aside">
		<?php echo $this->getSideMenu();?>
	</div>
	<div id="col-main">
		<?php include $this->resolveTemplate('inc/sample_update_tab.inc.php')?>
		<div class="operate-bar">
			<a href="<?php echo $this->getUrl($current_controller.'/updateSampleProduceData', array('sample_id'=>$data->sample_id));?>" class="btn" rel="popup"><?php echo $data->id?'修改':'添加';?></a>
		</div>
		<?php if($data->id):?>
			<table class="frm-tbl">
				<tbody>
				<tr>
					<td class="col-label">泥浆体积</td>
					<td>
						<?=$data->clay_volume;?>ML
					</td>
				</tr>
				<tr>
					<td class="col-label">土坯重量</td>
					<td>
						<?=$data->clay_weight;?>KG
					</td>
				</tr>

				<tr>
					<td class="col-label">色料釉料</td>
					<td>
						<?=$data->glaze_color_no;?>
					</td>
				</tr>
				<tr>
					<td class="col-label">花纸代码</td>
					<td>
						<?=$data->color_paper_no;?>
					</td>
				</tr>
				<tr>
					<td class="col-label">货架展位</td>
					<td>
						<?=$data->storage_position;?>
					</td>
				</tr>
				</tbody>
			</table>
		<?php endif;?>
	</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>