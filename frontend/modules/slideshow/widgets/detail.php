<?php

/**
 * This is the configuration-object
 *
 * @package		frontend
 * @subpackage	slideshow
 *
 * @author		Vinken Koen <koen@tagz.be>
 * @since		1.0
 */
class FrontendSlideshowWidgetDetail extends FrontendBaseWidget
{
	/**
	 * Execute the extra
	 *
	 * @return	void
	 */
	public function execute()
	{
		// call parent
		parent::execute();

		// load template
		$this->loadTemplate();

		// parse
		$this->parse();
	}


	/**
	 * Parse
	 *
	 * @return	void
	 */
	private function parse()
	{
		$this->header->addJS('/frontend/modules/' . $this->getModule() . '/js/jquery.flexslider.js');
		$this->header->addCSS('/frontend/modules/' . $this->getModule() . '/layout/css/flexslider.css');

		$slides = FrontendSlideshowModel::getImages($this->data['gallery_id']);
		$gallery = FrontendSlideshowModel::getGallery($this->data['gallery_id']);

		$this->tpl->assign('widgetSlideshow', $slides);
		$this->tpl->assign('widgetGallery', $gallery);
		if (isset($gallery[0]['width'])){
			$this->tpl->assign('galleryWidth', $gallery[0]['width']);
		}
		
	}
}

?>