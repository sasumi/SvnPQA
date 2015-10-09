<?php use SvnPQA\ViewBase;

include $this->getTemplate('inc/header.inc.php');?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('log/logStatic');?>" class="search-frm well">
		<div class="frm-item">
			<label>
				LOG级别：
				<select name="level">
					<?php foreach($level_map as $lev=>$name):?>
						<option value="<?php echo $lev;?>" <?php echo $search['level'] == $lev ? 'selected' : '';?>><?php echo $name;?></option>
					<?php endforeach;?>
				</select>
			</label>
		</div>
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
				时间：
				<input type="text" name="start_time" value="<?php echo $search['start_time']?>" class="txt date-txt" /> 至
				<input type="text" name="end_time" value="<?php echo $search['end_time']?>" class="txt date-txt" />
			</label>
		</div>
		<div class="frm-item">
			<input type="submit" value="检索" class="btn" />
			<a href="<?php echo $this->getUrl('log/logStatic');?>">重置搜索</a>
		</div>
	</form>
	<table class="data-tbl" data-empty-fill="1">
		<thead>
		<tr>
			<th>级别</th>
			<th>tag</th>
			<th>文件</th>
			<th>行数</th>
			<th>log内容</th>
			<th style="width:130px;">时间</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($log_list as $one):?>
			<tr class="<?php echo $one['css_class'];?>">
				<td>
					<span class="<?php echo $one['label_class'];?>">
						<?php echo $one['level_txt'];?>
					</span>
				</td>
				<td><?php echo $one['tag'];?></td>
				<td><?php echo $one['file'];?></td>
				<td><?php echo $one['line'];?></td>
				<td title="<?php echo htmlspecialchars($one['content']);?>" ondblclick="alert(this.title);"><?php echo htmlspecialchars($one['content_less']);?></td>
				<td><?php echo $one['datetime'];?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $page;?>
</div>
<?php include $this->getTemplate('inc/footer.inc.php'); ?>