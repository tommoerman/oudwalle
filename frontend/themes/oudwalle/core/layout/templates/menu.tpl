	{include:core/layout/templates/head.tpl}

	<body class="{$LANGUAGE} menupage" itemscope itemtype="http://schema.org/WebPage">
		<div class="wrapper">
			{include:core/layout/templates/header.tpl}
			        
            <div class="container">
            <div class="menu sixteen columns alpha omega">
                <div class="balk top"></div>
				<section class="content">
                  <div class="links">
                  	{iteration:positionLeft}
                            {$positionLeft.blockContent}
                        {/iteration:positionLeft}
                  </div>
                  <div class="rechts">
                  	{iteration:positionRightTop}
                            {$positionRightTop.blockContent}
                        {/iteration:positionRightTop}
                        {iteration:positionRightBottom}
                            {$positionRightBottom.blockContent}
                        {/iteration:positionRightBottom}
                  </div>
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
