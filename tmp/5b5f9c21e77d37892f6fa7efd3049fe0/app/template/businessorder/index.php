<?php
use Lite\CRUD\ControllerInterface;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use www\model\BusinessOrder;
use www\ViewBase;
use function Lite\func\dump;
use function Lite\func\h;

/** @var ViewBase $this */
$operation_list = $this->getData('operation_list');
$search = $this->getData('search');
$display_fields = $this->getData('display_fields');
$data_list = $this->getData('data_list');
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

		<?php include $this->resolveTemplate('crud/quick_search.inc.php');?>

		<table class="data-tbl" data-empty-fill="1">
			<caption><?php echo $model_instance->getModelDesc();?>列表</caption>
			<thead>
			<tr>
				<?php foreach($display_fields as $field=>$alias):?>
					<th><?php echo h($alias);?></th>
				<?php endforeach;?>
				<th style="width:50px">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php
			/** @var BusinessOrder $order */
			foreach($data_list ?: array() as $order):?>
				<tr>
					<?php $this->walkDisplayProperties(function($alias, $value,$field)use($order){
						if($field == 'state'){
							$value = $this->displayColorState($order, $field);
						}
						echo "<td>$value</td>";
					}, $order, array_keys($display_fields));
					?>
					<td>
						<dl class="drop-list drop-list-left">
							<dt>
						        <a href="<?php echo $this->getUrl('BusinessOrder/info', array('id'=>$order['id']));?>" class="detail-btn">详情</a>
							</dt>
							<dd>
                                <?php if($order->state == BusinessOrder::STATE_DRAFT): ?>
								<a href="<?php echo $this->getUrl('BusinessOrderPayment/update', array('business_order_id'=>$order['id']))?>" rel="popup">确认订单</a>
                                <?php endif;?>

								<?php if($order->state != BusinessOrder::STATE_CLOSE):?>
								<a href="<?php echo $this->getUrl('BusinessOrder/addSampleProduceOrder', array('id'=>$order['id']))?>" rel="popup">送样</a>
								<a href="<?php echo $this->getUrl('BusinessOrder/state', array('id'=>$order['id'],'state'=>BusinessOrder::STATE_CLOSE))?>" rel="async">关闭订单</a>
								<?php endif;?>
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