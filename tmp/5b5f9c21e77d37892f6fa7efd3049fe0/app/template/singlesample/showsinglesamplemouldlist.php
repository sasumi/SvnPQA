<?php use Lite\Core\Router;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');?>
<?php $current_controller = Router::getController();?>
	<div id="col-aside">
		<?php echo $this->getSideMenu();?>
	</div>
	<div id="col-main">
		<?php include $this->resolveTemplate('inc/sample_update_tab.inc.php')?>
		<div class="operate-bar">
			<a href="<?php echo $this->getUrl('Sample/updateSampleMould', array('sample_id'=>$sample_id))?>" class="btn" rel="popup">新增</a>
		</div>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
			<tr>
				<th style="width:30px;">序号</th>
				<th>名称</th>
				<th>模具重量</th>
				<th>模具块数</th>
				<th>模具仓位</th>
				<th>产品数(个/付)</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if($sample_mould_list):?>
				<?php foreach($sample_mould_list as $mould): $i++;?>
					<tr>
						<td><?php echo  $i;?></td>
						<td><?php echo  $mould->name ;?></td>
						<td><?php echo  $mould->weight;?></td>
						<td><?php echo  $mould->mould_num ;?></td>
						<td><?php echo  $mould->freight_space;?></td>
						<td><?php echo  $mould->product_num ;?></td>
						<td>
							<a href="<?php echo $this->getUrl('Sample/updateSampleMould', array('id'=>$mould->id,'sample_id'=>$mould->sample_id))?>" rel="popup">编辑</a>
							<a href="<?php echo $this->getUrl('Sample/deleteSampleMould', array('id'=>$mould->id,'sample_id'=>$mould->sample_id))?>" rel="async">删除</a>
						</td>
					</tr>
				<?php endforeach;?>
			<?php endif;?>
			</tbody>
		</table>
	</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>