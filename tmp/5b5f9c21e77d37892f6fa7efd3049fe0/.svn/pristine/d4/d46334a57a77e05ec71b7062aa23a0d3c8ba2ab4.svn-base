<?php use Lite\Core\Config;
use Lite\Core\Router;
use function Lite\func\h;

$single_sample_id_list = $this->getData('single_sample_id_list');
$all_single_sample_list = $this->getData('all_single_sample_list');
include $this->resolveTemplate('inc/header.inc.php');?>
<div id="col-aside">
	<?php echo $this->getSideMenu();?>
</div>
<div id="col-main">
	<form class="search-frm well" action="<?php echo $this->getUrl('Sample/searchSingleSample', array('id'=>$sample->id, 'ref'=>$search['ref']));?>" method="get">
		<input type="hidden" name="id" value="<?php echo $sample->id;?>">
		<div class="frm-item">
			<label>
				<input class="txt" type="text" name="sample_no" value="<?php echo $search['sample_no'];?>" placeholder="货号"/>
			</label>
		</div>
		<div class="frm-item">
			<input class="btn" type="submit" value="查询"/>
			<a href="<?=$this->getUrl('Sample/searchSingleSample', array('id'=>$sample->id, 'ref'=>$search['ref']));?>" class="btn">重置</a>
		</div>
	</form>
	<table class="data-tbl" data-empty-fill="1">
		<thead>
		<tr>
			<th style="width:100px;">图片</th>
			<th>货号</th>
			<th>名称</th>
			<th>尺寸</th>
			<th>重量</th>
			<th style="width:60px;">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if($all_single_sample_list):?>
			<?php foreach($all_single_sample_list as $item): ?>
				<tr>
					<td><?php echo $this->getImg($item['image_url'] ?: Config::get('app/default_image'), array('max-width'=>48, 'max-height'=>48));?></td>
					<td><?php echo $item['sample_no'];?></td>
					<td><?php echo $item['chinese_name'];?></td>
					<td><?php echo $item['length'],'x',$item['width'],'x',$item['height'];?></td>
					<td><?php echo $item['weight'];?></td>
					<td>
						<?php if(!in_array($item['id'],$single_sample_id_list)):?>
						<a href="<?php echo $this->getUrl('Sample/addSingleSample', array(
							'single_sample_id'=>$item['id'],
							'suite_sample_id'=>$sample->id))?>" class="btn" rel="async" onsuccess="onsuccess">添加</a>
						<?php else:?>
							<a href="<?php echo $this->getUrl('Sample/removeSingleSample', array('id'=>$sample->id, 'single_sample_id'=>$item->id));?>"
							   onsuccess="onsuccess"
							   rel="async">取消</a>
						<?php endif;?>
					</td>
				</tr>
			<?php endforeach;?>
		<?php endif;?>
		</tbody>
	</table>
	<?php echo $paginate; ?>
	<div style="padding:10px; text-align:center; clear:both;" id="confirm-btn">
		<input type="button" value="确认" class="btn">
	</div>
</div>
<style>
	.pagination {float:right; padding-right:10px;}
	.data-tbl {box-shadow:none;}
</style>
<script>
	var onsuccess = function(){
		location.reload();
	};
	seajs.use(['jquery', 'ywj/popup'], function($, Pop){
		$('#confirm-btn').click(function(){
			Pop.getCurrentPopup().close();
		});
	});
</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>