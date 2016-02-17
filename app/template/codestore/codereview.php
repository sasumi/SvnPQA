<?php
use Lite\Core\Router;
use function Lite\func\array_group;
use function Lite\func\array_merge_recursive_distinct;
use function Lite\func\array_orderby;
use function Lite\func\dump;
use function Lite\func\glob_recursive;
use SvnPQA\ViewBase;

$tree_list = $this->getData('tree_list');
$repository_list = $this->getData('repository_list');

function show_tree($list, $exp_dep=null){
    $exp_dep = isset($exp_dep) ? $exp_dep : 3;
	$html = '';
	foreach($list as $n=>$sub){
        $has_children = is_array($sub);
		$html .= "<li class=\"".($has_children ? 'tree-has-children':'').($has_children && !$exp_dep ? ' tree-collapse':'')."\">";
        $html .= $has_children ? '<span class="tree-toggle"></span>' :'';
        $html .= "<label data-path=\"".preg_replace(array('/^root/', '/^\/root/'),array('', '/'),$n)."\">".
            (array_pop(explode('/',$n)))."</label>";
		if($has_children){
			$html .= "<ul>".show_tree($sub, max($exp_dep-1, 0))."</ul>";
		}
		$html .= "</li>";
	}
	return $html;
}
$PAGE_HTML_HEAD .= $this->getJs('prettify/prettify.js')
    .$this->getCss('codestore.css')
    .$this->getCss($this->getStaticUrl('js/prettify/prettify.css'));
include $this->resolveTemplate('inc/header.inc.php');
?>
<div id="col-aside"><?php echo ViewBase::getSideMenu()?></div>
<div id="col-main">
    <form class="repository-select" action="<?php echo $this->getUrl('CodeStore/codeReview');?>" method="get">
        Repository：
        <select name="id" onchange="if(this.value){this.parentNode.submit();}">
            <?php foreach($repository_list ?: array() as $rep):?>
            <option value="<?php echo $rep->id;?>" <?php echo $current_rep->id == $rep->id ? 'selected':'';?>>
                <?php echo $rep->address;?>
            </option>
            <?php endforeach;?>
        </select>
    </form>

    <div class="store-warp cus-scroll">
        <div class="col-file-explorer">
            <div class="col-tree">
                <ul class="tree-list">
                    <?php echo show_tree($tree_list);?>
                </ul>
            </div>
            <div class="col-file-list">
                <table class="data-tbl" data-empty-fill="1">
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-code-explorer">
            <div class="col-file-content">
                <h3 class="caption">
                    <span class="f-uri-list"></span>
                    <span class="f-name"></span>
                </h3>
                <div class="file-content">
                    <pre class="prettyprint lang-php linenums=true"></pre>
                    <div class="comments">
                        <ul>
                            <li>asdfasdf</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="resizer resizer-h"></div>
            <div class="col-history">
                <h3 class="caption">Commit History</h3>
                <div class="col-history-wrap">
                    <table class="data-tbl" data-empty-fill="1">
                        <thead>
                        <tr>
                            <th style="width:60px;">Version</th>
                            <th style="width:60px;">Action</th>
                            <th style="width:100px;">Author</th>
                            <th style="width:150px;">Date</th>
                            <th>备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/template" id="history-list-tpl">
    <tr>
        <td>Revision</td>
        <td>Actions</td>
        <td>Autdor</td>
        <td>2014-12-03 23:33:33</td>
        <td>Message</td>
    </tr>
</script>

<script type="text/template" id="file-list-tpl">
<% for(var i=0; i<list.length; i++){
var item = list[i];
%>
<tr>
    <td>
        <span data-<%if(item.is_folder){%>path<%}else{%>uri<%}%>="<%=item.uri%>" class="<%=(item.uri == CURRENT_URI && !item.is_folder ? FILE_ACT_CLS :'')%>">
        <span class="<%=item.css_class%>"></span>
            <%=item.name%>
        </span>
    </td>
    <td style="width:40px;"><%=item.size%></td>
</tr>
<%}%>
</script>

