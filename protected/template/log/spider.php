<?php use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('log/spider');?>" class="search-frm well">
		<div class="frm-item">
			<label>
				关键字：
				<input type="text" class="txt" name="kw" value="<?php echo $search['kw'];?>"/>
			</label>
		</div>
		<div class="frm-item">
			<label>
				时间：
				<input type="text" name="start_time" value="<?php echo $search['start_time']?>" class="txt date-time-txt" /> 至
				<input type="text" name="end_time" value="<?php echo $search['end_time']?>" class="txt date-time-txt" />
			</label>
		</div>
		<div class="frm-item">
			<input type="submit" value="检索" class="btn" />
			<a href="<?php echo $this->getUrl('log/spider');?>">重置搜索</a>
		</div>
	</form>
	<table class="data-tbl" data-empty-fill="1">
		<thead>
		<tr>
			<th>UA</th>
			<th>URL</th>
			<th>IP</th>
			<th>时间</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($log_list as $one):?>
			<tr>
				<td><?php echo $one['ua'];?></td>
				<td><?php echo $one['url'];?></td>
				<td><?php echo $one['ip'];?></td>
				<td><?php echo date('Y-m-d H:i:s',$one['create_time']);?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $paginate;?>
</div>
<?php include $this->getTemplate('inc/footer.inc.php'); ?>