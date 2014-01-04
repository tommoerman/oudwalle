{include:core/layout/templates/head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">
	<div id="topWrapper">
		<header id="header">
			<div class="container">

				{* Logo *}
				<div id="logo">
					<h2><a href="/">{$siteTitle}</a></h2>
				</div>

				{* Skip link *}
				<div id="skip">
					<p><a href="#main">{$lblSkipToContent|ucfirst}</a></p>
				</div>

				{* Navigation *}
				<nav id="headerNavigation">
					<h4>{$lblMainNavigation|ucfirst}</h4>
					{$var|getnavigation:'page':0:1}
				</nav>

				{* Language *}
				<nav id="headerLanguage">
					<h4>{$lblLanguage|ucfirst}</h4>
					{include:core/layout/templates/languages.tpl}
				</nav>
                <div style="float:right;"">
      				{* Top position *}
    				{iteration:positionTop}
    					{$positionTop.blockContent}
    				{/iteration:positionTop}
                </div>

			</div>

		</header>
		<div id="main">
			<div class="container">

				{* Main column *}
				<div>

					{* Page title *}
					{option:!hideContentTitle}
						<header class="mainTitle">
							<h1>{$page.title}</h1>
						</header>
					{/option:!hideContentTitle}

					{* Main position *}
					{iteration:positionMain}
						{option:positionMain.blockIsHTML}
							<section class="mod">
								<div class="inner">
									<div class="bd content">
										{$positionMain.blockContent}
									</div>
								</div>
							</section>
						{/option:positionMain.blockIsHTML}
						{option:!positionMain.blockIsHTML}
							{$positionMain.blockContent}
						{/option:!positionMain.blockIsHTML}
					{/iteration:positionMain}

				</div>
			</div>
            <div class="container">
              <div class="col col-6">
              {* Left position *}
  					{iteration:positionLeft}
  						{option:positionLeft.blockIsHTML}
  							<section class="mod">
  								<div class="inner">
  									<div class="bd content">
  										{$positionLeft.blockContent}
  									</div>
  								</div>
  							</section>
  						{/option:positionLeft.blockIsHTML}
  						{option:!positionLeft.blockIsHTML}
  							{$positionLeft.blockContent}
  						{/option:!positionLeft.blockIsHTML}
  					{/iteration:positionLeft}
                </div>
                <div class="col col-6">
                    {* Right position *}
					{iteration:positionRight}
						{option:positionRight.blockIsHTML}
							<section class="mod">
								<div class="inner">
									<div class="bd content">
										{$positionRight.blockContent}
									</div>
								</div>
							</section>
						{/option:positionRight.blockIsHTML}
						{option:!positionRight.blockIsHTML}
							{$positionRight.blockContent}
						{/option:!positionRight.blockIsHTML}
					{/iteration:positionRight}
                    </div>
            </div>
		</div>
		<noscript>
			<div class="message notice">
				<h4>{$lblEnableJavascript|ucfirst}</h4>
				<p>{$msgEnableJavascript}</p>
			</div>
		</noscript>
	</div>

	{* General Javascript *}
	{iteration:jsFiles}
		<script src="{$jsFiles.file}"></script>
	{/iteration:jsFiles}

	{* Theme specific Javascript *}
	<script src="{$THEME_URL}/core/js/triton.js"></script>

	{* Site wide HTML *}
	{$siteHTMLFooter}
</body>
</html>