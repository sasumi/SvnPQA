<?php use SvnPQA\ViewBase;
include $this->getTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl('config/update');?>" class="btn" rel="popup">新增配置</a>
	</div>
	<form class="search-frm well" action="<?php echo $this->getUrl('config');?>" method="get">
		<div class="frm-item">
			<label>
				<input class="txt" type="text" name="kw" value="<?php echo $search['kw'];?>" placeholder="关键字"/>
			</label>
		</div>
		<div class="frm-item">
			<input class="btn" type="submit" value="查询"/>
			<a href="<?=$this->getUrl('config');?>" class="btn">重置</a>
		</div>
	</form>
	<table class="data-tbl" data-empty-fill="1">
		<caption>配置列表</caption>
		<thead>
		<tr>
			<th>配置名</th>
			<th>配置值</th>
			<th style="width:30px">状态</th>
			<th style="width:60px">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($config_list?:array() as $config):?>
			<tr>
				<td><?php echo $config->name;?></td>
				<td><?php echo $config->state_text;?></td>
				<td>
					<a href="<?php echo $this->getUrl('config/state', array('state'=>$config->state, 'id'=>$config->id));?>">禁用</a>
					<a href="<?php echo $this->getUrl('config/update', array('id'=>$config->id));?>" rel="popup">更新</a>
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $paginate; ?>
</div>
<?php include $this->getTemplate('inc/footer.inc.php');?>