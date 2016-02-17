
<?php use Lite\Core\Router;
use Lite\CRUD\ControllerInterface;
use www\ViewBase;
use function Lite\func\dump;
use function Lite\func\h;

if(!in_array(ControllerInterface::OP_QUICK_SEARCH, $operation_list)){
	return;
}

/** @var ViewBase $this */
$quick_search_defines = $this->getData('quick_search_defines');
?>
<form class="search-frm well" action="<?php echo $this->getUrl($this->getController().'/'.$this->getAction());?>" method="get">
	<?php if($search['ref']):?>
	<input type="hidden" name="ref" value="<?php echo h($search['ref']);?>">
	<?php endif;?>

	<?php foreach($quick_search_defines as $field=>$def):?>
	<div class="frm-item">
		<label>
			<?php echo $this->renderSearchFormElement($search[$field], $field, $def, null, array('placeholder'=>$def['alias']));?>
		</label>
	</div>
	<?php endforeach;?>
	<div class="frm-item">
		<input class="btn" type="submit" value="查询"/>
		<a href="<?php echo $this->getUrl($this->getController().'/'.$this->getAction());?>" class="btn">重置</a>
	</div>
</form>
