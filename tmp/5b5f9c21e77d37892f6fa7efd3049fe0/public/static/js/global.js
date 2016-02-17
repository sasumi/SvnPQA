//批量操作交互
seajs.use(['jquery', 'ywj/msg', 'ywj/net', 'ywj/popup', 'ywj/msg'], function($, msg, net, Pop, Msg){
	var $body = $('body');

	var CGI_ADD_SAMPLE = window['CGI_ADD_SAMPLE'];
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

	/**
	 * tag组件
	 * @param $tags_input
	 */
	(function(){
		var update_tags_input = function($tags_input){
			var value = [];
			$tags_input.find('li>span[class!="del-tag"]').each(function(){
				value.push($(this).text());
			});
			var $val = $tags_input.find('input[type=hidden]');
			$val.val(value.join(','));
		};

		$body.delegate('.tags-input .del-tag', 'click', function(){
			var $ti = $(this).closest('.tags-input');
			$(this).parent().remove();
			update_tags_input($ti);
		});

		$body.delegate('.tags-input input[type=text]', 'keydown', function(e){
			var val = $.trim(this.value);
			if(val && e.keyCode == 13){
				var vs = val.split(',');
				for(var i=0; i<vs.length; i++){
					$('<li><span class="del-tag" title="删除">x</span><span>'+vs[i]+'</span></li>').appendTo($(this).closest('.tags-input').find('ul'));
				}
				this.value = '';
				update_tags_input($(this).closest('.tags-input'));
			}

			if(e.keyCode == 13){
				return false;
			}
		});
	})();

	/**
	 * 弹窗刷新组件
	 */
	$body.delegate('[rel=popup-refresh]', 'click', function(){
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

	/**
	 * 快速添加样品
	 * @param succCallback
	 */
	window['addSample'] = function(succCallback){
		var p = new Pop({
			title: '添加样品',
			content: {src:CGI_ADD_SAMPLE},
			width: 580,
			isModal: true
		});
		p.listen('onSuccess', function(sample_no){
			succCallback(sample_no);
		});
		p.show();
	};

	seajs.use(['jquery', 'ywj/net', 'ywj/popup'], function($, net, Pop){
		$('input[rel=sample-input]').each(function(){
			var req = null;
			var _sending = false;

			var $inp = $(this);
			var sample_id = $inp.val();
			var init_sample_no = $inp.data('sample-no') || '';
			var on_success = $inp.data('onsuccess') ? window[$inp.data('onsuccess')] : function(){};
			var on_start = $inp.data('onstart') ? window[$inp.data('onstart')] : function(){};
			console.log('on_start', on_start);
			var on_error = $inp.data('onerror') ? window[$inp.data('onerror')] : function(){};
			var sample_type = $inp.data('sample-type') ? $inp.data('sample-type') : null;

			var $sample_no = $('<input type="text" placeholder="样品货号" class="txt" value="'+init_sample_no+'"/>').insertAfter($inp);
			var $check_result = $('<span style="margin:0 5px;"></span>').insertAfter($sample_no);
			var $quick_add = $('<a href="javascript:void(0);">新增样品</a>').insertAfter($check_result);

			var $form = $inp.closest('form');
			var $submit_btn = $form.find('input[type=submit]');

			$inp.hide();

			$form.submit(function(){
				if(!$inp.val()){
					return false;
				}
			});
			if(!sample_id){
				$submit_btn.attr('disabled', true);
			}

			$.each(['blur', 'change', 'keyup'], function(k, ev){
				$sample_no[ev](function(){
					if(!$.trim($(this).val())){
						return;
					}

					$inp.val('');
					$submit_btn.attr('disabled', true);
					if(_sending){
						return;
					}
					on_start();
					_sending = true;
					if(req){
						req.abort();
					}
					req = net.get(CGI_SEARCH_SAMPLE, {no: this.value, sample_type:sample_type}, function(rsp){
						if(rsp.code == 0){
							var sample = rsp.data;
							$inp.val(sample.sample_id);
							on_success(sample);
						} else {
							on_error();
						}
						_sending = false;
						$submit_btn.attr('disabled', rsp.code != 0);
						$check_result.attr('class', 'fa '+(rsp.code == 0 ? 'fa-check' : 'fa-close')).show();
					});
				});
			});

			$sample_no.trigger('change');

			$quick_add.click(function(){
				parent.addSample(function(sample_no){
					$sample_no.val(sample_no).trigger('change');
				});
				return false;
			});
		});
	})
});