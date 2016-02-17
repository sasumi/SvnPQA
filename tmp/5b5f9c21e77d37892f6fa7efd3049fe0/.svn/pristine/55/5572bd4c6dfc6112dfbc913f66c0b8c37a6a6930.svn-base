<?php use Lite\Core\Router;
use function Lite\func\h;

include $this->resolveTemplate('inc/header.inc.php');
$current_controller = Router::getController();
?>
<div id="col-aside">
	<?php echo $this->getSideMenu();?>
</div>
<div id="col-main">
	<form action="<?=$this->getUrl($current_controller.'/update', array('id'=>$order->id));?>" class="frm" rel="async" method="post">
		<table class="frm-tbl">
			<caption><?php echo $order->id ? '更新' : '新增';?>样品工价</caption>
			<tbody>
			<tr>
				<td class="col-label">订单类型</td>
				<td>
					<?php foreach($order_type_list as $key=>$type): ?>
						<label>
							<input type="radio" name="order_type" <?php echo $key==$order->order_type ? 'checked': ''?> value="<?php echo $key;?>" required="required"/>
							<?php echo $type;?>
						</label>
					<?php endforeach;?>
				</td>
			</tr>
			<tr>
				<td class="col-label">公司名称</td>
				<td>
					<select name="customer_id" id="customer_id" required="required">
						<option value="">请选择公司</option>
						<?php foreach($default_customer_list as $customer):?>
							<option value="<?php echo $customer->id;?>" <?php echo $customer->id == $order->customer_id ? 'selected':'';?>>
								<?php echo $customer->company_alias_name;?>
							</option>
						<?php endforeach;?>
					</select>
					<input type="text" class="txt" name="customer_name" id="customer_name" value="" placeholder="输入进行搜索">
				</td>
			</tr>
			<tr>
				<td class="col-label">联系人</td>
				<td>
					<select name="customer_contact_id" id="customer_contact_id" required="required">
						<option value="">请选择联系人</option>
						<?php foreach($default_customer_contact_list as $customer_contact):?>
							<option value="<?php echo $customer_contact->id;?>"  data-tel = '<?php echo $customer_contact->tel;?>' data-email = '<?php echo $customer_contact->email ;?>'
								<?php echo $customer_contact->custmomer_contact_id == $order->custmomer_contact_id ? 'selected':'';?>>
								<?php echo $customer_contact->chinese_name;?>
							</option>
						<?php endforeach;?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="col-label">联系人电话</td>
				<td>
					<input type="text" class="txt" name="tel" readonly="readonly">
				</td>
			</tr>
			<tr>
				<td class="col-label">邮件地址</td>
				<td>
					<input type="text" class="txt" name="email" readonly="readonly">
				</td>
			</tr>
			<tr>
				<td class="col-label">FOB</td>
				<td>
					<input type="text" class="txt" name="fob" value="<?php echo $order->fob;?>" >
					<span class="frm-field-desc">(外贸)</span>
				</td>
			</tr>
			<tr>
				<td class="col-label">目的港</td>
				<td>
					<input type="text" name="destination_port" class="txt" value="<?php echo $order->destination_port;?>" >
					<span class="frm-field-desc">(外贸、内贸为交货地)</span>
				</td>
			</tr>
			<tr>
				<td class="col-label">付款方式</td>
				<td>
					<select name="pay_type_id" required="required">
						<option value="">请选择付款方式</option>
						<?php foreach($pay_type_list as $type):?>
							<option value="<?php echo $type->id;?>" <?php echo $type->id == $order->pay_type_id ? 'selected':'';?>>
								<?php echo $type->name;?>
							</option>
						<?php endforeach;?>
					</select>
					<span class="frm-field-desc">(外贸、内贸)</span>
				</td>
			</tr>
			<tr>
				<td class="col-label">交货期</td>
				<td>
					<input type="text" name="delivery_date" class="txt date-txt" value="<?php echo $order->delivery_date;?>">
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="col-action">
					<input type="submit" value="<?= $order->id ? '保存修改' : '新增'?>" class="btn" />
				</td>
			</tr>
			</tbody>
		</table>
	</form>
</div>

<script>
	seajs.use(['jquery'], function ($) {
		var $customer_id = $("#customer_id");
		var $contact_id = $('#customer_contact_id');

		$("#customer_name").on('input', function (e) {
			var customer_name = $(this).val();
			$.getJSON("<?php echo $this->getUrl('Customer/ajaxSearchCustomerList')?>",
				{search_text: customer_name},
				function (result) {
					var selOpt = $("option", $customer_id);
					selOpt.remove();

					var selObj = $customer_id;
					for (var i = 0; i < result.length; i++) {
						selObj.append("<option value='" + result[i].id + "'>" + result[i].company_alias_name + "</option>");
					}

					if(result.length < 1){
						selObj.append("<option value='0'>暂无符合条件的查询</option>");
					}

					$customer_id.trigger('change');
				});
		});

		$customer_id.change(function(e){
			var customer_id =  $customer_id.val();

			//清空
			var selOpt = $("option", $contact_id);
			selOpt.remove();

			$.getJSON("<?php echo $this->getUrl('CustomerContact/ajaxGetCustomerConTactList')?>",
				{customer_id: customer_id},
				function (result) {
					var selOpt = $("option", $contact_id);
					selOpt.remove();

					var selObj = $contact_id;
					for (var i = 0; i < result.length; i++) {
						selObj.append("<option value='" + result[i].id + "' tel = '"+result[i].tel+"' email = '"+result[i].email+"'>" + result[i].chinese_name + "</option>");
					}

					if(result.length < 1){
						selObj.append("<option value='0'>暂无符合条件的查询</option>");
					}

					$("#customer_contact_id").trigger('change');
				});
		});

		$contact_id.change(function(){
			var tel = $contact_id.find("option:selected").attr("tel");
			var email = $contact_id.find("option:selected").attr("email");

			//电话 邮件
			$('input[name="tel"]').val(tel);
			$('input[name="email"]').val(email);
		});

		$customer_id.trigger('change');
	});
</script>

<?php include $this->resolveTemplate('inc/footer.inc.php');?>