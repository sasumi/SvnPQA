<?php
use www\model\SampleProduceOrderMapSamples;
use function Lite\func\dump;
use function Lite\func\h;

/** @var SampleProduceOrderMapSamples $model_instance */
include $this->resolveTemplate('inc/header.inc.php');
$pk = $model_instance->getPrimaryKey();
$extra_params = $this->getData('extra_params');
$update_fields = $this->getData('update_fields');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl($this->getController().'/update', array($pk=>$model_instance->$pk));?>" class="frm" rel="async" method="post">
		<input type="hidden" name="sample_produce_id" value="<?php echo $model_instance->sample_produce_id;?>">
		<?php foreach($extra_params as $k=>$v):?>
		<input type="hidden" name="<?php echo h($k); ?>" value="<?php echo h($v);?>">
		<?php endforeach;?>

		<table class="frm-tbl">
			<caption><?php echo $model_instance->$pk? '更新' : '新增'?><?php echo $model_instance->getModelDesc();?></caption>
			<tbody>
				<tr>
					<td class="col-label">
						产品货号
					</td>
					<td>
						<input type="text" id="sample_no" class="txt" value="<?php echo $model_instance->sample_no;?>">
						<input type="hidden" name="sample_id" value="<?php echo $model_instance->sample_id;?>">
						<span id="check-result"></span>
						<a href="javascript:void(0);" id="add-new-sample-btn">新增样品</a>
					</td>
				</tr>
				<tr>
					<td class="col-label">产品图片</td>
					<td id="img-list">
					</td>
				</tr>
				<tr>
					<td class="col-label">数量</td>
					<td>
						<input type="number" name="produce_num" required="required" class="txt" value="<?php echo $model_instance->produce_num;?>" min="1">
					</td>
				</tr>
				<tr>
					<td class="col-label">生产要求</td>
					<td>
						<textarea name="produce_request" class="txt"><?php echo $model_instance->produce_request;?></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?php echo $model_instance->$pk? '保存修改' : '新增'?>" class="btn" disabled="disabled"/>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<style>
	.fa-check {color:green;}
	.fa-close {color:orange}
	.image-thumb {width:80px; height:80px; float:left; margin:0 10px 10px 0;}
</style>
<script>
	seajs.use(['jquery', 'ywj/net'], function($, net){
		var req = null;
		var _sending = false;
		$.each(['blur', 'change', 'keyup'], function(k, ev){
			$('#check-result').hide();
			$('#sample_no')[ev](function(){
				if(_sending){
					return;
				}
				_sending = true;
				if(req){
					req.abort();
				}
				req = net.get('<?php echo $this->getUrl('Sample/getSampleInfoByNo');?>', {no: this.value}, function(rsp){
					_sending = false;
					if(rsp.code == 0){
						$('[name=sample_id]').val(rsp.data.sample_id);
						$('#img-list').html('');
						for(var i=0; i<rsp.data.image_list.length; i++){
							var img = rsp.data.image_list[i].image_url;
							$('<span class="image-thumb"><img src="'+img+'" onload="(function(img){window.__img_adjust__ &&　__img_adjust__(img);})(this)"/></span>').appendTo("#img-list");
						}
					}
					$('input[type=submit]').attr('disabled', rsp.code != 0);
					$('#check-result').attr('class', 'fa '+(rsp.code == 0 ? 'fa-check' : 'fa-close')).show();
				});
			});
		});
		$('#sample_no').trigger('change');

		$('#add-new-sample-btn').click(function(){
			parent.addSample(function(sample_no){
				$('#sample_no').val(sample_no).trigger('change');
			});
			return false;
		});
	})
</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>