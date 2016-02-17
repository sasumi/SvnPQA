<?php
use Lite\Core\Router;
use function Lite\func\h;
include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu();?>
</div>
<div id="col-main">
	<form action="<?=$this->getUrl('BusinessOrder/addSample', array('id'=>$order->id));?>" class="frm" rel="async" method="post">
		<input type="hidden" name="business_order_id" value="<?php echo $order->id;?>">
		<table class="frm-tbl">
			<caption>添加样品</caption>
			<tbody>
			<tr>
				<td class="col-label">货号</td>
				<td>
					<input type="text" name="sample_no" class="txt" value="" id="sample_no" required="required">
					<input type="hidden" name="sample_id" value="">
					<span id="check-result"></span>
				</td>
			</tr>
			<tr>
				<td>样品图片</td>
				<td>
					<span id="img-list"></span>
				</td>
			</tr>
			<tr>
				<td class="col-label">包装方式</td>
				<td>
					<select name="sample_package_id" required="required"></select>
				</td>
			</tr>
			<tr>
				<td class="col-label">数量</td>
				<td>
					<input type="number" name="sample_num" class="txt" value="1"  step="1" min="1" required="required">
				</td>
			</tr>
			<tr>
				<td class="col-label">单价</td>
				<td>
					<input type="number" name="sample_unit_price" class="txt" value="0" step="0.01" min="0.01" required="required">
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="col-action">
					<input type="submit" value="添加" class="btn" disabled="disabled"/>
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
						var $p_sel = $('[name=sample_package_id]');
						$p_sel[0].options.length = 0;
						for(var i=0; i<rsp.data.package_list.length; i++){
							var p = rsp.data.package_list[i];
							$('<option value="'+ p.id+'">'+ p.pack_name+'</option>').appendTo($p_sel);
						}
					}
					$('input[type=submit]').attr('disabled', rsp.code != 0);
					$('#check-result').attr('class', 'fa '+(rsp.code == 0 ? 'fa-check' : 'fa-close')).show();
				});
			});
		})
	})
</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>