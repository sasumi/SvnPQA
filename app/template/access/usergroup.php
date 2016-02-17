<?php
include $this->resolveTemplate('inc/header.inc.php');?>
	<div id="col-aside"><?php echo $this->getSideMenu()?></div>
	<div id="col-main">
		<div class="operate-bar">
			<a href="<?php echo $this->getUrl('access/updateUserGroup');?>" class="btn">Add用户权限</a>
		</div>
		<?php include 'tab.php';?>
		<table class="data-tbl" data-empty-fill="1">
			<caption>用户权限配置列表</caption>
			<thead>
			<tr>
				<th>用户名称</th>
				<th>权限路径</th>
				<th>权限描述</th>
				<th>类型</th>
				<th style="width:60px">操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($auth_list as $auth):?>
				<tr>
					<td><?php echo $auth->user->name;?></td>
					<td><?php echo $auth->action->uri;?></td>
					<td><?php echo $auth->action->desc;?></td>
					<td><?php echo $auth->type_text;?></td>
					<td>
						<a href="<?php echo $this->getUrl('access/updateUser', array('id'=>$auth->id));?>">Update</a>
						<a href="<?php echo $this->getUrl('access/removeUser', array('id'=>$auth->id));?>" rel="async">Delete</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?php echo $paginate;?>
	</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>