<div class="language three columns omega">
	<span class="icon-phone"></span> 056 22 65 53 t
	<select id="lang">
		{option:languages}
				{iteration:languages}
					<option {option:languages.current}selected{/option:languages.current} value="{$languages.url}">{$languages.label|uppercase}</option>			
				{/iteration:languages}	
		{/option:languages}
	</select>
</div>
                 
