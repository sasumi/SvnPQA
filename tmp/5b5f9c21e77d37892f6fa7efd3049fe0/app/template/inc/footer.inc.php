	</div>
	<div id="footer">
		Copyright &copy; 2014-2015 All Rights Reserved
		<a href="<?php echo $this->getUrl();?>?SYS_STAT=1" target="_blank">系统性能</a>
	</div>
</div>
<script>
	seajs.use(['jquery', 'ywj/popup'], function($, P){
		if($('.page-iframe').size() && P.getCurrentPopup){
			var popHeight = 0;
			setInterval(function(){
				var pop = P.getCurrentPopup();
				if(pop){
					var currentHeight = parseInt($('body').outerHeight());
					if (currentHeight != popHeight) {
						popHeight = currentHeight;
						pop.updateHeight(currentHeight);
					}
				}
			}, 100);
		}
		$('body').delegate('input[type=number]', 'click', function(){
			this.focus();
			this.select(this);
		});
	});
</script>

<script>
seajs.use(['jquery', 'jquery/cookie'], function($){
	var $resizer = $('#resizer');
	var $body = $('body');
	var resizing = false;
	var start_region = null;
	var start_pos = null;
	$resizer.mousedown(function(e){
		resizing = true;
		start_pos = {
			left: e.clientX,
			top: e.clientY
		};
		start_region = {
			top: parseInt($resizer.css('top'), 10),
			left: parseInt($resizer.css('left'), 10),
			width: $resizer.width()
		};
	});

	$body.mousemove(function(e){
		if(resizing){
			var offset_left = e.clientX - start_pos.left;
			$resizer.css('left', (start_region.left + offset_left) + 'px');
			return false;
		}
	});

	$body.mouseup(function(){
		if(resizing){
			$('#header').css('width', $resizer.offset().left+'px');
			$resizer.css('left',0);
			$.cookie('resizer_hd_w', $resizer.offset().left);
		}
		resizing = false;
	});
});
</script>

<style>
.fa-check {color:green;}
.fa-close {color:orange}
</style>
<script>
</script>
</body>
</html>