<?php
use Lite\Core\Router;
use www\model\BusinessOrder;
use www\model\Sample;
use function Lite\func\array_first;
use function Lite\func\dump;
use function Lite\func\h;
use www\ViewBase;

/**
 * @var ViewBase $this
 * @var BusinessOrder $order
 * @var Sample $sample
 */
$order = $this->getData('order');
$sample_list = $this->getData('sample_list');
$sample_display_fields = array('sample_first_image_src', 'sample_no', 'outer_box_size', 'pack_name','pack_desc', 'sample_num', 'sample_unit_price');
$sample_paginate = $this->getData('sample_paginate');
$note_paginate = $this->getData('note_paginate');
$note_list = $this->getData('note_list');
include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<h2 class="caption">订单信息</h2>
	<div class="content-warp">
		<h3 class="caption">基本信息
			<a href="<?php echo $this->getUrl('BusinessOrder/update', array('id'=>$order->id));?>" rel="popup">更新</a>
		</h3>

		<div class="order-op">
			<a href="<?php echo $this->getUrl('BusinessOrder/songyang', array('id'=>$order['id']))?>" rel="popup" class="btn">送样</a>
			<a href="<?php echo $this->getUrl('BusinessOrder/confirm', array('id'=>$order['id']))?>" rel="popup" class="btn">确认</a>
			<a href="<?php echo $this->getUrl('BusinessOrder/cancel', array('id'=>$order['id']))?>" rel="popup" class="btn">取消</a>
		</div>

		<dl class="info-list">
			<?php $this->walkDisplayProperties(function($alias, $value, $field){
				echo "<dt>$alias</dt>", "<dd>$value</dd>";
			}, $order);?>
		</dl>

		<h3 class="caption">样品列表 <a href="<?=$this->getUrl('BusinessOrder/addSample', array('id'=>$order->id));?>" rel="popup-refresh">添加</a></h3>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
			<tr>
				<?php $this->walkDisplayProperties(function($alias, $value, $field){
					echo "<th>$alias</th>";
				}, array_first($sample_list), $sample_display_fields);?>
				<th style="width:60px">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach($sample_list as $item):?>
				<tr>
					<?php $this->walkDisplayProperties(function($alias, $value, $field){
						echo "<td>$value</td>";
					}, $item, $sample_display_fields)?>
					<td>
						<a href="<?php echo $this->getUrl('BusinessOrderSamples/update', array('id'=>$item->id));?>" rel="popup">更新</a>
						<a href="<?php echo $this->getUrl('BusinessOrderSamples/delete', array('id'=>$item->id));?>" rel="async">删除</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?php echo $sample_paginate;?>

		<h3 class="caption">备注列表 <a href="<?=$this->getUrl('BusinessOrderNote/update', array('business_order_id'=>$order->id));?>" rel="popup">添加</a></h3>
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
						<a href="<?php echo $this->getUrl('BusinessOrderNote/update', array('id'=>$item->id));?>" rel="popup">编辑</a>
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
	.content-warp { max-width:1000px;}
</style>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>