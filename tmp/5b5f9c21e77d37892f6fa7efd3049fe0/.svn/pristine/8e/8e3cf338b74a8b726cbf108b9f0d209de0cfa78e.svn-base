<?php
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use www\ViewBase;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * @var ModelInterface|Model $model_instance
 * @var ViewBase $this
 */
$pk = $model_instance->getPrimaryKey();
$search = $this->getData('search');
$operation_list = $this->getData('operation_list');
$display_fields = $this->getData('display_fields');
$data_list = $this->getData('data_list');
$paginate = $this->getData('paginate');
include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside"><?php echo $this->getSideMenu()?></div>
<div id="col-main">
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl($this->getController().'/update');?>" class="btn" rel="popup">新增客户</a>
	</div>

	<table class="data-tbl" data-empty-fill="1">
		<caption>客户列表</caption>
		<thead>
		<tr>
			<?php foreach($display_fields as $field=>$alias):?>
			<th><?php echo h($alias);?></th>
			<?php endforeach;?>
			<th style="width:60px">操作</th>
		</tr>
		</thead>
		<tbody>
			<?php foreach($data_list ?: array() as $item):?>
			<tr>
				<?php $this->walkDisplayProperties(function($alias, $val, $field){
					echo "<td>$val</td>";
				}, $item);?>
				<td>
					<a href="<?php echo $this->getUrl($this->getController().'/info', array($pk=>$item->$pk));?>">详情</a>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $paginate;?>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>