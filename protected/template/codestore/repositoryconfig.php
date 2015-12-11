<?php use SvnPQA\ViewBase;
include $this->resolveTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
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
<?php include $this->resolveTemplate('inc/footer.inc.php');?>