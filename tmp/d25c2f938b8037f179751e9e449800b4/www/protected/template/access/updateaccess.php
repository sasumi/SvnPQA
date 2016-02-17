<?php

include $this->resolveTemplate('inc/header.inc.php') ?>
<div id="col-aside"><?php echo $this->getSideMenu(); ?></div>
<div id="col-main">
    <form action="<?= $this->getUrl('access/updateAccess', array('id'=>$action_info->id)); ?>" class="frm" rel="async"  method="post">
        <table class="frm-tbl">
	        <caption>编辑</caption>
            <tbody>
	            <tr>
	                <td class="col-label">URI</td>
	                <td><input class="txt" name="uri" value="<?php echo $action_info->uri; ?>" ></td>
	            </tr>
	            <tr>
		            <td class="col-label">功能描述</td>
		            <td><input class="txt" type="text" name="desc" value="<?php echo $action_info->desc; ?>"></td>
	            </tr>
	            <tr>
		            <td class="col-label"></td>
	                <td class="col-action">
	                    <input type="submit" value="提交" class="btn btn-primary">
	                </td>
	            </tr>
            </tbody>
        </table>
    </form>
</div>
<style>
	input[type=submit][disabled] {display: none}
</style>
<?php include $this->resolveTemplate('inc/footer.inc.php'); ?>
