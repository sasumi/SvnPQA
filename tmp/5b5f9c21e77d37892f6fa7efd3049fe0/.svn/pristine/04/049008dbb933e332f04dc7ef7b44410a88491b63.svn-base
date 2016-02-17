<?php
use Lite\Core\Router;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use www\model\Sample;
use www\model\SampleImage;
use www\model\SampleMould;
use www\model\SamplePackage;
use www\model\SampleTechnic;
use www\ViewBase;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * @var ViewBase $this
 * @var ModelInterface|Model $model_instance
 * @var Sample $sample
 */
include $this->resolveTemplate('inc/header.inc.php');
$sample = $this->getData('sample');
$defines = $sample->getPropertiesDefine();
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<script>
	var copy_to_clipboard = function(text){
		var span = document.createElement('span');
		span.style.cssText = 'display:block; position:absolute; left:-9999em;';
		span.innerText = text;

		var body = document.getElementsByTagName('body')[0];
		body.appendChild(span);
		var range = document.createRange();
		range.selectNode(span);
		window.getSelection().addRange(range);
		var success = false;
		try {
			success = document.execCommand('copy');
		} catch(err) {
			console.log('Oops, unable to copy', err);
		}
		span.parentNode.removeChild(span);
		window.getSelection().removeAllRanges();
		return success;
	};
</script>
<div id="col-main">
	<h2 class="caption">单件样品信息</h2>
	<div class="content-warp">
		<h3 class="caption">基本信息
			<a href="<?php echo $this->getUrl('Sample/update', array('id'=>$sample->id));?>" rel="popup">更新</a>
			<a href="<?php echo $this->getUrl('Sample/delete', array('id'=>$sample->id));?>" rel="async" data-confirm="确认删除该样品信息？">删除</a>
		</h3>
		<dl class="info-list">
			<?php
			$this->walkDisplayProperties(function($alias, $value, $field){
				echo "<dt>$alias</dt>", "<dd>$value</dd>";
			}, $sample);
			$this->walkDisplayProperties(function($alias, $value, $field){
				if($field != 'sample_id'){
					echo "<dt>$alias</dt>", "<dd>$value</dd>";
				}
			}, $sample->extend_info);
			?>
		</dl>

		<?php
		$flow_str = $sample->extend_info->technic_flow_id_list;
		if($flow_str):
		$flows = SampleTechnic::findByFlowIdList($sample->id, explode(',', $flow_str));
		?>
		<h3 class="caption">工艺备注</h3>
		<table class="info-tbl" data-empty-fill="1">
			<tbody>
				<?php
				foreach($flows as $id=>list($comment, $name)){
				?>
				<tr>
					<th><?php echo $name;?></th>
					<td class="tc-state-normal">
						<span class="tc-comment">
							<?php echo $comment ?: '<span style="color:#ccc">空</span>';?>
						</span>
						<input type="text" name="comment" class="txt" value="<?php echo h($comment);?>" data-single-sample-id="<?php echo $sample->id;?>" data-flow-id="<?php echo $id;?>">
						<a href="javascript:void(0);" rel="edit-tc">编辑</a>
						<a href="javascript:void(0);" rel="save-tc">保存</a>
						<a href="javascript:void(0);" rel="cancel-edit-tc">取消</a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
		<?php endif;?>

		<h3 class="caption">图片列表
			<a href="<?php echo $this->getUrl('SampleImage/update', array('sample_id'=>$sample->id));?>" rel="popup">新增</a>
		</h3>
		<?php if($sample_image_list):?>
		<ul class="image-thumb-list">
			<?php
			/** @var SampleImage $si */
			foreach($sample_image_list as $si):?>
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

		<h3 class="caption">模具 <a href="<?=$this->getUrl('SampleMould/update', array('sample_id'=>$sample->id));?>" rel="popup">新增</a></h3>
		<table class="data-tbl" data-empty-fill="1">
			<thead>
			<?php
			/** @var SampleMould $mould */
			if($mould_list):?>
				<tr>
					<?php $this->walkDisplayProperties(function($alias, $value, $field){
						if($field != 'sample_id'){
							echo "<th>$alias</th>";
						}
					}, \Lite\func\array_first($mould_list))?>
					<th style="width:60px">操作</th>
				</tr>
			<?php endif;?>
			</thead>
			<tbody>
			<?php
			/** @var SampleMould $mould */
			foreach($mould_list as $mould):?>
				<tr>
					<?php $this->walkDisplayProperties(function($alias, $value, $field){
						if($field != 'sample_id'){
							echo "<td>$value</td>";
						}
					}, $mould)?>
					<td>
						<a href="<?php echo $this->getUrl('SampleMould/update', array('id'=>$mould->id));?>" rel="popup">编辑</a>
						<a href="<?php echo $this->getUrl('SampleMould/delete', array('id'=>$mould->id));?>" rel="async">删除</a>
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
			<table class="info-tbl package-info" data-empty-fill="1">
				<tbody>
				<tr>
					<th>包装方式</th>
					<td colspan="5">
						<strong><?php echo $this->displayField('pack_type', $package);?></strong>
						<div class="op">
							<a href="<?php echo $this->getUrl('SamplePackage/update', array('id'=>$package->id));?>" rel="popup">编辑</a>
							<a href="<?php echo $this->getUrl('SamplePackage/delete', array('id'=>$package->id));?>" rel="async" data-confirm="确认要删除该项包装？">删除</a>
						</div>
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
	.package-info .op {float:right;}
	.tc-state-normal input,
	.tc-state-normal [rel=save-tc],
	.tc-state-normal [rel=cancel-edit-tc] {display:none}

	.tc-state-edit [rel=edit-tc],
	.tc-state-edit .tc-comment{display:none;}
</style>
	<script>
		seajs.use(['jquery', 'ywj/net', 'ywj/msg'], function($, net, Msg){
			var URL = '<?php echo $this->getUrl('SampleTechnic/fill');?>';
			var $body = $('body');
			$body.delegate('[rel=edit-tc]', 'click', function(){
				$(this).parent().attr('class', 'tc-state-edit');
				$(this).parent().find('input')[0].focus();
				return false;
			});
			$body.delegate('[rel=cancel-edit-tc]', 'click', function(){
				$(this).parent().attr('class', 'tc-state-normal');
				return false;
			});
			$body.delegate('[rel=save-tc]', 'click', function(){
				var $inp = $(this).parent().find('input');
				var sample_id = $inp.data('single-sample-id');
				var flow_id = $inp.data('flow-id');
				var comment = $inp.val();
				net.post(URL, {sample_id:sample_id, flow_id:flow_id, comment:comment}, function(rsp){
					if(rsp.code == 0){
						Msg.show(rsp.message, 'succ');
						setTimeout(function(){
							location.reload();
						}, 1000);
					} else {
						Msg.show(rsp.message, 'error')
					}
				});
				return false;
			});
		});
	</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>