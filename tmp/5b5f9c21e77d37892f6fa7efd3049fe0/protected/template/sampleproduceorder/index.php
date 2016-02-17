<?php
use Lite\Core\Router;
use www\ViewBase;
use function Lite\func\h;

/** @var ViewBase $this */
include $this->resolveTemplate('inc/header.inc.php');
$display_fields = $this->getData('display_fields');
?>
<div id="col-aside">
	<?php echo $this->getSideMenu();?>
</div>
<div id="col-main">
	<div class="operate-bar">
		<a href="<?php echo $this->getUrl('SampleProduceOrder/update')?>" class="btn" rel="popup">新增样品生产单</a>
	</div>

	<table class="data-tbl">
		<caption>样品生产单</caption>
		<thead>
			<?php foreach($display_fields as $field=>$alias):if($field != 'state'):?>
			<th><?php echo h($alias);?></th>
			<?php endif;endforeach;?>
			<th style="width:50px">状态</th>
			<th style="width:30px">操作</th>
		</thead>
		<tbody>
			<?php
			$fields = array_keys($display_fields);
			foreach($data_list as $item){
				echo "<tr>";
				$this->walkDisplayProperties(function($alias, $value, $field){
					if($field != 'state'){
						echo "<td>$value</td>";
					}
				}, $item, $fields);
				$v = $this->getUrl('SampleProduceOrder/info', array('id'=>$item->id));
				echo "<td>",$this->displayStateSwitcher($item)."</td>",
					"<td><a href=\"$v\">查看</a></td>",
					"</tr>";
			}
			?>
		</tbody>
	</table>
	<?php echo $paginate;?>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>