{option:widgetGallery}
<div class="flex-container" style="max-width:{$galleryWidth}px">
<div class="flexslider">
	<ul class="slides">
		{iteration:widgetSlideshow}					
    <li>
      <img src="/frontend/files/userfiles/images/slideshow/{$widgetSlideshow.picture}" alt="{$widgetSlideshow.title}" />
      {option:widgetSlideshow.title}<p class="flex-caption">{$widgetSlideshow.title}</p>{/option:widgetSlideshow.title}
    </li>
		{/iteration:widgetSlideshow}
	</ul>
</div>
</div>
{/option:widgetGallery}
