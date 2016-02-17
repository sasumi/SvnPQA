<?php
use Lite\Core\Router;
use www\model\BusinessOrder;
use www\model\Sample;
use www\ViewBase;
use function Lite\func\array_first;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * @var ViewBase $this
 * @var BusinessOrder $order
 * @var Sample $sample
 */
$order = $this->getData('order');
$sample_list = $this->getData('sample_list');
$sample_display_fields = array('sample_first_image_src', 'sample_no', 'outer_box_size', 'pack_name', 'sample_num', 'sample_unit_price', 'sample_sum');
$sample_paginate = $this->getData('sample_paginate');
$note_paginate = $this->getData('note_paginate');
$note_list = $this->getData('note_list');
include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<h2 class="caption">订单信息<a href="<?php echo $this->getUrl('BusinessOrder');?>">返回列表</a></h2>
	<div class="content-fix-width">
		<h3 class="caption">基本信息
			<?php if($order->state == BusinessOrder::STATE_DRAFT):?>
			<a href="<?php echo $this->getUrl('BusinessOrder/update', array('id'=>$order->id));?>" rel="popup">更新</a>
			<?php endif;?>
		</h3>

		<div class="order-op">
			<?php if($order->state == BusinessOrder::STATE_DRAFT): ?>
			<a href="<?php echo $this->getUrl('BusinessOrderPayment/update', array('business_order_id'=>$order['id']))?>" class="btn" rel="popup">确认订单</a>
			<?php endif;?>

			<?php if($order->state != BusinessOrder::STATE_CLOSE):?>
			<a href="<?php echo $this->getUrl('BusinessOrder/addSampleProduceOrder', array('id'=>$order['id']))?>" class="btn" rel="popup">送样</a>
			<a href="<?php echo $this->getUrl('BusinessOrder/state', array('id'=>$order['id'],'state'=>BusinessOrder::STATE_CLOSE))?>" class="btn btn-danger" rel="async" data-confirm="是否确认要关闭该订单？">关闭订单</a>
			<?php else:?>
			<a href="<?php echo $this->getUrl('BusinessOrder/state', array('id'=>$order['id'],'state'=>BusinessOrder::STATE_DRAFT));?>" class="btn btn-danger" rel="async" data-confirm="是否确认重新开启订单？">重新开启</a>
			<?php endif;?>
		</div>

		<dl class="info-list">
			<?php $this->walkDisplayProperties(function($alias, $value, $field){
				if($field != 'state' && $field != 'total_volume' && $field != 'total_price'){
					echo "<dt>$alias</dt>", "<dd>$value</dd>";
				}
			}, $order);?>

			<dt>总价</dt>
			<dd><?php echo $this->displayField('total_price', $order);?></dd>

			<dt>状态</dt>
			<dd>
				<?php echo $this->displayColorState($order);?>
				<?php if($order->sample_produce_order):?>
				<a href="<?php echo $this->getUrl('SampleProduceOrder/info', array('id'=>$order->sample_produce_order->id));?>" target="_blank">查看样品单</a>
				<?php endif;?>
			</dd>
		</dl>

		<h3 class="caption">样品列表
			<?php if($order->state == BusinessOrder::STATE_DRAFT):?>
			<a href="<?=$this->getUrl('BusinessOrder/addSample', array('id'=>$order->id));?>" rel="popup-refresh">添加</a>
			<?php endif;?>
		</h3>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
			<tr>
				<?php $this->walkDisplayProperties(function($alias, $value, $field){
					echo "<th>$alias</th>";
				}, array_first($sample_list), $sample_display_fields);?>

				<?php if($order->state == $order::STATE_DRAFT):?>
				<th style="width:60px">操作</th>
				<?php endif;?>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach($sample_list as $item):?>
				<tr>
					<?php $this->walkDisplayProperties(function($alias, $value, $field)use($item){
						if($field == 'sample_first_image_src' || $field=='sample_no'){
							$value = '<a href="'.$this->getUrl('Sample/info', array('id'=>$item->sample_id)).'" target="_blank" title="查看样品">'.$value.'</a>';
						}
						echo "<td>$value</td>";
					}, $item, $sample_display_fields)?>
					<td>
						<?php if($order->state == $order::STATE_DRAFT):?>
						<a href="<?php echo $this->getUrl('BusinessOrderSamples/update', array('id'=>$item->id));?>" rel="popup">更新</a>
						<a href="<?php echo $this->getUrl('BusinessOrderSamples/delete', array('id'=>$item->id));?>" rel="async">删除</a>
						<?php endif;?>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?php echo $sample_paginate;?>

		<h3 class="caption">备注列表
			<a href="<?=$this->getUrl('BusinessOrderNote/update', array('business_order_id'=>$order->id));?>" rel="popup" data-width="730">添加</a>
		</h3>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
				<?php if($note_list):?>
				<tr>
					<?php $this->walkDisplayProperties(function($alias, $value, $field){
						if($field != 'business_order_id'){
							echo "<th>$alias</th>";
						}
					}, array_first($note_list));?>
					<th style="width:60px">操作</th>
				</tr>
				<?php endif;?>
			</thead>
			<tbody>
				<?php
				foreach($note_list as $item):?>
				<tr>
					<?php $this->walkDisplayProperties(function($alias, $value, $field){
						if($field != 'business_order_id'){
							echo "<td>$value</td>";
						}
					}, $item)?>
					<td>
						<a href="<?php echo $this->getUrl('BusinessOrderNote/update', array('id'=>$item->id));?>" rel="popup" data-width="730">编辑</a>
						<a href="<?php echo $this->getUrl('BusinessOrderNote/delete', array('id'=>$item->id));?>" rel="async">删除</a>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<?php echo $note_paginate;?>
	</div>
</div>
<style>
	.order-op {float:right; margin:-40px 0 0 0; padding:5px;}
	.pagination {margin-bottom:10px; display:block; text-align:right;}
</style>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>