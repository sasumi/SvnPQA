<?php
use Lite\CRUD\ControllerInterface;
use Lite\CRUD\ModelInterface;
use Lite\DB\Model;
use www\ViewBase;
use function Lite\func\dump;
use function Lite\func\h;

/** @var ViewBase $this */
$operation_list = $this->getData('operation_list');
$search = $this->getData('search');
$display_fields = $this->getData('display_fields');
$data_list = $this->getData('data_list');
$defines = $this->getData('defines');
$quick_update_fields = $this->getData('quick_update_fields');
$paginate = $this->getData('paginate');

/** @var ModelInterface|Model $model_instance */
$pk = $model_instance->getPrimaryKey();
include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside"><?php echo $this->getSideMenu()?></div>
<div id="col-main">
	<?php if(in_array(ControllerInterface::OP_UPDATE, $this->getData('operation_list'))):?>
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl($this->getController().'/update');?>" class="btn" rel="popup">新增<?php echo $model_instance->getModelDesc();?></a>
	</div>
	<?php endif;?>

	<?php include $this->resolveTemplate('crud/quick_search.inc.php');?>

	<table class="data-tbl" data-empty-fill="1">
		<caption><?php echo $model_instance->getModelDesc();?>列表</caption>
		<thead>
		<tr>
			<?php foreach($display_fields as $field=>$alias):?>
			<th><?php echo h($alias);?></th>
			<?php endforeach;?>
			<th style="width:60px">操作</th>
		</tr>
		</thead>
		<tbody>
			<?php
			/** @var Model $item */
			foreach($data_list ?: array() as $item):?>
			<tr>
				<?php
				foreach($display_fields as $field=>$alias):
					$define = $defines[$field];
					$text = $item->$field;
					$html = $this->displayField($field, $item);
				?>
				<?php if(!in_array(ControllerInterface::OP_STATE, $operation_list) || $model_instance->getStateKey() != $field):?>
				<td>
					<?php if(in_array($field, $quick_update_fields)):?>
					<span rel="quick-update-block"
					      title="双击修改"
					      data-type="<?php echo $define['type'];?>"
					      data-val="<?php echo h($text);?>"
					      data-pk="<?php echo $item[$pk];?>"
					      data-field="<?php echo $field;?>">
						<?php echo h($text);?>
					</span>
					<?php else:
					echo $html;
					endif;?>
				</td>
				<?php else:?>
				<td style="width:100px">
					<?php echo $this->displayStateSwitcher($item);?>
				</td>
				<?php endif;?>

				<?php endforeach;?>
				<td>
					<?php
					$operation_link_list = $this->getData('operation_link_list') ?: array();
					if(in_array(ControllerInterface::OP_DELETE, $operation_list)){
						array_unshift($operation_link_list, '<a href="'.$this->getUrl($this->getController().'/delete', array($pk=>$item->$pk)).'" rel="async">删除</a>');
					}
					if(in_array(ControllerInterface::OP_UPDATE, $operation_list)){
						array_unshift($operation_link_list, '<a href="'.$this->getUrl($this->getController().'/update', array($pk=>$item->$pk)).'" rel="popup">修改</a>');
					}
					if(in_array(ControllerInterface::OP_INFO, $operation_list)){
						array_unshift($operation_link_list, '<a href="'.$this->getUrl($this->getController().'/info', array($pk=>$item->$pk)).'" rel="popup">详情</a>');
					}

					if(count($operation_link_list) == 1){
						echo $operation_link_list[0];
					}
					else if($operation_link_list){?>
					<dl class="drop-list drop-list-left">
						<dt>
							<?php
							$op = array_shift($operation_link_list);
							echo is_callable($op) ? call_user_func($op, $item) : $op;?>
						</dt>
						<dd>
							<?php
							foreach($operation_link_list as $op){
								echo is_callable($op) ? call_user_func($op, $item) : $op;
							}?>
						</dd>
					</dl>
					<?php }?>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<?php echo $paginate;?>
	<script>
		seajs.use(['jquery', 'jquery/hotkeys', 'ywj/popup', 'ywj/net', 'ywj/msg'], function($, _, Pop, Net, Msg){
			var DEFINES = <?php echo json_encode($defines);?>;
			var UPDATE_URL = '<?php echo $this->getUrl($this->getController().'/updateField');?>';

			$('[rel=quick-update-block]').each(function(){
				var $n = $(this);
				var type = $n.data('type');
				var field = $n.data('field');
				var pk_val = $n.data('pk');
				var init_value = $n.data('val'); //decode

				$n.dblclick(function(){
					var p;
					var html = '<span style="display:block; padding-bottom:5px">'+DEFINES[field].alias+'</span>';

					var update = function(val){
						Net.post(UPDATE_URL, {ref:'json', field:field, pk_val:pk_val, value:val}, function(rsp){
							Msg.show(rsp.message, rsp.code == 0 ? 'succ' : 'error');
							if(rsp.code == 0){
								p.close();
								location.reload();
							}
						});
					};

					switch(type){
						case 'string':
							html += '<input name="'+field+'" value="'+init_value+'" class="txt" style="width:96%"/>';
							break;

						case 'text':
							html += '<textarea name="'+field+'" class="txt" style="width:96%; min-height:50px; resize:vertical">'+init_value+'</textarea>';
							break;
					}

					p = new Pop({
						title: '更新',
						content: html,
						buttons: [
							{name:'保存', handler:function(){
								var val = $(':input', p.container).val();
								update(val);
							}},
							{name:'取消'}
						]
					});
					p.show();
					var $ip = $(':input',p.container);
					$ip.focus();
					$ip[0].select($ip[0]);

					$ip.bind('keydown', 'ctrl+return', function(){
						update($ip.val())
					});
				});
			});
		});
	</script>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>