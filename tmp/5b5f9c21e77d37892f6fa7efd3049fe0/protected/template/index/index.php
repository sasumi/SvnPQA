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
<?php include $this->resolveTemplate('inc/footer.inc.php');?>