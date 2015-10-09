<?php use SvnPQA\ViewBase;
include $this->getTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl('user/update');?>" class="btn" rel="popup">新增用户</a>
	</div>
	<form class="search-frm well" action="<?php echo $this->getUrl('user');?>" method="get">
		<div class="frm-item">
			<label>
				<input class="txt" type="text" name="kw" value="<?php echo $search['kw'];?>" placeholder="关键字"/>
			</label>
		</div>
		<div class="frm-item">
			<input class="btn" type="submit" value="查询"/>
			<a href="<?=$this->getUrl('user');?>" class="btn">重置</a>
		</div>
	</form>
	<table class="data-tbl" data-empty-fill="1">
		<caption>用户列表</caption>
		<thead>
		<tr>
			<th>用户名</th>
			<th>真实名称</th>
			<th style="width:130px;">最后登录时间</th>
			<th style="width:130px;">最后登录IP</th>
			<th style="width:130px;">创建时间</th>
			<th style="width:130px;">更新时间</th>
			<th style="width:30px">状态</th>
			<th style="width:60px">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($user_list?:array() as $user):?>
			<tr>
				<td><?php echo $user->name;?></td>
				<td><?php echo $user->real_name;?></td>
				<td><?php echo $user->last_login_time ? date('Y-m-d H:i:s',$user->last_login_time):'';?></td>
				<td><?php echo $user->last_login_ip ? date('Y-m-d H:i:s',$user->last_login_ip):'';?></td>
				<td><?php echo $user->create_time ? date('Y-m-d H:i:s',$user->create_time):'';?></td>
				<td><?php echo $user->update_time ? date('Y-m-d H:i:s',$user->update_time):'';?></td>
				<td><?php echo $user->state_text;?></td>
				<td>
					<a href="<?php echo $this->getUrl('user/state', array('state'=>$user->state, 'id'=>$user->id));?>">禁用</a>
					<a href="<?php echo $this->getUrl('user/update', array('id'=>$user->id));?>" rel="popup">更新</a>
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $paginate; ?>
</div>
<?php include $this->getTemplate('inc/footer.inc.php');?>