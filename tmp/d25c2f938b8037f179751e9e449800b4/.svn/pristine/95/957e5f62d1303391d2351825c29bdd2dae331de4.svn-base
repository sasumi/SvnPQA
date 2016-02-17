<?php

include $this->resolveTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo $this->getSideMenu()?></div>
<div id="col-main">
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl('admin/updateRole')?>" rel="popup" class="btn">新增角色</a>
	</div>
	<table class="data-tbl" data-empty-fill="1">
		<thead>
			<tr>
				<th style="width:30px">id</th>
				<th>角色名</th>
				<th>开放权限</th>
				<th>禁止权限</th>
				<th style="width:80px">缺省类型</th>
				<th style="width:50px">状态</th>
				<th style="width:80px">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($role_list as $role):?>
			<tr <?php if($role['is_del']):?> class="danger"<?php endif;?>>
				<td><?php echo $role['id'];?></td>
				<td><?php echo $role['name'];?></td>
				<td><?php echo str_replace(',',',<br/>',$role['allow'])?></td>
				<td><?php echo str_replace(',',',<br/>',$role['deny'])?></td>
				<td><?php echo $role['default_type'] ? '<span class="label label-success">'.$role['default_type_txt'].'</span>' :
						'<span class="label label-warning">'.$role['default_type_txt'].'</span>'?></td>
				<td><?php echo $role['is_del'] ? '<span class="label label-warning">禁用</span>' : '<span class="label label-success">正常</span>';?></td>
				<td>
					<a href="<?php echo $this->getUrl('admin/updateRoleState', array('id'=>$role['id'], 'toState'=>!$role['is_del']))?>" rel="async">
						<?php echo $role['is_del'] ? '启用' : '禁用'?>
					</a>
					<a href="<?php echo $this->getUrl('admin/updateRole', array('id'=>$role['id']))?>" rel="popup" title="编辑用户信息">编辑</a>
<!--						<a href="--><?php //echo $this->getUrl('admin/deleteRole', array('id'=>$role['id']));?><!--" rel="async" data-confirm="确认是否要删除改用户新信息？">删除</a>-->
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $page; ?>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>