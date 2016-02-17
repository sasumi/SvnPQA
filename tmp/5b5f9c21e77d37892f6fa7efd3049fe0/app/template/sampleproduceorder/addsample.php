<?php
use Lite\DB\Model;
use www\model\SampleProduceOrder;
use www\ViewBase;
use function Lite\func\array_group;
use function Lite\func\dump;
use function Lite\func\h;

/**
 * @var SampleProduceOrder $order
 * @var ViewBase $this
 */
include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu()?>
</div>
<div id="col-main">
	<form action="<?php echo $this->getUrl('SampleProduceOrder/addSample',  array('id'=>$order->id));?>" class="frm" rel="async" method="post">
		<table class="frm-tbl">
			<caption>添加样品</caption>
			<tbody>
				<tr>
					<td class="col-label">样品单号</td>
					<td>
						<input type="text" name="sample_no" class="txt">
					</td>
				</tr>
				<tr>
					<td class="col-label">客户</td>
					<td>
						<select name="customer_id" required="required">
							<option value="">请选择客户</option>
							<?php foreach($customer_list as $cus):?>
								<option value="<?php echo $cus->id;?>" <?php echo $cus->id == $order->contact->customer_id ? 'selected':'';?>>
									<?php echo $cus->company_alias_name;?>
								</option>
							<?php endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="col-label">联系人</td>
					<td>
						<select name="contact_id" required="required">
							<?php foreach($current_contact_list as $ct):?>
								<option value=""><?php echo $ct->chinese_name;?></option>
							<?php endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="col-label">地址</td>
					<td>
						<span id="address"></span>
					</td>
				</tr>
				<?php
				$this->walkDisplayProperties(function($alias, $val, $field)use($defines, $order){
					if(!in_array($field, array('order_no', 'contact_id', 'create_time'))){
						echo '<tr>';
						echo '<td class="col-label">'.$alias.'</td>';
						echo '<td>'.$this->renderFormElement($order->$field, $field, $defines[$field], $order).'</td>';
						echo '</tr>';
					}
				}, $order);
				?>
				<tr>
					<td></td>
					<td class="col-action">
						<input type="submit" value="<?php echo $order->id? '保存修改' : '新增'?>" class="btn" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<script>
		seajs.use('jquery', function($){
			var CUSTOMER_LIST = <?php echo json_encode(array_group(Model::convertObjectListToArray($customer_list), 'id', true));?>;
			var ALL_CONTACT_LIST = <?php echo json_encode($all_contact_list);?>;
			var $CUS_SEL = $('[name=customer_id]');
			var $CONT_SEL = $('[name=contact_id]');

			$CUS_SEL.change(function(){
				$CONT_SEL[0].options.length = 0;
				$('#address').html('-');
				if(this.value){
					var contact_list = ALL_CONTACT_LIST[this.value];
					var CURRENT_CUS = CUSTOMER_LIST[this.value];

					$.each(contact_list, function(){
						$('<option value="'+this.id+'">'+this.chinese_name+'</option>').appendTo($CONT_SEL);
					});
					$('#address').html(CURRENT_CUS.address);
				}
			}).trigger('change');
		});
	</script>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>
