	{include:core/layout/templates/head.tpl}

	<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
		<div class="wrapper">
			{include:core/layout/templates/header.tpl}
			<div class="container">
				<section class="content home eight columns">
					{* Main position *}
					{iteration:positionMain}
						{$positionMain.blockContent}
					{/iteration:positionMain}
				</section>
				<div class="balk top"></div>
				<div class="balk bottom"></div>
			</div>
			<div class="push"></div>
			
		</div>

		{include:core/layout/templates/footer.tpl}

		{* General Javascript *}
		{iteration:jsFiles}
			<script src="{$jsFiles.file}"></script>
		{/iteration:jsFiles}

		<script src="{$THEME_URL}/core/js/jquery.selectbox-0.2.min.js"></script>
			<script type="text/javascript">
			$(document).ready(function(e) {
				if($(window).width() < 768){
					$('.mobile').click(function(e) {
						e.preventDefault();
						$('.main').slideToggle("fast");
					});
				}
				$("#lang").selectbox({
					onChange: function(val){
						window.location.href=val;
						}
					});
			});
		</script>
		
		{* Site wide HTML *}
		{$siteHTMLFooter}
	</body>
</html>
