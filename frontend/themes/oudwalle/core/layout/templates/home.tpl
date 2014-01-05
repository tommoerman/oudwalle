	{include:core/layout/templates/head.tpl}

	<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
		<div class="wrapper">
			{include:core/layout/templates/header.tpl}
			        
            <div class="container">
                <div class="home eight columns">
                    <div class="balk top"></div>
                    <section class="content">
                      {* Main position *}
                        {iteration:positionMain}
                            {$positionMain.blockContent}
                        {/iteration:positionMain}
                    </section>
                    <div class="balk bottom"></div>
                </div>
            </div>
            <div class="push"></div>
        </div>

		{include:core/layout/templates/footer.tpl}	
		
		{* Site wide HTML *}
		{$siteHTMLFooter}
	</body>
</html>
