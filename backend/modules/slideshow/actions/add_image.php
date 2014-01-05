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
class BackendSlideshowAddImage extends BackendBaseActionAdd
{

	/**
	 * Execute the action
	 *
	 * @return	void
	 */
	public function execute()
	{
		// get parameters
		$this->id = $this->getParameter('id');

		// does the item exists
		if($this->id !== null && BackendSlideshowModel::existsGallery($this->id))
		{
			// call parent, this will probably add some general CSS/JS or other required files
			parent::execute();

			// get all data for the item we want to edit
			$this->getData();

			// load the form
			$this->loadForm();

			// validate the form
			$this->validateForm();

			// parse
			$this->parse();

			// display the page
			$this->display();
		}

		// no item found, throw an exception, because somebody is fucking with our URL
		else $this->redirect(BackendModel::createURLForAction('index') . '&error=non-existing');
	}


	/**
	 * Get the data for a question
	 *
	 * @return	void
	 */
	private function getData()
	{
		// get the record
		$this->record = BackendSlideshowModel::getGallery($this->id);	
	}


	/**
	 * Load the form
	 *
	 * @return	void
	 */
	private function loadForm()
	{
		// create form
		$this->frm = new BackendForm('add');

		$this->frm->addImage('picture');
	}


	/**
	 * Parse the form
	 *
	 * @return	void
	 */
	protected function parse()
	{
		// call parent
		parent::parse();

		// assign the active record and additional variables
		$this->tpl->assign('item', $this->record);
	}


	/**
	 * Validate the form
	 *
	 * @return	void
	 */
	private function validateForm()
	{
		// is the form submitted?
		if($this->frm->isSubmitted())
		{
			// cleanup the submitted fields, ignore fields that were added by hackers
			$this->frm->cleanupFields();

			// validate fields
				if($this->frm->getField('picture')->isFilled())
				{
					// correct extension
					if($this->frm->getField('picture')->isAllowedExtension(array('jpg', 'jpeg', 'gif', 'png'), BL::err('JPGGIFAndPNGOnly')))
					{
						// correct mimetype?
						$this->frm->getField('picture')->isAllowedMimeType(array('image/gif', 'image/jpg', 'image/jpeg', 'image/png'), BL::err('JPGGIFAndPNGOnly'));
					}
				}
				
				if($this->frm->getField('picture')->isFilled(BL::err('Imaged needed')))

			// no errors?
			if($this->frm->isCorrect())
			{
				// build item
				$item['language'] = $this->record['language'];
				$item['gallery_id'] = $this->id;
				$item['sequence'] = BackendSlideshowModel::getMaximumSlideshowImageSequence($this->id) + 1;
				
				if($this->frm->getField('picture')->isFilled())
				{
					// create new filename
					$filename = rand(0,100000).".".$this->frm->getField('picture')->getExtension();

					// add filename to item
					$item['picture'] = $filename;

					// If height is not set, scale the image proportionally to the given width					
					if($this->record['height']<>0){
					// upload image width gallery dimensions (thumbnail 100 x 100)
					$this->frm->getField('picture')->createThumbnail(FRONTEND_FILES_PATH . '/userfiles/images/slideshow/' . $filename, $this->record['width'], $this->record['height'], true, false, 100);
					}else{
					$this->frm->getField('picture')->createThumbnail(FRONTEND_FILES_PATH . '/userfiles/images/slideshow/' . $filename, $this->record['width'], null, true, true, 100);
					}
					// create thumbnail
					$this->frm->getField('picture')->createThumbnail(FRONTEND_FILES_PATH . '/userfiles/images/slideshow/thumbnails/' . $filename, null, 100, false, true, 100);
				}

				// update image values in database
				BackendSlideshowModel::insertImage($item);

				// trigger event
				BackendModel::triggerEvent($this->getModule(), 'after_edit', array('item' => $item));

				// everything is saved, so redirect to the overview
				$this->redirect(BackendModel::createURLForAction('images') . '&report=saved&var=' . '&id=' . $this->id);
			}
		}
	}
}

?>
