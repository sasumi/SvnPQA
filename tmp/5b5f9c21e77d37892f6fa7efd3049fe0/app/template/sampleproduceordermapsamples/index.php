<?php
use function Lite\func\dump;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside"><?php echo $this->getSideMenu()?></div>
<div id="col-main">
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl('SampleProduceOrderMapSamples/update', array('sample_produce_id'=>$order_info->id));?>" class="btn" rel="popup">添加生产样品</a>
	</div>
	<table class="info-tbl">
		<tbody>
			<tr>
				<th>生产单号</th>
				<td><?php echo $order_info->order_no;?></td>
			</tr>
			<tr>
				<th>联系人</th>
				<td><?php echo $order_info->contact->chinese_name;?></td>
			</tr>
			<tr>
				<th>预交付日期</th>
				<td><?php echo $order_info->book_delivery_date;?></td>
			</tr>
		</tbody>
	</table>
	<table class="data-tbl" data-empty-fill="1">
		<caption>生产样品列表</caption>
		<thead>
		<tr>
			<th>图片</th>
			<th>货号</th>
			<th>类型</th>
			<th>生产要求</th>
			<th>数量</th>
			<th style="width:60px">操作</th>
		</tr>
		</thead>
		<tbody>
			<?php foreach($data_list ?: array() as $item):?>
			<tr>
				<td>
					<?php if($item->image_list):?>
					<?php foreach($item->image_list as $img):?>'
					<img src="<?php echo $this->buildUploadImage($img); ?>" alt="">
					<?php endforeach;?>
					<?php else:?>
					-
					<?php endif;?>
				</td>
				<td>
					<?php echo $item->sample_no;?>
				</td>
				<td>
					<?php echo $item->produce_type_text;?>
				</td>
				<td>
					<?php echo $item->produce_request;?>
				</td>
				<td>
					<?php echo $item->produce_num;?>
				</td>
				<td>
					<a href="<?php echo $this->getUrl('SampleProduceOrderMapSamples/update', array('id'=>$item->id));?>" rel="popup">编辑</a>
					<a href="<?php echo $this->getUrl('SampleProduceOrderMapSamples/delete', array('id'=>$item->id));?>" rel="async">删除</a>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $paginate;?>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>