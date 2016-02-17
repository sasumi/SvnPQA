<?php
use Lite\Core\Router;
use Lite\Core\CRUD\ControllerInterface;
use Lite\Core\CRUD\ModelInterface;
use Lite\DB\Model;
use function Lite\func\dump;
use function Lite\func\h;

/** ViewBase $this */
/** @var ModelInterface|Model $model_instance */
include $this->resolveTemplate('inc/header.inc.php');
$pk = $model_instance->getPrimaryKey();
$operation_list = $this->getData('operation_list');
$display_fields = $this->getData('display_fields');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<table class="frm-tbl">
		<caption><?php echo $model_instance->getModelDesc();?>信息</caption>
		<tbody>
			<?php
			foreach($display_fields as $field=>$alias):
				$define = $defines[$field];
				$text = $model_instance->$field;
				$html = $this->displayField($field, $model_instance);
				?>
			<tr>
				<td class="col-label"><?php echo h($alias);?></td>
				<?php if(!in_array(ControllerInterface::OP_STATE, $operation_list) || $model_instance->getStateKey() != $field):?>
				<td><?php echo $html ?: h($text);?></td>
				<?php else:?>
				<td>
					<dl class="drop-list drop-list-left">
						<dt><span><?php echo h($text);?></span></dt>
						<dd>
							<?php foreach($define['options'] as $k=>$n):?>
							<?php if($n != $text):?>
							<a href="<?php echo $this->getUrl($this->getController().'/state', array($pk=>$model_instance->$pk, 'state'=>$k));?>" rel="async">
								<?php echo h($n);?>
							</a>
							<?php endif;endforeach;?>
						</dd>
					</dl>
				</td>
				<?php endif;?>
			</tr>
			<?php endforeach;?>

			<tr>
				<td></td>
				<td class="col-action">
					<?php if(in_array(ControllerInterface::OP_UPDATE, $operation_list)):?>
					<a href="<?php echo $this->getUrl($this->getController().'/update', array($pk=>$model_instance->$pk, 'ref'=>Router::get('ref')));?>" class="btn">修改</a>
					<?php endif;?>

					<?php if(in_array(ControllerInterface::OP_DELETE, $operation_list)):?>
					<a href="<?php echo $this->getUrl($this->getController().'/delete', array($pk=>$model_instance->$pk));?>" rel="async" class="btn btn-danger">删除</a>
					<?php endif;?>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<style>
	.frm-tbl td.col-label {width:100px; text-shadow:1px 1px 1px white;}
</style>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>