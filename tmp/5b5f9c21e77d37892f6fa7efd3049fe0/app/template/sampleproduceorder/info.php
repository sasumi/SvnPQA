<?php
use Lite\Core\Router;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use www\model\SampleProduceOrder;
use www\model\SampleProduceOrderDeliverInfo;
use www\model\SampleProduceOrderMapSamples;
use www\ViewBase;
use function Lite\func\array_first;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * @var SampleProduceOrder $base_info
 * @var SampleProduceOrderDeliverInfo $deliver_info
 * @var ViewBase $this
 * @var ModelInterface|Model $model_instance
 */
include $this->resolveTemplate('inc/header.inc.php');

$base_info = $this->getData('base_info');
$paginate = $this->getData('paginate');
$sample_list = $this->getData('sample_list');
$sample_process_list = $this->getData('sample_process_list');
$deliver_info = $this->getData('deliver_info');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<h2 class="caption">样品生产单 <?php echo $base_info->order_no;?><a href="<?php echo $this->getUrl($this->getController());?>">返回列表</a></h2>
	<div class="content-fix-width">
		<h3 class="caption">基本信息<a href="<?php echo $this->getUrl('SampleProduceOrder/update', array('id'=>$base_info->id));?>" rel="popup">更新</a></h3>

		<div class="order-op">
			<?php
			if($base_info->state == SampleProduceOrder::STATE_INIT):?>
			<a href="<?php echo $this->getUrl('SampleProduceOrder/state', array('id'=>$base_info->id, 'state'=>SampleProduceOrder::STATE_PRODUCING));?>" rel="async" class="btn">接受</a>
			<?php endif;?>
		</div>

		<dl class="info-list">
			<?php $this->walkDisplayProperties(function($alias, $value, $field)use($base_info){
				if(!in_array($field, array('create_time', 'update_time', 'business_order_id', 'address', 'contact_id', 'product_fee', 'currency_id'))){
					echo "<dt>$alias</dt>";
					if($field == 'state'){
						$value = $this->displayColorState($base_info, $field);
					}
					echo "<dd>$value</dd>";
				}
			}, $base_info);?>
		</dl>

		<h3 class="caption">样品列表
			<a href="<?php echo $this->getUrl('SampleProduceOrderMapSamples/update', array('produce_order_id'=>$base_info->id));?>" title="添加样品" rel="popup">添加</a>
		</h3>
		<form method="post" action="<?php echo $this->getUrl('SampleProduceOrderMapSamples/updateProduceState');?>" rel="async">
			<table class="data-tbl" data-empty-fill="1">
				<thead>
					<tr>
						<?php if($sample_list && $base_info->state == SampleProduceOrder::STATE_PRODUCING):?>
						<th style="width:30px;">
							<input type="checkbox" name="" id="" rel="selector">
						</th>
						<?php endif;?>
						<th style="width:80px;">货号</th>
						<th style="width:80px;">样品类型</th>
						<th>生产要求</th>
						<th style="width:80px;">生产数量</th>
						<th style="width:80px;">生产状态</th>
						<th style="width:80px;">状态</th>
						<th style="width:60px">操作</th>
					</tr>
				</thead>
				<tbody>
				<?php
				/** @var SampleProduceOrderMapSamples $map */
				foreach($sample_list as $map):?>
					<tr>
						<?php if($sample_list && $base_info->state == SampleProduceOrder::STATE_PRODUCING):?>
						<td>
							<input type="checkbox" name="map_ids[]" value="<?php echo $map->id;?>" <?php echo $map->state == SampleProduceOrderMapSamples::STATE_FINISH ? 'disabled="disabled"' : '';?>>
						</td>
						<?php endif;?>

						<td><?php echo $this->displayField('sample_no', $map);?></td>
						<td><?php echo $this->displayField('sample_type_name', $map);?></td>
						<td><?php echo $this->displayField('produce_request', $map);?></td>
						<td><?php echo $this->displayField('produce_num', $map);?></td>
						<td style="white-space:nowrap"><?php echo $this->displayField('produce_state', $map);?></td>
						<td><?php echo $this->displayColorState($map);?></td>
						<td>
							<?php if($map->state != SampleProduceOrderMapSamples::STATE_FINISH):?>
							<span class="nowrap">
								<a href="<?php echo $this->getUrl('SampleProduceOrderMapSamples/update', array('id'=>$map->id));?>" rel="popup">编辑</a>
								<a href="<?php echo $this->getUrl('SampleProduceOrderMapSamples/delete', array('id'=>$map->id));?>" rel="async">移除</a>
								<?php if($base_info->state == SampleProduceOrder::STATE_PRODUCING):?>
								<a href="<?php echo $this->getUrl('SampleProduceOrderMapSamples/state', array('id'=>$map->id, 'state'=>SampleProduceOrderMapSamples::STATE_FINISH));?>" rel="async">完成</a>
								<?php endif;?>
							</span>
							<?php else:?>
							<span class="state-flag state-flag-disabled">已完成</span>
							<?php endif;?>
						</td>
					</tr>
				<?php endforeach;?>
				</tbody>
				<?php if($sample_list && $base_info->state == SampleProduceOrder::STATE_PRODUCING):?>
				<tfoot>
					<tr>
						<td colspan="8" class="st-update-wrap">
							生产状态更新：
							<select name="produce_process_state" id="produce-state-sel" required="required">
								<option value="">请选择</option>
								<?php foreach($sample_process_list as $process):?>
								<option value="<?php echo $process->id;?>"><?php echo $process->name;?></option>
								<?php endforeach;?>
							</select>
							<select name="produce_employee_id" id="produce_employee_id" required="required">
							</select>
							<input type="submit" value="更新" class="btn">
						</td>
					</tr>
				</tfoot>
				<?php endif;?>
			</table>
		</form>

		<h3 class="caption">
			邮寄信息
			<?php if($base_info->state == SampleProduceOrder::STATE_FINISH || $base_info->state == SampleProduceOrder::STATE_DELIVERED):?>
			<a href="<?php echo $this->getUrl('SampleProduceOrder/deliver', array('produce_order_id'=>$base_info->id));?>" rel="popup">更新</a>
			<?php endif;?>
		</h3>
		<table class="info-tbl" data-empty-fill="1">
			<tbody>
			<?php $this->walkDisplayProperties(function($alias, $value, $field){
				if($field != 'produce_order_id'){
					echo "<tr><th>$alias</th><td>$value</td></tr>";
				}
			}, $deliver_info);?>
			</tbody>
		</table>
	</div>
</div>
<style>
	.st-update-wrap select {width:80px; min-width:0}
	.order-op {float:right; margin:-40px 0 0 0; padding:5px;}
</style>
<script>
seajs.use(['jquery', 'ywj/net', 'ywj/msg'], function($, net, Msg){
	$('#produce-state-sel').change(function(){
		if(this.value){
			net.get('<?php echo $this->getUrl('employee/getListByWorkProcessId');?>', {work_process:this.value}, function(rsp){
				if(rsp.code == 0){
					var lst = rsp.data;
					var $emp_sel = $('#produce_employee_id');
					$emp_sel[0].options.length = 0;
					for(var i=0; i<rsp.data.length; i++){
						$('<option value="'+rsp.data[i].id+'">'+rsp.data[i].name+'</option>').appendTo($emp_sel);
					}
				} else {
					Msg.show(rsp.message, 'err');
				}
			});
		}
	});
});
</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>