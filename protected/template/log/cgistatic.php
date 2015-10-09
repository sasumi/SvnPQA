<?php use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('log/cgiStatic');?>" class="search-frm well">
		<div class="frm-item">
			<label>
				TAG过滤：
				<input type="text" class="txt" name="tag" value="<?php echo $search['tag'];?>"/>
			</label>
		</div>
		<div class="frm-item">
			<label>
				关键字：
				<input type="text" class="txt" name="kw" value="<?php echo $search['kw'];?>"/>
			</label>
		</div>
		<div class="frm-item">
			<label>
				最小运行时间(毫秒)：
				<input type="number" class="txt" name="min_run_time" min="0" step="100" value="<?php echo $search['min_run_time'];?>"/>
			</label>
		</div>
		<div class="frm-item">
			<label>
				时间：
				<input type="text" name="start_time" value="<?php echo date('Y-m-d H:i:s',$search['start_time'])?>" class="txt date-time-txt" /> 至
				<input type="text" name="end_time" value="<?php echo date('Y-m-d H:i:s',$search['end_time'])?>" class="txt date-time-txt" />
			</label>
		</div>
		<div class="frm-item">
			<input type="submit" value="检索" class="btn" />
			<a href="<?php echo $this->getUrl('log/cgiStatic');?>">重置搜索</a>
		</div>
	</form>
	<table class="data-tbl" data-empty-fill="1">
		<thead>
		<tr>
			<th>请求地址</th>
			<th>参数</th>
			<th>客户端IP</th>
			<th>发起文件</th>
			<th>发起行数</th>
			<th>运行时间</th>
			<th style="width:130px;">创建时间</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($log_list as $one):?>
			<tr class="<?php echo $one['css_class'];?>">
				<td>
					<div style="max-width:500px; word-break:break-all">
						<?php echo h(trim($one['request_url']));?>
					</div>
				</td>
				<td><?php echo h($one['params']);?></td>
				<td><?php echo h($one['client_ip']);?></td>
				<td>
					<div style="max-width:500px; word-break:break-all">
					<?php echo h($one['locate_file']);?>
					</div>
				</td>
				<td><?php echo $one['locate_line'];?></td>
				<td>
					<span class="<?php echo $one['label_class'];?>">
						<?php echo $one['run_time'];?>
					</span>
				</td>
				<td><?php echo date('Y-m-d H:i:s',$one['create_time']);?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $page;?>
</div>
<?php include $this->getTemplate('inc/footer.inc.php'); ?>