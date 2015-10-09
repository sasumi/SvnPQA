<?php use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');?>
<div id="col-aside">
	<?php echo ViewBase::getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('admin/updateUser', array('id'=>$user['id']));?>" class="frm" rel="async" method="post">
		<table class="frm-tbl">
			<caption>新增管理员</caption>
			<tbody>
				<tr>
					<td class="col-label">用户账号</td>
					<td><input type="text" name="admin_name" class="txt" value="<?php echo $user['admin_name'];?>"/></td>
				</tr>
				<tr>
					<td class="col-label">密码</td>
					<td>
						<input type="password" name="password" value="" class="txt" />
						<?php if($user['id']):?><span class="label label-info">置空表示不做重置</span><?php endif;?>
					</td>
				</tr>
				<tr>
					<td class="col-label">角色</td>
					<td>
						<select name="role_id">
							<?php foreach($role_list as $role){?>
							<option value="<?php echo $role['id'];?>" <?php if($user['role_id'] == $role['id']):?>selected<?php endif;?>>
								<?php echo $role['name'];?>
							</option>
							<?php };?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="col-label">email</td>
					<td><input type="text" name="email" class="txt" value="<?php echo $user['email']?>"></td>
				</tr>
				<tr>
					<td class="col-label">是否启用</td>
					<td>
						<label>
							<input type="checkbox" name="is_del" value="0" <?php if(!$user['is_del']):?>checked="checked"<?php endif;?>>启用
						</label>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?php echo $user['id'] ? '保存修改' : '新增管理员'?>" class="btn" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include $this->getTemplate('inc/footer.inc.php');?>