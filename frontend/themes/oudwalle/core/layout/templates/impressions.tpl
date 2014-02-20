	{include:core/layout/templates/head.tpl}
	<link rel="stylesheet" href="{$THEME_URL}/core/layout/css/camera.css">
	
	<body class="{$LANGUAGE} impressiepage" itemscope itemtype="http://schema.org/WebPage">
		<div class="wrapper">
			{include:core/layout/templates/header.tpl}
			        
            <div class="fluid_container">
            <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_4">
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/deur_thumb.jpg" data-src="{$THEME_URL}/core/layout/images/deur.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/interieur_thumb.jpg" data-src="{$THEME_URL}/core/layout/images/interieur.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/luster-onder_thumb.jpg" data-src="{$THEME_URL}/core/layout/images/luster-onder.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/raam_thumb.jpg" data-src="{$THEME_URL}/core/layout/images/raam.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/tafel_thumb.jpg" data-src="{$THEME_URL}/core/layout/images/tafel.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/tafeldekking_thumb.jpg" data-src="{$THEME_URL}/core/layout/images/tafeldekking.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/vrouwentongen_thumb.jpg" data-src="{$THEME_URL}/core/layout/images/vrouwentongen.jpg">
                </div>
            </div><!-- #camera_wrap_3 -->
    
        </div><!-- .fluid_container -->
        <div class="push"></div>
        </div>

		{include:core/layout/templates/footer.tpl}	
		<script src="{$THEME_URL}/core/js/camera.min.js"></script>
		<script type="text/javascript">
		$('#camera_wrap_4').camera({
			height: 'auto',
			loader: 'bar',
			pagination: false,
			thumbnails: true,
			opacityOnGrid: false,
			imagePath: '{$THEME_URL}/core/layout/images/',
			fx:'scrollHorz',
			loaderColor: '#e7dfd4',
			loaderBgColor: 'transparent',
			mobileNavHover: false,
			hover: false
		});
		</script>
		{* Site wide HTML *}
		{$siteHTMLFooter}
	</body>
</html>
