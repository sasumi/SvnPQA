<?php
use Lite\CRUD\ControllerInterface;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use www\ViewBase;
use function Lite\func\dump;
use function Lite\func\h;

/** @var ViewBase $this */
$operation_list = $this->getData('operation_list');
$search = $this->getData('search');
$display_fields = $this->getData('display_fields');
$data_list = $this->getData('data_list');
$defines = $this->getData('defines');
$quick_update_fields = $this->getData('quick_update_fields');
$paginate = $this->getData('paginate');
$quick_search_fields = $this->getData('quick_search_fields');

/** @var ModelInterface|Model $model_instance */
$pk = $model_instance->getPrimaryKey();
include $this->resolveTemplate('inc/header.inc.php');
?>
	<div id="col-aside"><?php echo $this->getSideMenu()?></div>
	<div id="col-main">
		<?php if(in_array(ControllerInterface::OP_UPDATE, $this->getData('operation_list'))):?>
			<div class="operate-bar">
				<a href="<?php echo $this->getUrl($this->getController().'/update');?>" class="btn" rel="popup">新增<?php echo $model_instance->getModelDesc();?></a>
			</div>
		<?php endif;?>

		<?php if(in_array(ControllerInterface::OP_QUICK_SEARCH, $operation_list)):
			$pl = array();
			foreach($quick_search_fields as $f){
				array_push($pl, $defines[$f]['alias']);
			}
			?>
			<form class="search-frm well" action="<?php echo $this->getUrl($this->getController());?>" method="get">
				<div class="frm-item">
					<label>
						<input class="txt" type="text" name="kw" style="width:200px;" value="<?php echo h($search['kw']);?>" placeholder="<?php echo join(',', $pl);?>" title="<?php echo join(',', $pl);?>"/>
					</label>
				</div>
				<div class="frm-item">
					<input class="btn" type="submit" value="查询"/>
					<a href="<?=$this->getUrl($this->getController());?>" class="btn">重置</a>
				</div>
			</form>
		<?php endif;?>

		<table class="data-tbl" data-empty-fill="1">
			<caption><?php echo $model_instance->getModelDesc();?>列表</caption>
			<thead>
			<tr>
				<?php foreach($display_fields as $field=>$alias):?>
					<th><?php echo h($alias);?></th>
				<?php endforeach;?>
				<th style="width:90px">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php
			/** @var Model $order */
			foreach($data_list ?: array() as $order):?>
				<tr>
					<?php $this->walkDisplayProperties(function($alias, $value,$field){
						echo "<td>$value</td>";
					}, $order, array_keys($display_fields));
					?>
					<td>
						<a href="<?php echo $this->getUrl('BusinessOrder/info', array('id'=>$order['id']));?>" class="detail-btn">详情</a>
						<dl class="drop-list drop-list-left">
							<dt>
								<a href="<?php echo $this->getUrl('SampleProduceOrder/addFromBusinessOrder', array('business_order_id'=>$order['id']))?>" rel="popup">送样</a>
							</dt>
							<dd>
								<a href="<?php echo $this->getUrl('BusinessOrder/confirm', array('id'=>$order['id']))?>" rel="popup">确认</a>
								<a href="<?php echo $this->getUrl('BusinessOrder/cancel',  array('id'=>$order['id']))?>" rel="popup">取消</a>
							</dd>
						</dl>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?php echo $paginate;?>
	</div>
	<style>
		.detail-btn {display:inline-block; vertical-align:middle;  font-size:14px;}
	</style>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>