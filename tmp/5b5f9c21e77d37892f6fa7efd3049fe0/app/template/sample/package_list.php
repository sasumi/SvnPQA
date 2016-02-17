<?php use www\model\SamplePackage; ?>
<h3 class="caption">包装方式
	<a href="<?php echo $this->getUrl('SamplePackage/update', array('sample_id'=>$sample->id));?>" rel="popup">新增</a>
</h3>
<?php
/** @var SamplePackage $package */
foreach($package_type_list as $package):?>
<table class="info-tbl package-info" data-empty-fill="1">
	<tbody>
	<tr>
		<th>包装名称</th>
		<td colspan="5">
			<strong><?php echo $this->displayField('pack_name', $package);?></strong>
			<div class="op">
				<a href="<?php echo $this->getUrl('SamplePackage/update', array('id'=>$package->id));?>" rel="popup">编辑</a>
				<a href="<?php echo $this->getUrl('SamplePackage/delete', array('id'=>$package->id));?>" rel="async" data-confirm="确认要删除该项包装？">删除</a>
			</div>
		</td>
	</tr>
	<tr>
		<th>包装说明</th>
		<td colspan="5"><?php echo $package->pack_desc;?></td>
	</tr>
	<tr>
		<th>内盒尺寸</th>
		<td><?php echo $package->inner_box_length,' x ',$package->inner_box_width,' x ',$package->inner_box_height;?></td>
		<th>内盒材质</th>
		<td><?php echo $this->displayField('inner_box_material_type', $package);?></td>
		<th>内盒隔板横向 x 竖向数量</th>
		<td><?php echo $package->inner_box_clapboard_transverse_num.' x '.$package->inner_box_clapboard_vertical_num;?></td>
	</tr>
	<tr>
		<th>外箱摆放</th>
		<td><?php echo $package->outer_box_place_left_right,' x ',$package->outer_box_place_front_back,' x ',$package->outer_box_place_up_down;?></td>
		<th>外箱尺寸</th>
		<td><?php echo $package->outer_box_length,' x ',$package->outer_box_width,' x ',$package->outer_box_height;?></td>
		<th>外箱材质</th>
		<td><?php echo $this->displayField('outer_box_material_type',$package);?></td>
	</tr>
	<tr>
		<th>包装率</th>
		<td><?php echo $package->pack_percent;?></td>
		<th>净重</th>
		<td colspan="3"><?php echo $package->weight;?></td>
	</tr>
	</tbody>
</table>
<style>
	.package-info .op {float:right;}
</style>
<?php endforeach;?>