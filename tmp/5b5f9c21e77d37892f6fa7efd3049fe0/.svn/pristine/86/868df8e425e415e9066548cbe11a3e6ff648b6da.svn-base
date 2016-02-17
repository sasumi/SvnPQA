<?php
use www\model\GlobalConf;
use www\model\Sample;
use www\model\SingleSample;
use www\ViewBase;
use function Lite\func\dump;
use function Lite\func\h;

/** @var Sample $sample */
include $this->resolveTemplate('inc/header.inc.php');
$tmp_single = SingleSample::meta();
$single_defines = $tmp_single->getPropertiesDefine();
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('Sample/quickAddSample');?>" class="frm" rel="async" method="post" onsuccess="onsuccess">
		<table class="frm-tbl">
			<caption><?php echo $sample->id? '更新' : '新增'?>样品</caption>
			<tbody>
				<tr>
					<td class="col-label">类型</td>
					<td>
						<label><input type="radio" name="sample_type" value="<?php echo GlobalConf::SAMPLE_TYPE_SINGLE;?>" checked="checked">单件</label>
						<label><input type="radio" name="sample_type" value="<?php echo GlobalConf::SAMPLE_TYPE_SUITE;?>">套件</label>
					</td>
				</tr>
				<tr id="work-flow-wrap">
					<td class="col-label">
						工艺流程
					</td>
					<td>
						<?php echo ViewBase::renderFormElement($tmp_single->technic_flow_id_list, 'technic_flow_id_list', $single_defines['technic_flow_id_list'], $tmp_single)?>
					</td>
				</tr>
				<tr>
					<td class="col-label">分类</td>
					<td>
						<select name="category_id">
							<?php foreach($category_list as $id=>$n):?>
							<option value="<?php echo $id;?>"><?php echo $n;?></option>
							<?php endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="col-label">材质</td>
					<td>
						<select name="material_id">
							<?php foreach($material_list as $m):?>
							<option value="<?php echo $m->id;?>"><?php echo $m->name;?></option>
							<?php endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="col-label">货号</td>
					<td>
						<input type="text" name="sample_no" class="txt">
					</td>
				</tr>
				<tr>
					<td class="col-label">中文名称</td>
					<td>
						<input type="text" name="chinese_name" class="txt">
					</td>
				</tr>
				<tr>
					<td class="col-label">包装名称</td>
					<td>
						<input type="text" name="pack_name" class="txt">
					</td>
				</tr>
				<tr>
					<td class="col-label">包装说明</td>
					<td>
						<textarea name="pack_desc" cols="30" rows="10" class="txt small-txt"></textarea>
					</td>
				</tr>
				<tr>
					<td class="col-label">照片</td>
					<td>
						<input type="hidden" name="image_url" value="" rel="upload-image"/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="新增" class="btn" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
	<script>
		seajs.use(['jquery', 'ywj/popup'], function($, Pop){
			var TYPE_SINGLE = <?php echo GlobalConf::SAMPLE_TYPE_SINGLE;?>;
			window.onsuccess = function(rsp){
				Pop.fire('onSuccess', rsp.data);
				Pop.closeCurrentPopup();
			}

			$('input[name=sample_type]').change(function(){
				$('#work-flow-wrap')[this.value == TYPE_SINGLE ? 'show' : 'hide']();
			});
		});
	</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>