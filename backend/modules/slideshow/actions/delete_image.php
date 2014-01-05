<?php

/**
 * This is the configuration-object for the slideshow module
 *
 * @package		backend
 * @subpackage	slideshow
 *
 * @author		Vinken Koen <koen@tagz.be>
 * @since		1.0
 */
class BackendSlideshowDeleteImage extends BackendBaseActionDelete
{
	/**
	 * Execute the action
	 *
	 * @return	void
	 */
	public function execute()
	{
		// get parameters
		$this->id = $this->getParameter('id', 'int');
		$this->slideshow_id = $this->getParameter('gallery_id', 'int');

		// does the item exist
		if($this->id !== null && BackendSlideshowModel::existsImage($this->id))
		{
			// call parent, this will probably add some general CSS/JS or other required files
			parent::execute();

			// get item
			$this->record = BackendSlideshowModel::getImage($this->id);
			
			// delete the image and thumbnail
			SpoonFile::delete(FRONTEND_FILES_PATH . '/userfiles/images/slideshow/thumbnails/' . $this->record['picture']);
			SpoonFile::delete(FRONTEND_FILES_PATH . '/userfiles/images/slideshow/' . $this->record['picture']);			

			// delete item
			BackendSlideshowModel::deleteImage($this->id);

			// item was deleted, so redirect
			$this->redirect(BackendModel::createURLForAction('images') . '&report=deleted&id=' . $this->slideshow_id);
		}

		// something went wrong
		else $this->redirect(BackendModel::createURLForAction('images') . '&error=non-existing&id=' . $this->slideshow_id);
	}
}

?>