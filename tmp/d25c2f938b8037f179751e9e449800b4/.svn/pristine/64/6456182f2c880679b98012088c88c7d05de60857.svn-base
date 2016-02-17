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
</body>
</html>