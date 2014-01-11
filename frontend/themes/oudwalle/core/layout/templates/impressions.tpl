	{include:core/layout/templates/head.tpl}

	<body class="{$LANGUAGE} impressiepage" itemscope itemtype="http://schema.org/WebPage">
		<div class="wrapper">
			{include:core/layout/templates/header.tpl}
			        
            <div class="fluid_container">
            <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_4">
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/01groot.jpg" data-src="{$THEME_URL}/core/layout/images/01groot.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/02groot.jpg" data-src="{$THEME_URL}/core/layout/images/02groot.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/03.jpg" data-src="{$THEME_URL}/core/layout/images/03.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/03groot.jpg" data-src="{$THEME_URL}/core/layout/images/03groot.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/04groot.jpg" data-src="{$THEME_URL}/core/layout/images/04groot.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/05groot.jpg" data-src="{$THEME_URL}/core/layout/images/05groot.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/frederik-desmet.jpg" data-src="{$THEME_URL}/core/layout/images/frederik-desmet.jpg">
                </div>
                <div data-thumb="{$THEME_URL}/core/layout/images/thumbs/1DS_9248_4.jpg" data-src="{$THEME_URL}/core/layout/images/1DS_9248_4.jpg">
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
