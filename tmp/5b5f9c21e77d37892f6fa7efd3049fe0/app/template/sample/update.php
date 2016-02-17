<?php
use Lite\Core\Config;
use www\model\GlobalConf;
use www\model\Sample;
use www\model\SingleSample;
use www\ViewBase;
use function Lite\func\dump;
use function Lite\func\h;

/** @var Sample $model_instance */
include $this->resolveTemplate('inc/header.inc.php');
$pk = $model_instance->getPrimaryKey();
$extra_params = $this->getData('extra_params');
$update_fields = $this->getData('update_fields');
$extend_info = null;
$ext_defs = null;
if(($model_instance->sample_type ?: $extra_params['sample_type']) == GlobalConf::SAMPLE_TYPE_SINGLE){
	$model_instance->sample_type = GlobalConf::SAMPLE_TYPE_SINGLE;
	/** @var SingleSample $extend_info */
	$extend_info = $model_instance->extend_info;
	$ext_defs = $extend_info->getEntityPropertiesDefine();
	unset($ext_defs['sample_id']);
	foreach($ext_defs as $k=>$def){
		if($def['readonly']){
			unset($ext_defs[$k]);
		}
	}
}
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl($this->getController().'/update', array($pk=>$model_instance->$pk));?>" class="frm" rel="async" method="post">
		<?php foreach($extra_params as $k=>$v):?>
		<input type="hidden" name="<?php echo h($k); ?>" value="<?php echo h($v);?>">
		<?php endforeach;?>

		<table class="frm-tbl">
			<caption><?php echo $model_instance->$pk? '更新' : '新增'?><?php echo $model_instance->getModelDesc();?></caption>
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
						<?php echo ViewBase::renderFormElement($model_instance->$field, $field, $defines[$field], $model_instance)?>
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
					<td class="col-label">尺寸</td>
					<td>
						<?php echo ViewBase::renderFormElement($extend_info->length, 'length', $ext_defs['length'], $extend_info, array('placeholder'=>'长'));?> x
						<?php echo ViewBase::renderFormElement($extend_info->length, 'length', $ext_defs['length'], $extend_info, array('placeholder'=>'宽'));?> x
						<?php echo ViewBase::renderFormElement($extend_info->length, 'length', $ext_defs['length'], $extend_info, array('placeholder'=>'高'));?>
					</td>
				</tr>

				<?php foreach($ext_defs ?: array() as $field=>$def):
				if(in_array($field, array('length', 'width','height'))){
					continue;
				}
				?>
				<tr>
					<td class="col-label"><?php echo $def['alias'];?></td>
					<td>
						<?php if($def['rel'] == 'upload-image'):?>
						<input type="hidden" name="<?php echo $field;?>" value="<?php echo $extend_info->$field;?>" rel="upload-image" data-url="<?php echo Config::get('upload/url').$extend_info->$field;?>">

						<?php elseif($def['rel'] == 'upload-file'):?>
						<input type="hidden" name="<?php echo $field;?>" value="<?php echo $extend_info->$field;?>" rel="upload-file" data-url="<?php echo Config::get('upload/url').$extend_info->$field;?>">

						<?php else:?>
						<?php echo ViewBase::renderFormElement($extend_info->$field,$field, $def, $extend_info)?>
						<?php if($def['description']):?>
						<span class="frm-field-desc">
							<?php echo $def['description'];?>
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
<?php include $this->resolveTemplate('inc/footer.inc.php');?>