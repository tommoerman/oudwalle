<footer id="footer">
	<div class="container">
            <div class="social">
                <a href="http://www.facebook.com/oudwalle" title="Facebook pagina Oud Walle Restaurant" class="icon-facebook" target="_blank"></a> <a href="https://plus.google.com/100464349662405238790" title="Google+ pagina Oud Walle Restaurant" class="icon-googleplus" target="_blank" rel="publisher"></a>
            </div>
            <div class="adres">
            	<span class="icon-location"></span> Koning Albertstraat 4, 8500 Kortrijk  <span class="square">&#x25a0;</span> <span class="icon-phone"></span> <a href="tel:056 22 65 53">056 22 65 53</a>  <span class="square">&#x25a0;</span> <span class="icon-mail"></span> <a href="mailto:info@oudwalle.be" title="E-Mail Oud Walle Restaurant">info@oudwalle.be</a>
            </div>
            <div class="rewards">
            	<img src="{$THEME_URL}/core/layout/images/michelin.png" width="94" height="16" alt="Michelin" />
                <img src="{$THEME_URL}/core/layout/images/gaultmillau.png" width="101" height="16" alt="Gault&Millau" />
            </div>
        </div>
</footer>

{* General Javascript *}
		{iteration:jsFiles}
			<script src="{$jsFiles.file}"></script>
		{/iteration:jsFiles}

		<script src="{$THEME_URL}/core/js/jquery.selectbox-0.2.min.js"></script>
		<script src="{$THEME_URL}/core/js/jquery.easing.1.3.js"></script>
		<script src="{$THEME_URL}/core/js/jquery.mobile.customized.min.js"></script>
		
			<script type="text/javascript">
			$(document).ready(function(e) {
				$('.mobile').click(function(e) {
                    e.preventDefault();
                    $('.main').slideToggle("fast");
                });
				$("#lang").selectbox({
					onChange: function(val){
						window.location.href=val;
						}
					});
			});
		</script>
