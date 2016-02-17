<?php
use function Lite\func\dump;

include $this->resolveTemplate('inc/header.inc.php');?>
<div class="dashboard">
<?php
$cal = new Lite\Component\Calendar();
$cal->setConfig(array('show_week_index'=>true));
echo $cal;
?>
</div>

<div style="padding:10px">
	标识示例：
	<span class="state-flag state-flag-draft">草稿</span>
	<span class="state-flag state-flag-normal">正常</span>
	<span class="state-flag state-flag-done">完成</span>
	<span class="state-flag state-flag-warn">警告</span>
	<span class="state-flag state-flag-disabled">禁用</span>
</div>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>