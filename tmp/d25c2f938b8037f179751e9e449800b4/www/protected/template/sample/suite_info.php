<?php
use Lite\Core\Router;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use www\model\Sample;
use www\model\SampleMould;
use www\model\SamplePackage;
use function Lite\func\dump;
use function Lite\func\h;

/** @var ModelInterface|Model $model_instance */
include $this->resolveTemplate('inc/header.inc.php');

/** @var Sample $sample */
$sample = $this->getData('sample');
$defines = $sample->getPropertiesDefine();
$sample_list = $sample->sample_list;

$sample_image_list = $this->getData('sample_image_list');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<h2 class="caption">套件样品信息</h2>
	<div class="content-warp">
		<h3 class="caption">基本信息
			<a href="<?php echo $this->getUrl('Sample/update', array('id'=>$sample->id));?>" rel="popup">更新</a>
			<a href="<?php echo $this->getUrl('Sample/delete', array('id'=>$sample->id));?>" rel="async" data-confirm="确认删除该样品信息？">删除</a>
		</h3>

		<dl class="info-list">
			<?php $this->walkDisplayProperties(function($alias, $value, $field)use($sample){
				echo "<dt>$alias</dt>", "<dd>$value</dd>";
			}, $sample);?>
		</dl>

		<h3 class="caption">图片列表
			<a href="<?php echo $this->getUrl('SampleImage/update', array('sample_id'=>$sample->id));?>" rel="popup">新增</a>
		</h3>
		<?php if($sample_image_list):?>
		<ul class="image-thumb-list">
			<?php foreach($sample_image_list as $si):?>
				<li class="image-thumb">
					<?php echo $this->displayField('image_url', $si);?>
					<span data-flag="source">
						<a href="<?php echo $this->buildUploadImage($si->image_url);?>" target="_blank">查看原图</a> |
						<a href="<?php echo $this->buildUploadImage($si->image_url);?>" download="<?php echo $si->image_url;?>">下载</a>
					</span>
					<a href="<?php echo $this->getUrl('SampleImage/delete', array('id'=>$si->id));?>" data-flag="delete" rel="async" data-confirm="确定要删除该图片">删除</a>
				</li>
			<?php endforeach;?>
		</ul>
		<?php else:?>
		<div class="data-empty">没有图片</div>
		<?php endif;?>

		<h3 class="caption">单品列表 <a href="<?=$this->getUrl('Sample/searchSingleSample', array('id'=>$sample->id));?>" rel="popup-refresh">新增</a></h3>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
			<?php if($sample_list):?>
				<tr>
					<?php $this->walkDisplayProperties(function($alias, $value, $field){
						if($field != 'sample_id'){
							echo "<th>$alias</th>";
						}
					}, \Lite\func\array_first($sample_list));?>
					<th style="width:60px">操作</th>
				</tr>
			<?php endif;?>
			</thead>
			<tbody>
			<?php
			/** @var SampleMould $sample */
			foreach($sample_list as $item):?>
				<tr>
					<?php $this->walkDisplayProperties(function($alias, $value, $field){
						if($field != 'sample_id'){
							echo "<td>$value</td>";
						}
					}, $item)?>
					<td>
						<a href="<?php echo $this->getUrl('Sample/removeSingleSample', array('id'=>$sample->id, 'single_sample_id'=>$item->id));?>" rel="async">取消</a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>

		<h3 class="caption">包装方式
			<a href="<?php echo $this->getUrl('SamplePackage/update', array('sample_id'=>$sample->id));?>" rel="popup">新增</a>
		</h3>
		<?php
		/** @var SamplePackage $package */
		foreach($package_type_list as $package):?>
			<table class="info-tbl" data-empty-fill="1">
				<tbody>
				<tr>
					<th>包装方式</th>
					<td colspan="5">
						<strong><?php echo $this->displayField('pack_type', $package);?></strong>
					</td>
				</tr>
				<tr>
					<th>包装名称</th>
					<td colspan="5">
						<strong><?php echo $this->displayField('pack_name', $package);?></strong>
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
		<?php endforeach;?>
	</div>
</div>
<style>
	.content-warp { max-width:1000px;}
</style>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>