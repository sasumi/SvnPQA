<?php
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
        <a href="<?php echo $this->getUrl('Repository/update');?>" rel="popup" class="btn">添加</a>
    </div>

    <table class="data-tbl">
        <caption>代码仓库</caption>
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
            <th>状态</th>
            <th style="width:80px;">操作</th>
        </thead>
        <tbody>
        <?php
        /** @var Repository $repo */
        foreach($repo_list as $repo):?>
            <tr>
                <?php $this->walkDisplayProperties(function($alias, $value){echo "<td>$value</td>";}, $repo);?>
                <td>
                    <a href="<?php echo $this->getUrl('Repository/load', array('id'=>$repo->id));?>" rel="load-repo">加载</a>
                </td>
                <td>
                    <a href="<?php echo $this->getUrl('Repository/update', array('id'=>$repo->id));?>" rel="popup">编辑</a>
                    <a href="<?php echo $this->getUrl('Repository/delete', array('id'=>$repo->id));?>">删除</a>
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