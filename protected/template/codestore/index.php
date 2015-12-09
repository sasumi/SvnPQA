<?php
use function Lite\func\array_group;
use function Lite\func\array_merge_recursive_distinct;
use function Lite\func\array_orderby;
use function Lite\func\dump;
use function Lite\func\glob_recursive;
use SvnPQA\ViewBase;

$tree_list = $this->getData('tree_list');
$default_file_list = $this->getData('default_file_list');

function show_tree($list, $exp_dep=5){
	$html = '';
	foreach($list as $n=>$sub){
        $has_children = is_array($sub);
		$html .= "<li class=\"".($has_children ? 'tree-has-children':'').($has_children && !$exp_dep ? ' tree-collapse':'').($n == '/root' ? ' tree-active' : '')."\">";
        $html .= "<label data-path=\"".$n."\">".(array_pop(explode('/',$n)))."</label>";
		if($has_children){
			$html .= "<ul>".show_tree($sub, max($exp_dep-1, 0))."</ul>";
		}
		$html .= "</li>";
	}
	return $html;
}
$PAGE_HTML_HEAD .= $this->getJs('https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js');
include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
    <div class="repository-select">
        资源库：
        <select name="" id="">
            <option value="">http://svn.oa.com/Web/trunk</option>
        </select>
    </div>

	<div class="file-explorer cus-scroll">
        <div class="col-tree">
            <ul class="tree-list">
                <?php echo show_tree($tree_list);?>
            </ul>
        </div>
        <div class="col-file-list">
            <h3 class="caption">文件列表</h3>
            <div class="col-file-list-wrap">
                <table class="data-tbl">
                    <thead>
                    <tr>
                        <th style="width:150px;">文件</th>
                        <th>版本号</th>
                        <th>作者</th>
                        <th style="width:60px;">大小</th>
                        <th>最后修改时间</th>
                        <th>是否锁定</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($default_file_list as $f):?>
                        <tr>
                            <td>
                                <span class="<?php echo $f['css_class'];?>"></span>
                                <a href="">
                                    <?php echo $f['name'];?>
                                </a>
                            </td>
                            <td>Revision</td>
                            <td>Autdor</td>
                            <td><?php echo $f['size'];?></td>
                            <td>Last Modify</td>
                            <td>Lock</td>
                            <td>
                                <a href="">Note</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-history">
            <h3 class="caption">提交历史</h3>
            <div class="col-history-wrap">
                <table class="data-tbl">
                    <thead>
                        <tr>
                            <th style="width:60px;">Revision</th>
                            <th style="width:60px;">Actions</th>
                            <th style="width:100px;">Author</th>
                            <th style="width:150px;">Date</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($sfasdf++<20):?>
                        <tr>
                            <td>Revision</td>
                            <td>Actions</td>
                            <td>Autdor</td>
                            <td>2014-12-03 23:33:33</td>
                            <td>Message</td>
                        </tr>
                        <?php endwhile;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="resizer resizer-h"></div>

    <div class="code-explorer cus-scroll">
        <div class="col-file-content">
            <h3 class="caption"><?php echo $current_file ?: 'http://svn.oa.com/web/trunk/a.js';?></h3>
            <div class="file-content">
                <pre class="prettyprint lang-php linenums=true"><?php echo htmlspecialchars(file_get_contents('D:\www\litephp\src\DB\Model.php'));?></pre>
            </div>
        </div>
        <div class="col-comment">
            <h3 class="caption">Comment</h3>
            <div class="comment-list-warp">
                <ul class="comment-list"></ul>
            </div>
        </div>
    </div>
</div>
<style>
    #container {padding-top:20px;}
    .file-content {padding:10px; height:500px; overflow-y:scroll;}
    .file-content .prettyprint {border:none;}
    .prettyprint ol.linenums li {display:list-item; list-style:decimal inside;}
</style>
<script>
seajs.use('jquery', function($){
    var $tree = $('.tree-list');
    var $body = $('body');
    var URL = '<?php echo $this->getUrl('CodeStore');?>';
    var TOG_CLS = 'tree-collapse';
    $tree.delegate('.tree-has-children', 'click', function(e){
        if(e.offsetX > 10 && e.offsetX < 24 && e.offsetY > 6 && e.offsetY < 20){
            $(this).toggleClass(TOG_CLS);
            if($(this).hasClass(TOG_CLS)){
                $(this).find('.tree-has-children').addClass(TOG_CLS);
            }
        }
        e.stopPropagation();
        e.preventDefault();
    });
    $tree.delegate('label', 'click', function(){
        $tree.find('li').removeClass('tree-active');
        $(this).parent().addClass('tree-active');
        show_dir($(this).data('path'));
    });

    $(window).resize(function(){
        var $s = $('.repository-select');
        var $f = $('.file-explorer');
        var $c = $('.code-explorer');
        var body_h = $body.height();
        var h = body_h - ($s.offset().top + $s.outerHeight())-80;

        var top_h = h*0.35;
        var btm_h = h*0.65;

        console.log($s.offset().top + $s.outerHeight(), h);
        $f.height(top_h);
        $c.height(btm_h);
        $('.file-content').height(btm_h-70);

        $('.col-file-list-wrap').height(top_h-40);
        $('.col-history-wrap').height(top_h-40);
    }).trigger('resize');

    var show_dir = function(path){
        location.hash = '#p='+encodeURI(path);
    };

    $('.resizer').each(function(){
        var $resizer = $(this);
        var horizon = $resizer.hasClass('resizer-h');
        var $body = $('body');
        var resizing = false;
        var start_region = null;
        var start_pos = null;
        $resizer.mousedown(function(e){
            resizing = true;
            start_pos = {
                clientX: e.clientX,
                clientY: e.clientY
            };
            start_region = {
                top: parseInt($resizer.css('top'), 10),
                left: parseInt($resizer.css('left'), 10)
            };
        });

        $body.mousemove(function(e){
            if(resizing){
                if(horizon){
                    $resizer.css('left', (start_region.top + e.clientY - start_pos.clientX) + 'px');
                } else {
                    $resizer.css('top', (start_region.left + e.clientX - start_pos.clientY) + 'px');
                }
                return false;
            }
        });

        $body.mouseup(function(){
            if(resizing){
//                $('#header').css('width', $resizer.offset().left+'px');
//                $resizer.css('left',0);
//                $.cookie('resizer_hd_w', $resizer.offset().left);
            }
            resizing = false;
        });
    });
});

</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>