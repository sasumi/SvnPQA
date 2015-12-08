<?php
use function Lite\func\array_group;
use function Lite\func\array_merge_recursive_distinct;
use function Lite\func\array_orderby;
use function Lite\func\dump;
use function Lite\func\glob_recursive;
use SvnPQA\ViewBase;

$tree_list = $this->getData('tree_list');

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
	<div class="file-explorer">
        <div class="col-tree">
            <ul class="tree-list">
                <?php echo show_tree($tree_list);?>
            </ul>
        </div>
        <div class="col-file-list">
            <table class="data-tbl">
                <caption>File List</caption>
                <thead>
                <tr>
                    <th>File</th>
                    <th>Revision</th>
                    <th>Author</th>
                    <th>Size</th>
                    <th>Last Modify</th>
                    <th>Lock</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($default_file_list as $f):?>
                <tr>
                    <td><?php echo $f;?></td>
                    <td>Revision</td>
                    <td>Autdor</td>
                    <td>Size</td>
                    <td>Last Modify</td>
                    <td>Lock</td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col-history">
            <table class="data-tbl">
                <caption>History</caption>
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
                    <tr>
                        <td>Revision</td>
                        <td>Actions</td>
                        <td>Autdor</td>
                        <td>2014-12-03 23:33:33</td>
                        <td>Message</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/template">
    .tree-list {font-size:13px; padding-left:12px;}
    .tree-list ul {padding-left:15px;}
    .tree-list label,
    .tree-list li {position: relative;}
    .tree-list .tree-has-children>label {cursor:pointer;}
    .tree-list .tree-has-children>label:before {font-family: FontAwesome, serif; content:"\f0d7"; display:block; position:absolute; top:0; left:-12px;}
</script>

<style>
    #container {padding-top:20px;}

    .col-tree::-webkit-scrollbar{width:0.4rem; height:0.4rem;background: rgba(0,0,0,0);}
    .col-tree::-webkit-scrollbar-track{background: rgba(0,0,0,0);}
    .col-tree::-webkit-scrollbar-thumb {background:#89cccd; border-radius: 0.5rem;}

    .repository-select {padding:5px; background-color:white; border:1px solid #ddd; border-radius:3px;}
    .file-explorer {display:flex; height:350px; margin-top:10px; padding:10px; background-color:white; border-radius:3px; border:1px solid #ddd;}
    .col-tree {padding-right:20px; border-right:1px dotted #ccc; width:200px; overflow:auto;}
    .col-file-list {flex:1; margin-left:20px; padding-right:20px; border-left:1px solid #fff;}
    .col-history {flex:2; margin-right:20px;}
    .file-explorer .data-tbl {box-shadow:none;}
    .file-explorer .data-tbl caption {box-shadow:none;}

    .tree-list {font-size:13px; background-color:#fff;}
    .tree-list ul {border-left:1px dotted gray;}
    .tree-list label { position:relative; margin-left:10px; cursor:pointer; white-space:nowrap}
    .tree-list li {padding-left:15px; position: relative;}
    .tree-list li.tree-active>label {color:black; font-weight:bold}
    .tree-list .tree-has-children:before {content:"\f147"; display:block; font-family: FontAwesome, serif; position:absolute; left:10px; top:4px; cursor:pointer;}
    .tree-list .tree-collapse:before {content:"\f196"}
    .tree-list .tree-collapse ul {display:none;}
    .tree-list .tree-has-children:after {width:8px;}
    .tree-list li:after {content:""; display:block; position:absolute; left:0; top:0; width:20px; height:12px; margin-left:-1px; border-bottom:1px dotted gray; border-left:1px dotted gray;}
    .tree-list>li:after {display:none;}
    .tree-list li:last-child {border-left:1px dotted #fff; margin-left:-1px}
</style>
<script>
seajs.use('jquery', function($){
    var $tree = $('.tree-list');
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

    var show_dir = function(path){
        location.hash = '#p='+encodeURI(path);
    };
});
</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>