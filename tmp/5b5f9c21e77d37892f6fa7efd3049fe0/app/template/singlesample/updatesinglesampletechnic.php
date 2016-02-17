<?php use Lite\Core\Router;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');?>
<?php $current_controller = Router::getController();?>
	<div id="col-aside">
		<?php echo $this->getSideMenu();?>
	</div>
	<div id="col-main">
		<form action="<?=$this->getUrl($current_controller.'/updateSampleTechnic', array('id'=>$data->id,'sample_id'=>$data->sample_id));?>" class="frm" rel="async" method="post">
			<table class="frm-tbl">
				<tbody>
				<tr>
					<td class="col-label">流程</td>
					<td>
						<select name="flow_id">
							<?php foreach($flow_list as $id=>$name):?>
								<option value="<?=$id;?>" >
									<?php  echo $name ?>
								</option>
							<?php endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="col-label">流程工艺备注</td>
					<td>
						<textarea name="technic_desc" cols="30" rows="3" class="small-txt txt"><?php echo h($data->technic_desc);?></textarea>
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