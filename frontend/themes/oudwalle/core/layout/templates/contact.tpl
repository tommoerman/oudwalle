	{include:core/layout/templates/head.tpl}

	<body class="{$LANGUAGE} contactpage" itemscope itemtype="http://schema.org/WebPage">
		<div class="wrapper">
			{include:core/layout/templates/header.tpl}
			<div class="container">
			<div class="contact twelve columns omega">
                <div class="balk top"></div>
				<section class="content">
                  <div class="links">
                  	{iteration:positionLeftTopTitle}
								{$positionLeftTopTitle.blockContent}
							{/iteration:positionLeftTopTitle}
                    <p>
                    	<strong>Oud Walle</strong><br />
                        <span class="icon-location"></span> Koning Albertstraat 4,<br />
                        &nbsp;&nbsp;&nbsp;8500 Kortrijk<br />
                        <span class="icon-mail"></span> <a href="mailto=info@oudwalle.be">info@oudwalle.be</a><br />
                        <span class="icon-calendar-empty"></span>                    
							{iteration:positionLeftTop}
								{$positionLeftTop.blockContent}
							{/iteration:positionLeftTop}
							<br />
                        <span class="icon-phone"></span> 056 22 65 53<br />
                    </p>                  
                    {iteration:positionLeft}
						{$positionLeft.blockContent}
					{/iteration:positionLeft}
                  </div>
                  <div id="map"></div>
                  <div class="clear_div"></div>
                  {iteration:positionMain}
						{$positionMain.blockContent}
					{/iteration:positionMain}
                  <form>
                  	<div class="links">
                        <div class="textbox">	
                            <span class="icon icon-user"></span>
                          	<input name="name" placeholder="Naam" type="text" value="" />
                        </div>
                        <div class="textbox">	
                            <span class="icon icon-phone"></span>
                          	<input name="tel" placeholder="Tel" type="tel" value="" />
                        </div>
                        <div class="textbox">	
                            <span class="icon icon-mail"></span>
                          	<input name="email" placeholder="E-mail" type="text" value="" />
                        </div>
					</div>
                  	<div class="rechts">
                        <div class="textbox">	
                            <span class="icon icon-comment"></span>
                          	<textarea name="vragen-suggesties" placeholder="Vragen of suggesties"></textarea>
                        </div>
                        <input type="submit" value="Verstuur" class="submit" /><span class="icon-ok-1"></span> 
					</div>
                  </form>
              </section>
                <div class="balk bottom"></div>
            </div>
        </div>
        <div class="push"></div>
    </div>

		{include:core/layout/templates/footer.tpl}
		
		{* Site wide HTML *}
		{$siteHTMLFooter}
		
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&language=nl"></script>
    <script type="text/javascript">
    $(document).ready(function(e) {
		maps();       
    });
	function maps() {
		var myLatlng = new google.maps.LatLng(50.825266, 3.263604);
		var image = '{$THEME_URL}/core/layout/images/marker.png';   
		var myOptions = {
			zoom: 15,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControl: false,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL
			},
			streetViewControl: true,
			scrollwheel: true
		};
		var map = new google.maps.Map(document.getElementById("map"), myOptions);
		var marker = new google.maps.Marker({
			position: myLatlng, 
			map: map,
			icon: image
		});
	}

    </script>
		
	</body>
</html>
