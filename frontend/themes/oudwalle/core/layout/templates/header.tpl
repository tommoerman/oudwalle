<header>
	<div class="container">
	<a href="/" title="Home - Oud Walle Restaurant" class="logo">
		<img src="{$THEME_URL}/core/layout/images/logo-OudWalle.jpg" width="160" height="158" alt="Logo Oud Walle Restaurant" />
		</a>
			<div class="language three columns omega">
				<span class="icon-phone"></span> 056 22 65 53
				<select id="lang">
					{option:languages}
							{iteration:languages}
								<option value="{$languages.url}">{$languages.label}</option>			
							{/iteration:languages}	
					{/option:languages}
				</select>
			</div>

			{* Navigation *}
			<nav class="ten columns">
				<span class="mobile icon-menu">menu</span>
				<span class="main">
				  {$var|getnavigation:'page':0:1} 
				</span>
			</nav>			
	</div>
</header>
