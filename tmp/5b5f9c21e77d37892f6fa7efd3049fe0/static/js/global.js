//批量操作交互
seajs.use(['jquery', 'ywj/msg', 'ywj/net', 'ywj/popup', 'ywj/msg'], function($, msg, net, Pop, Msg){
//	setTimeout(function(){location.reload()}, 5000);

	var MSG_LOAD_TIME = 10000;
	var DEF_POPUP_WIDTH = 600;

	var MSG_SHOW_TIME = (function(){
		return $.extend({
			err: 1,
			succ: 1,
			tip: 1
		}, window['MSG_SHOW_TIME'] || {});
	})();

	var showMsg = function(message, type, time){
		type = type || 'err';
		Msg.show(message, type, time || MSG_SHOW_TIME[type]);
	};

	$('body').delegate('[rel=popup-refresh]', 'click', function(){
		var $node = $(this);
		var POPUP_ON_LOADING = 'data-popup-on-loading-flag';
		var RET = this.tagName == 'A' ? false : null;

		if($node.attr(POPUP_ON_LOADING) == 1){
			showMsg('正在加载页面...', 'load', MSG_LOAD_TIME);
			$('.ywj-msg-container-wrap').css('background', 'rgba(0,0,0,0.2)'); //style hack
			return RET;
		}

		$node.attr(POPUP_ON_LOADING, 1);
		var src = net.mergeCgiUri($node.attr('href'), {'ref':'iframe'});
		var width = parseFloat($node.data('width')) || DEF_POPUP_WIDTH;
		var height = parseFloat($node.data('height')) || 0;
		var title = $node.attr('title') || $node.html() || '';
		var conf = {
			title: title,
			content: {src:src},
			width: width,
			moveEnable: true,
			topCloseBtn: true,
			buttons: []
		};
		if(height){
			conf.height = height;
		}
		var p = new Pop(conf);
		p.onClose = function(){
			location.reload();
		};
		p.show();
		return RET;
	});
});