<?php use Lite\Core\Router;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');?>
<?php $current_controller = Router::getController();?>
	<div id="col-aside">
		<?php echo $this->getSideMenu();?>
	</div>
	<div id="col-main">
		<form action="<?=$this->getUrl($current_controller.'/updateSampleProduceData', array('sample_id'=>$data->sample_id));?>" class="frm" rel="async" method="post">
			<table class="frm-tbl">
				<tbody>
				<tr>
					<td class="col-label">泥浆体积</td>
					<td>
						<input type="number" step="0.01" name="clay_volume" class="txt" value="<?=$data->clay_volume;?>"/>ML
					</td>
				</tr>
				<tr>
					<td class="col-label">土坯重量</td>
					<td>
						<input type="number" step="0.01" name="clay_weight" class="txt" value="<?=$data->clay_weight;?>"/>KG
					</td>
				</tr>

				<tr>
					<td class="col-label">色料釉料</td>
					<td>
						<input type="text" name="glaze_color_no" class="txt" value="<?=$data->glaze_color_no;?>"/>
					</td>
				</tr>
				<tr>
					<td class="col-label">花纸代码</td>
					<td>
						<input type="text" name="color_paper_no" class="txt" value="<?=$data->color_paper_no;?>"/>
					</td>
				</tr>
				<tr>
					<td class="col-label">货架展位</td>
					<td>
						<input type="text" name="storage_position" class="txt" value="<?=$data->storage_position;?>"/>
					</td>
				</tr>

				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="保存" class="btn" />
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>