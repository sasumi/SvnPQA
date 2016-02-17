<?php use www\model\WorkStage;

include $this->resolveTemplate('inc/header.inc.php');
$process_list = $this->getData('process_list');
$paginate = $this->getData('paginate');
?>
<div id="col-aside"><?php echo $this->getSideMenu()?></div>
<div id="col-main">
	<table class="data-tbl" data-empty-fill="1">
		<caption>工序</caption>
		<thead>
		<tr>
			<th>名称</th>
			<th style="width:60px;"></th>
			<th style="width:60px">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($process_list?:array() as $stage_id=>$ps):?>
			<tr class="stage-row">
				<td colspan="2">
					<span class="stage-name">
						<?php echo WorkStage::$work_stage_list[$stage_id];?>
					</span>
					<a href="<?php echo $this->getUrl('WorkProcess/update', array('stage_id'=>$stage_id));?>" rel="popup">添加工序</a>
				</td>
				<td>
				</td>
			</tr>
			<?php foreach($ps as $p):?>
			<tr>
				<td>
					<span class="process-name">
						<?php echo $p->name;?>
					</span>
				</td>
				<td>
					<span class="state-label <?php echo !$p->state ? 'state-label-error' : 'state-label-success';?>">
						<?php echo $p->state_text;?>
					</span>
				</td>
				<td>
					<?php if($p->state):?>
					<a href="<?php echo $this->getUrl('WorkProcess/state', array('id'=>$p->id, 'state'=>0));?>" rel="async">禁用</a>
					<?php else:?>
					<a href="<?php echo $this->getUrl('WorkProcess/state', array('id'=>$p->id, 'state'=>1));?>" rel="async">启用</a>
					<?php endif;?>
					<a href="<?php echo $this->getUrl('WorkProcess/update', array('id'=>$p->id));?>" rel="popup">更新</a>
				</td>
			</tr>
			<?php endforeach;?>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $paginate; ?>
</div>
	<style>
		.stage-row td {padding:20px 10px;}
		.stage-name {font-size:18px;}
		.process-name { display:block; text-indent:50px;;}
	</style>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>