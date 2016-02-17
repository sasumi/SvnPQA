<?php use Lite\Core\Router;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');?>
<?php $current_controller = Router::getController();?>
	<div id="col-aside">
		<?php echo $this->getSideMenu();?>
	</div>
	<div id="col-main">
		<div class="operate-bar">
			<a href="<?php echo $this->getUrl('SampleWorkCost/update');?>" class="btn" rel="popup">添加</a>
		</div>
		<form class="search-frm well" action="<?php echo $this->getUrl('SampleWorkCost/index',$search);?>" method="get">
			<div class="frm-item">
				<label>
					<input class="txt" type="text" name="sample_no" value="<?php echo $search['sample_no'];?>" placeholder="货号"/>
				</label>
			</div>
			<div class="frm-item">
				<input class="btn" type="submit" value="查询"/>
				<a href="<?=$this->getUrl('SampleWorkCost/index',$search);?>" class="btn">重置</a>
			</div>
		</form>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
				<tr>
					<th>货号</th>
					<th>样品名称</th>
					<?php foreach($technic_flow_list?:array() as $v): ?>
					<th style="width:80px; text-align:center"><?php echo $v;?></th>
					<?php endforeach;?>
					<th style="width:80px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($sample_list as $sample): ?>
				<tr>
					<td>
						<a href="<?php echo $this->getUrl('Sample/info', array('id'=>$sample['id']));?>" target="_blank"><?php echo $sample['sample_no']; ?></a>
					</td>
					<td><?php echo $sample['chinese_name']; ?></td>
					<?php foreach($technic_flow_list ?: array() as $k => $v): ?>
					<td style="text-align:center"><?php echo $sample['cost_list'][$k]['price']; ?></td>
					<?php endforeach; ?>
					<td>
						<a href="<?php echo $this->getUrl('SampleWorkCost/update', array('sample_id' => $sample['id'])) ?>"
						   rel="popup">编辑</a>
						<a href="<?php echo $this->getUrl('SampleWorkCost/delete', array('sample_id' => $sample['id'])) ?>" rel="async">删除</a>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<?php echo $paginate; ?>
	</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>