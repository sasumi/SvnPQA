<?php
use Lite\Core\Config;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use www\model\WorkProcess;
use www\model\WorkStage;
use function Lite\func\array_group;
use function Lite\func\dump;
use function Lite\func\h;

/** @var ModelInterface|Model $model_instance */
include $this->resolveTemplate('inc/header.inc.php');
$pk = $model_instance->getPrimaryKey();
$extra_params = $this->getData('extra_params');
$update_fields = $this->getData('update_fields');
$all_process_list = WorkProcess::getProcessInOrder();
$all_process_list = array_group($all_process_list, 'work_stage_id');
?>
	<div id="col-aside">
		<?php echo $this->getSideMenu()?>
	</div>
	<div id="col-main">
		<form action="<?php echo $this->getUrl($this->getController().'/update', array($pk=>$model_instance->$pk));?>" class="frm" rel="async" method="post">
			<input style="display:none">
			<input type="password" style="display:none">

			<?php foreach($extra_params as $k=>$v):?>
			<input type="hidden" name="<?php echo h($k); ?>" value="<?php echo h($v);?>">
			<?php endforeach;?>

			<table class="frm-tbl">
				<caption><?php echo $model_instance->$pk? '更新' : '新增'?><?php echo $model_instance->getModelDesc();?></caption>
				<tbody>
				<?php foreach($update_fields as $field=>$alias):?>
					<tr class="field-row-<?php echo $field;?>">
						<td class="col-label"><?php echo $alias;?></td>
						<td>
							<?php if($field == 'work_process'):?>
							<select name="work_process" id="">
								<?php foreach(WorkStage::$work_stage_list as $k=>$stage_name):?>
								<optgroup label="<?php echo $stage_name;?>">
									<?php foreach($all_process_list[$k] as $process):?>
									<option value="<?php echo $process['id'];?>" <?php echo $process['id'] == $model_instance->work_process ? 'selected':''?>>
										<?php echo $process['name'];?>
									</option>
									<?php endforeach;?>
								</optgroup>
								<?php endforeach;?>
							</select>

							<?php elseif($defines[$field]['rel'] == 'upload-image'):?>
							<input type="hidden" name="<?php echo $field;?>" value="<?php echo $model_instance->$field;?>" rel="upload-image" data-url="<?php echo Config::get('upload/url').$model_instance->$field;?>">

							<?php elseif($defines[$field]['rel'] == 'upload-file'):?>
							<input type="hidden" name="<?php echo $field;?>" value="<?php echo $model_instance->$field;?>" rel="upload-file" data-url="<?php echo Config::get('upload/url').$model_instance->$field;?>">

							<?php else:?>
							<?php echo $this->renderFormElement($model_instance->$field,$field, $defines[$field], $model_instance)?>
							<?php if($defines[$field]['description']):?>
							<span class="frm-field-desc">
								<?php echo $defines[$field]['description'];?>
							</span>
							<?php endif;?>
							<?php endif;?>
						</td>
					</tr>
				<?php endforeach;?>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?php echo $model_instance->$pk? '保存修改' : '新增'?>" class="btn" />
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
	<style>
		.field-row-leave_time {display:none}
	</style>
	<script>
		seajs.use('jquery', function(){
			$('[name=state]').change(function(){
				var here = this.value == 1 && this.checked;
				$('.field-row-leave_time')[here ? 'hide' : 'show']();
				if(here){
					$('[name=leave_time]').val('');
				}
			}).trigger('change');
		})
	</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>