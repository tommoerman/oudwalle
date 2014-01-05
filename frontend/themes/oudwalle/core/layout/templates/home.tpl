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
		
		{* Site wide HTML *}
		{$siteHTMLFooter}
	</body>
</html>
