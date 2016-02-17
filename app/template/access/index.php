<?php
include $this->resolveTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo $this->getSideMenu()?></div>
<div id="col-main">
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl('access/updateAccess')?>" rel="popup"  class="btn">Add权限</a>
	</div>
	<table class="data-tbl" data-empty-fill="1">
		<caption>权限列表</caption>
		<thead>
		<tr>
			<th style="width:30px;">ID</th>
			<th>功能描述</th>
			<th>路径配置</th>
			<th style="width:60px;">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($action_list ?:array() as $action):?>
			<tr>
				<td><?php echo $action['id']?></td>
				<td><?php echo $action['desc'];?></td>
				<td><?php echo $action['uri'];?></td>
				<td>
					<a href="<?php echo $this->getUrl('access/updateAccess', array('id'=>$action['id']));?>" rel="popup">Update</a>
					<a href="<?php echo $this->getUrl('access/removeAccess', array('id'=>$action['id']));?>" rel="async">Delete</a>
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $paginate;?>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>