<?php
use Lite\Core\Router;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use www\model\Sample;
use www\model\SampleMould;
use www\model\SampleTechnic;
use www\ViewBase;
use function Lite\func\array_first;
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
	<h2 class="caption">单件样品信息<a href="<?php echo $this->getUrl('Sample');?>">返回列表</a></h2>
	<div class="content-fix-width">
		<?php include 'image_list.php';?>

		<h3 class="caption">基本信息
			<a href="<?php echo $this->getUrl('Sample/update', array('id'=>$sample->id));?>" rel="popup">更新</a>
			<a href="<?php echo $this->getUrl('Sample/delete', array('id'=>$sample->id));?>" rel="async" data-confirm="确认删除该样品信息？">删除</a>
		</h3>
		<dl class="info-list">
			<?php
			$this->walkDisplayProperties(function($alias, $value, $field)use($sample){
				if($field == 'state'){
					$value = $this->displayColorState($sample, $field);
				}
				if($field != 'technic_flow_id_list'){
					echo "<dt>$alias</dt>", "<dd>$value</dd>";
				}
			}, $sample);
			?>
		</dl>
		<dl class="info-list">
			<?php
			$this->walkDisplayProperties(function($alias, $value, $field){
				if(!in_array($field, array('sample_id', 'technic_flow_id_list', 'length', 'width', 'height'))){
					echo "<dt>$alias</dt>", "<dd>$value</dd>";
				}
			}, $sample->extend_info);
			?>
			<dt>尺寸</dt>
			<dd><?php echo $sample->extend_info->length,' x ', $sample->extend_info->width, ' x ', $sample->extend_info->height;?></dd>
		</dl>

		<h3 class="caption">
			流程工艺
			<a href="<?php echo $this->getUrl('Sample/update', array('id'=>$sample->id));?>" rel="popup">更新</a>
		</h3>
		<div class="technic_flow">
			<?php echo $this->displayField('technic_flow_id_list', $sample->extend_info);?>
		</div>

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

		<h3 class="caption">生产数据
			<a href="<?php echo $this->getUrl('SampleProduceData/update', array('sample_id'=>$sample->id, 'id'=>$sample->produce_data->id));?>" rel="popup">更新</a>
		</h3>
		<table class="info-tbl" data-empty-fill="1">
			<tbody>
			<?php $this->walkDisplayProperties(function($alias, $val, $field){
				if($field != 'sample_id'){
					echo "<tr><th>$alias</th><td>$val</td></tr>";
				}
			}, $sample->produce_data)?>
			</tbody>
		</table>

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
					}, array_first($mould_list))?>
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
		<?php include 'package_list.php';?>
	</div>
</div>
<style>
	.technic_flow {margin-bottom:10px; padding:10px; background-color:white; border:1px solid #ddd; box-shadow:0px 0px 3px #DADADA}
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