<style>
<?php
$hr = $_COOKIE['HEIGHT_RATIO']*100;
if($hr){
    echo ".file-explorer {height:$hr%}", "\n.code-explorer {height:".(100-$hr)."%}";
}
?>
</style>

<script>
seajs.use(['jquery', 'ywj/net', 'ywj/tmpl', 'jquery/cookie'], function($, net, tmpl){
    var $tree = $('.tree-list');
    var $body = $('body');
    var TOG_CLS = 'tree-collapse';
    var TREE_ACT_CLS = 'tree-active';
    var FILE_ACT_CLS = 'file-active';
    var $FILE_EXPLORER = $('.file-explorer');
    var $CODE_EXPLORER = $('.code-explorer');
    var CURRENT_URI = '';
    var CURRENT_REPO_ID = '<?php echo $current_rep->id;?>';

    var CGI_GET_FILES = '<?php echo $this->getUrl('CodeStore/fileList');?>';
    var CGI_GET_FILE_INFO = '<?php echo $this->getUrl('CodeStore/fileInfo');?>';

    var htmlEscape = function(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    };

    var htmlUnescape = function(value){
        return String(value)
            .replace(/&quot;/g, '"')
            .replace(/&#39;/g, "'")
            .replace(/&lt;/g, '<')
            .replace(/&gt;/g, '>')
            .replace(/&amp;/g, '&');
    };

    var showDir = function(path){
        net.get(CGI_GET_FILES, {p:path, id:CURRENT_REPO_ID}, function(rsp){
            if(rsp.code == 0){
                rsp.data.CURRENT_URI = CURRENT_URI;
                rsp.data.FILE_ACT_CLS = FILE_ACT_CLS;
                $('.col-file-list tbody').html(tmpl($('#file-list-tpl').html(), rsp.data));
            }
        });
        $tree.find('li').removeClass(TREE_ACT_CLS);
        $tree.find('label').each(function() {
            if ($(this).data('path') == path) {
                $(this).parent().addClass(TREE_ACT_CLS);
                $(this).parents('li').removeClass(TOG_CLS);
            }
        });
    };

    var buildUriList = function(uri){
        var s = uri.replace(/\/[^\/]+$/,'').split('/');
        var html = '';
        var u;
        for(var i=0; i< s.length; i++){
            var tmp = [];
            for(var j=0; j<=i; j++){
                tmp.push(s[j]);
            }
            u = tmp.join('/');
            html += '<span '+(u ? 'data-path="'+u+'"' : '')+'>'+s[i]+'/</span>';
        }
        return html;
    };


    var showCode = function(fileInfo){
        var $cap = $('.col-file-content .caption');
        $cap.find('.f-name').html(fileInfo.name);
        $cap.find('.f-uri-list').html(buildUriList(fileInfo.uri));
        var html = '';
        if(!fileInfo.is_image){
            html = '<pre class="prettyprint lang-'+fileInfo.type+' linenums=true">'+htmlEscape(fileInfo.content)+'</pre>';
        } else {
            html ='<img src="data:image/png;base64,'+fileInfo.content+'"/>';
        }
        $('.file-content pre').html(html);
        prettyPrint();
    };

    var showHistories = function(fileInfo){

    };

    var addCommentMark = function(line, count){
        var $flag = $('<span class="comment-flag"><i class="fa fa-comment-o"></i></span>');
        $flag.prependTo($('.file-content .prettyprint .linenums>li').eq(line));
    };

    var showComments = function(fileInfo){
        var comments = fileInfo.comments;
        if(comments){
            for(var line in comments){
                addCommentMark(line, comments.length);
            }
        }
    };

    var showFile = function(uri){
        net.get(CGI_GET_FILE_INFO, {f:uri, id:CURRENT_REPO_ID}, function(rsp){
            if(rsp.code == 0){
                showCode(rsp.data);
                showHistories(rsp.data);
                showComments(rsp.data);
            }
        });
    };

    $body.delegate('[data-path]', 'click', function(){
        var path = $(this).data('path');
        showDir(path);
    });

    $body.delegate('[data-uri]', 'click', function(){
        var $this = $(this);
        $('[data-uri]', $body).removeClass(FILE_ACT_CLS);
        var f = $this.data('uri');
        $this.addClass(FILE_ACT_CLS);
        CURRENT_URI = f;
        showFile(f);
    });

    /**
     * tree operation
     */
    (function(){
        $tree.delegate('.tree-toggle', 'click', function(e){
            var $p = $(this).parent();
            $p.toggleClass(TOG_CLS);
            if($p.hasClass(TOG_CLS)){
                $p.find('.tree-has-children').addClass(TOG_CLS);
            }
        });
    })();

    /**
     * resizer operation
     */
    (function(){
        return;
        var RESIZE_EVENT = 'MY_RESIZE_EVENT:RS';
        var HEIGHT_RATIO = 0.35;
        var WIDTH_RATIO = 0.5;
        var $RESIZE_CONTAINER = $('.resizer-container');

        //update resizer container height
        $(window).resize(function(){
            var $s = $('.repository-select');
            var body_h = $body.height();
            var h = body_h - ($s.offset().top + $s.outerHeight())-80;
            $RESIZE_CONTAINER.height(h).triggerHandler(RESIZE_EVENT);
        }).trigger('resize');

        $RESIZE_CONTAINER.on(RESIZE_EVENT,function(){
            $FILE_EXPLORER.triggerHandler(RESIZE_EVENT);
            $CODE_EXPLORER.triggerHandler(RESIZE_EVENT);
        });

        $CODE_EXPLORER.on(RESIZE_EVENT, function(){
            $('.file-content').height($(this).height()-70);
        });

        $FILE_EXPLORER.on(RESIZE_EVENT,function(){
            var h = $(this).height();
            $('.col-history-wrap').height(h-40);
        });

        $('.resizer').each(function(){
            var $resizer = $(this);
            var horizon = $resizer.hasClass('resizer-h');
            var $body = $('body');
            var $PREV_DOM = $resizer.prev();
            var $NEXT_DOM = $resizer.next();
            var resizing = false;
            var start_pos = null;
            var prev_dom_region = null;
            var next_dom_region = null;

            if(!$PREV_DOM.size() || !$NEXT_DOM.size()){
                return;
            }

            $resizer.mousedown(function(e){
                resizing = true;
                start_pos = {
                    clientX: e.clientX,
                    clientY: e.clientY
                };
                prev_dom_region = {
                    height: $PREV_DOM.height(),
                    width: $PREV_DOM.width()
                };
                next_dom_region = {
                    height: $NEXT_DOM.height(),
                    width: $NEXT_DOM.width()
                };
            });

            $body.mousemove(function(e){
                if(resizing){
                    if(horizon){
                        var offsetY = e.clientY - start_pos.clientY;
                        HEIGHT_RATIO = (prev_dom_region.height + offsetY) / (prev_dom_region.height + next_dom_region.height);
                        $PREV_DOM.css('height', HEIGHT_RATIO*100 + '%');
                        $NEXT_DOM.css('height', (1-HEIGHT_RATIO)*100 + '%');
                        $.cookie('HEIGHT_RATIO', HEIGHT_RATIO);
                    } else {
                        var offsetX = e.offsetX - start_pos.offsetX;
                        WIDTH_RATIO = (prev_dom_region.width + offsetX) / (next_dom_region.width - offsetX);
                        $PREV_DOM.css('width', WIDTH_RATIO*100+'%');
                        $NEXT_DOM.css('width', (1-WIDTH_RATIO)*100+'%');
                    }
                    $PREV_DOM.triggerHandler(RESIZE_EVENT);
                    $NEXT_DOM.triggerHandler(RESIZE_EVENT);
                    return false;
                }
            });

            $body.mouseup(function(){
                resizing = false;
            });
        });
    })();
});

</script>
<?php include $this->resolveTemplate('inc/footer.inc.php');?>