<?php
use Lite\Core\Router;
use function Lite\func\array_group;
use function Lite\func\array_merge_recursive_distinct;
use function Lite\func\array_orderby;
use function Lite\func\dump;
use function Lite\func\glob_recursive;
use SvnPQA\model\Repository;
use SvnPQA\ViewBase;

/**
 * @var ViewBase $this
 */
$repo_list = $this->getData('data_list');
include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
    <div class="operate-bar">
        <a href="<?php echo $this->getUrl('Repository/update');?>" rel="popup" class="btn">Add Repository</a>
    </div>
    <table class="data-tbl">
        <caption>Code Repository</caption>
        <thead>
            <?php
            /** @var Repository $repo */
            foreach($repo_list as $repo){
                $this->walkDisplayProperties(function($alias, $value){
                    echo "<th>$alias</th>";
                }, $repo);
                break;
            }
            ?>
            <th>State</th>
            <th style="width:120px;">Op.</th>
        </thead>
        <tbody>
        <?php
        /** @var Repository $repo */
        foreach($repo_list as $repo):?>
            <tr>
                <?php $this->walkDisplayProperties(function($alias, $value){echo "<td>$value</td>";}, $repo);?>
                <td>
                    <a href="<?php echo $this->getUrl('Repository/load', array('id'=>$repo->id));?>" rel="load-repo">Load</a>
                </td>
                <td>
                    <a href="<?php echo $this->getUrl('Repository/update', array('id'=>$repo->id));?>" rel="popup">Update</a>
                    <a href="<?php echo $this->getUrl('Repository/delete', array('id'=>$repo->id));?>">Delete</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php echo $paginate;?>
</div>
    <script>
        seajs.use(['jquery', 'ywj/net'], function($, net){
            $('[rel=load-repo]').click(function(){
                var $this = $(this);
                var $p = $this.parent();
                $this.parent().html('处理中...');
                net.get($this.attr('href'), null, function(rsp){
                    $p.html(rsp.message);
                });
                return false;
            });
        });
    </script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>