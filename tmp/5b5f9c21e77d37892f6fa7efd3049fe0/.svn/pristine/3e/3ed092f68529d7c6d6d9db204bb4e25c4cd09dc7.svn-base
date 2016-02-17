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
			<a href="<?php echo $this->getUrl('Sample/updateSampleTechnic', array('sample_id'=>$sample_id))?>" class="btn" rel="popup">新增</a>
		</div>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
			<tr>
				<th style="width:30px;">序号</th>
				<th>流程</th>
				<th>工艺说明</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php if($sample_technic_list): ?>
				<?php foreach($sample_technic_list as $technic):$i++;?>
					<tr>
						<td><?php echo  $i;?></td>
						<td><?php echo  $technic->flow_name ;?></td>
						<td><?php echo  $technic->technic_desc;?></td>
						<td>
							<a href="<?php echo $this->getUrl('Sample/updateSampleTechnic', array('id'=>$technic->id,'sample_id'=>$technic->sample_id))?>" rel="popup">编辑</a>
							<a href="<?php echo $this->getUrl('Sample/deleteSampleTechnic', array('id'=>$technic->id,'sample_id'=>$technic->sample_id))?>" rel="async">删除</a>
						</td>
					</tr>
				<?php endforeach;?>
			<?php endif;?>
			</tbody>
		</table>
	</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>