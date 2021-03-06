<?php
use Lite\Core\Router;
use www\model\SampleProduceOrder;
use www\ViewBase;
use function Lite\func\dump;
use function Lite\func\h;

/** @var ViewBase $this */
include $this->resolveTemplate('inc/header.inc.php');
$order_list = $this->getData('order_list');
$produce_type_options = $this->getData('produce_type_options');
$in_business_order = $search['page_flag'] == 'BusinessOrder';
$ctrl = $this->getController();
$act = $this->getAction();
?>
<div id="col-aside">
	<?php echo $this->getSideMenu();?>
</div>
<div id="col-main">
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl('SampleProduceOrder/update')?>" class="btn" rel="popup">新增样品生产单</a>
	</div>

	<form class="search-frm well" action="<?php echo $this->getUrl("$ctrl/$act");?>" method="get">
		<input type="hidden" name="state" value="<?php echo $search['state'];?>">
		<div class="frm-item">
			<label>
				<input type="text" name="kw" value="<?php echo h($search['kw']);?>" class="txt" placeholder="关键字">
			</label>
		</div>
		<?php if(!$in_business_order):?>
		<div class="frm-item">
			<label>
				<select name="produce_type">
					<option value="">全部类型</option>
					<?php foreach($produce_type_options as $k=>$n):?>
						<option value="<?php echo $k;?>" <?php echo $k == $search['produce_type'] && strlen($search['produce_type']) ? 'selected':'';?>>
							<?php echo $n;?>
						</option>
					<?php endforeach;?>
				</select>
			</label>
		</div>
		<?php endif;?>
		<div class="frm-item">
			<input class="btn" type="submit" value="查询"/>
			<a href="<?=$this->getUrl("$ctrl/$act");?>" class="btn">重置</a>
		</div>
	</form>

	<?php if($in_business_order):?>
	<ul class="frm-tab">
		<li class="<?php echo !strlen($search['state']) ? 'active' : '';?>"><a href="<?php echo $this->getUrl("$ctrl/$act");?>"><span>全部</span></a></li>
		<?php
		foreach($state_options as $k=>$n):?>
		<li class="<?php echo strlen($search['state']) && $search['state'] == $k ? 'active':'';?>">
			<a href="<?php echo $this->getUrl("$ctrl/$act", array('state'=>$k));?>">
				<span><?php echo $n;?></span>
			</a>
		</li>
		<?php endforeach;?>
	</ul>
	<?php endif;?>

	<table class="data-tbl" data-empty-fill="1">
		<caption>样品生产单</caption>
		<thead>
			<?php foreach($order_list as $order){
				$this->walkDisplayProperties(function($alias, $value, $field){
					if(!in_array($field, array('create_time', 'update_time', 'business_order_id', 'address', 'contact_id', 'product_fee', 'currency_id'))){
						echo "<th>$alias</th>";
					}
				}, $order);
				break;
			}
			?>
			<th style="width:60px">操作</th>
		</thead>
		<tbody>
			<?php
			/** @var SampleProduceOrder $order */
			foreach($order_list as $order):?>
			<tr>
				<?php
				$this->walkDisplayProperties(function($alias, $value, $field)use($order){
					if(!in_array($field, array('create_time', 'update_time', 'business_order_id', 'address', 'contact_id', 'product_fee', 'currency_id'))){
						if($field == 'state'){
							$value = $this->displayColorState($order, $field);
						}
						echo "<td>$value</td>";
					}
				}, $order);
				?>
				<td>
					<a href="<?php echo $this->getUrl("$ctrl/info", array('id'=>$order->id));?>">查看</a>
					<?php if($order->state == SampleProduceOrder::STATE_FINISH && $in_business_order):?>
					<a href="<?php echo $this->getUrl('SampleProduceOrder/deliver', array('produce_order_id'=>$order->id));?>" rel="popup">邮寄</a>
					<?php endif;?>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $paginate;?>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>