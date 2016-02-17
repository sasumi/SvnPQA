<?php use Lite\Core\Router;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');?>
<?php $current_controller = Router::getController();?>
	<div id="col-aside">
		<?php echo $this->getSideMenu();?>
	</div>
	<div id="col-main">
		<form class="search-frm well" action="<?php echo $this->getUrl('SampleWorkAccount/index',$search);?>" method="get">
			<div class="frm-item">
				<label>
					货号：
					<input class="txt" type="text" name="sample_no" value="<?php echo $search['sample_no'];?>"/>
				</label>
			</div>
			<div class="frm-item">
				<label>
					中文名：
					<input class="txt" type="text" name="chinese_name" value="<?php echo $search['"chinese_name"'];?>"/>
				</label>
			</div>
			<div class="frm-item">
				<input class="btn" type="submit" value="查询"/>
				<a href="<?=$this->getUrl('SampleWorkAccount/index',$search);?>" class="btn">重置</a>
			</div>
		</form>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
				<tr>
					<th>货号</th>
					<th>样品名称</th>
					<?php foreach($technic_flow_list?:array() as $v): ?>
					<th><?php echo $v;?></th>
					<?php endforeach;?>
					<th style="width:60px;">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php if($sample_list):?>
				<?php foreach($sample_list as $sample): ?>
					<tr>
						<td><?php echo  $sample['sample_no'] ;?></td>
						<td><?php echo  $sample['chinese_name'];?></td>
						<?php foreach($technic_flow_list?:array() as $k=>$v): ?>
						<td><?php echo  $sample['account_list'][$k]['price'] ;?></td>
						<?php endforeach;?>
						<td>
							<a href="<?php echo $this->getUrl('SampleWorkAccount/update', array('id'=>$sample['id']))?>" class="btn" rel="popup">编辑</a>
						</td>
					</tr>
				<?php endforeach;?>
			<?php endif;?>
			</tbody>
		</table>
		<?php echo $paginate; ?>
	</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>