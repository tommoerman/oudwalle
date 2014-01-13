<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="{$LANGUAGE}" class="ie6"> <![endif]-->
<!--[if IE 7 ]> <html lang="{$LANGUAGE}" class="ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="{$LANGUAGE}" class="ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="{$LANGUAGE}" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="{$LANGUAGE}"> <!--<![endif]-->
<head>
	{* Meta *}
	<meta charset="utf-8" />
	<meta name="generator" content="Fork CMS" />
	{$meta}
	{$metaCustom}

	<title>{$pageTitle}</title>

	<meta name="google-site-verification" content="OIr_nxzATDp_0QLcC8dwWD0v0R247D9W4z6V3FVU-s0" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"
	
	{* Favicon and Apple touch icon *}
    <link rel="shortcut icon" href="{$THEME_URL}/favicon.ico">
	<link rel="apple-touch-icon" href="{$THEME_URL}/apple-touch.png">
	<link rel="apple-touch-icon" sizes="72x72" href="{$THEME_URL}/apple-touch-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="{$THEME_URL}/apple-touch-114x114.png">
	<link rel="apple-touch-icon" sizes="144x144" href="{$THEME_URL}/apple-touch-144x144.png">

	{* Windows 8 tile *}
	<meta name="application-name" content="{$siteTitle}"/>
	<meta name="msapplication-TileColor" content="#3380aa"/>
	<meta name="msapplication-TileImage" content="{$THEME_URL}/tile.png"/>

	{* Stylesheets *}
	{iteration:cssFiles}
		<link rel="stylesheet" href="{$cssFiles.file}" />
	{/iteration:cssFiles}
    <!--[if IE 7]>
    <link rel="stylesheet" href="{$THEME_URL}/core/layout/css/icons-ie7.css">
    <![endif]-->  
    
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-47099739-1', 'oudwalle.be');
	  ga('send', 'pageview');

	</script>

	{* Site wide HTML *}
	{$siteHTMLHeader}
	
</head>
