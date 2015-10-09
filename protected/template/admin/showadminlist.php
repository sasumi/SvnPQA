<?php use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl('admin/updateUser');?>" class="btn" rel="popup">新增管理员</a>
	</div>
	<form class="search-frm well" action="<?php echo $this->getUrl('admin/showAdminList');?>">
		<div class="frm-item">
			<label>
				用户名：<input class="txt" type="text" name="kw" value="<?php echo $search['kw'];?>"/>
			</label>
		</div>
		<div class="frm-item">
			<label>
				角色：
				<select class="form-control" name="role_id">
					<option value="">全部角色</option>
					<?php foreach($role_list as $role):?>
						<option value="<?php echo $role->id;?>" <?php echo $search['role_id'] == $role->id ? 'selected' : '';?>><?php echo $role->name;?></option>
					<?php endforeach;?>
				</select>
			</label>
		</div>
		<div class="frm-item">
			<label>
				登录时间：<input class="txt date-time-txt" type="text" name="login_date" value="<?php echo $search['login_date'];?>"/>
			</label>
		</div>
		<div class="frm-item">
			<input class="btn" type="submit" value="查询"/>
			<a href="<?=$this->getUrl('admin/showAdminList');?>" class="btn">重置</a>
		</div>
	</form>
	<table class="data-tbl" data-tags="emptyfix,select">
		<thead>
		<tr>
			<th>用户名</th>
			<th>角色</th>
			<th>email</th>
			<th style="width:120px">创建时间</th>
			<th style="width:120px">最后登录时间</th>
			<th style="width:120px">最后登录IP</th>
			<th style="width:50px">状态</th>
			<th style="width:80px">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($user_list as $user):?>
			<tr>
				<td><?php echo $user->admin_name;?></td>
				<td><?php echo $user->role->name;?></td>
				<td><?php echo $user->email;?></td>
				<td><?php echo date('Y-m-d H:i:s',$user->last_time);?></td>
				<td><?php echo date('Y-m-d H:i:s',$user->create_time);?></td>
				<td><?php echo $user->last_ip;?></td>
				<td>
					<center><?php echo $user->del_state_html;?></center>
				</td>
				<td>
					<a href="<?php echo $this->getUrl('admin/updateUserState', array('id'=>$user->id, 'toState'=>$user->is_del))?>" rel="async">
						<?php echo $user->is_del ? '启用' : '禁用'?>
					</a>
					<a href="<?php echo $this->getUrl('admin/updateUser', array('id'=>$user->id))?>" rel="popup" title="编辑用户信息">编辑</a>
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $page; ?>
</div>
<?php include $this->getTemplate('inc/footer.inc.php');?>