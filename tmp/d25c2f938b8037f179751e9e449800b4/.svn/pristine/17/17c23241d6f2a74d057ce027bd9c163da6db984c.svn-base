<?php
use Lite\Core\Router;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use www\model\SampleMould;
use www\model\SampleProduceOrder;
use function Lite\func\array_first;
use function Lite\func\dump;
use function Lite\func\h;

/** @var ModelInterface|Model $model_instance */
include $this->resolveTemplate('inc/header.inc.php');

/** @var SampleProduceOrder $base_info */
$base_info = $this->getData('base_info');
$paginate = $this->getData('paginate');
$sample_list = $this->getData('sample_list');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<h2 class="caption">样品生产单 <?php echo $base_info->order_no;?></h2>
	<div class="content-warp">
		<h3 class="caption">基本信息<a href="<?php echo $this->getUrl('SampleProduceOrder/update', array('id'=>$base_info->id));?>" rel="popup">更新</a></h3>

		<dl class="info-list">
			<?php $this->walkDisplayProperties(function($alias, $value, $field)use($base_info){
				echo "<dt>$alias</dt>", "<dd>$value</dd>";
			}, $base_info);?>
		</dl>

		<h3 class="caption">样品列表 <a href="<?php echo $this->getUrl('SampleProduceOrderMapSamples/update', array('produce_order_id'=>$base_info->id));?>" title="添加样品" rel="popup">添加</a></h3>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
				<tr>
					<th>货号</th>
					<th>样品类型</th>
					<th>生产类型</th>
					<th>生产要求</th>
					<th>生产数量</th>
					<th style="width:60px">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php
			/** @var SampleMould $sample */
			foreach($sample_list as $sample):?>
				<tr>
					<td><?php echo $this->displayField('sample_no', $sample);?></td>
					<td><?php echo $this->displayField('sample_type_name', $sample);?></td>
					<td><?php echo $this->displayField('produce_type', $sample);?></td>
					<td><?php echo $this->displayField('produce_request', $sample);?></td>
					<td><?php echo $this->displayField('produce_num', $sample);?></td>
					<td>
						<a href="<?php echo $this->getUrl('SampleProduceOrderMapSamples/delete', array('id'=>$sample->id));?>" rel="async">取消</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
<style>
	.content-warp { max-width:1000px;}
</style>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>