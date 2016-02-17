<?php
use Lite\Core\Config;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use function Lite\func\dump;
use function Lite\func\h;
use SvnPQA\ViewBase;

/**
 * @var ModelInterface|Model $model_instance
 * @var ViewBase $this
 */
include $this->resolveTemplate('inc/header.inc.php');
$pk = $model_instance->getPrimaryKey();
$extra_params = $this->getData('extra_params');
$update_fields = $this->getData('update_fields');
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
			<caption><?php echo $model_instance->$pk? 'Update' : 'Save'?><?php echo $model_instance->getModelDesc();?></caption>
			<tbody>
				<?php foreach($update_fields as $field=>$alias):?>
				<tr>
					<td class="col-label"><?php echo $alias;?></td>
					<td>
						<?php if($defines[$field]['rel'] == 'upload-image'):?>
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
						<input type="submit" value="Save" class="btn" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>