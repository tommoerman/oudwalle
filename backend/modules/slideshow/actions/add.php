<?php

/**
 * This is the configuration-object for the slideshow module
 *
 * @package		backend
 * @subpackage	slideshow
 *
 * @author		Vinken Koen <koen@tagz.be> 
 * @author		Lecompte Pieter <info@webkings.be>
 * @since		1.0
 */
class BackendSlideshowAdd extends BackendBaseActionAdd
{
	/**
	 * The available categories
	 *
	 * @var	array
	 */
	private $categories;


	/**
	 * Execute the action
	 *
	 * @return	void
	 */
	public function execute()
	{
		// call parent, this will probably add some general CSS/JS or other required files
		parent::execute();

		// get all data
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


	/**
	 * Get the data for a question
	 *
	 * @return	void
	 */
	private function getData()
	{	
		// get categories
		$this->categories = BackendSlideshowModel::getCategoriesForDropdown();
		
		if(empty($this->categories))
		{
			$this->redirect(BackendModel::createURLForAction('add_category'));
		}		
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

		// set hidden values
		$rbtHiddenValues[] = array('label' => BL::lbl('Hidden', $this->URL->getModule()), 'value' => 'Y');
		$rbtHiddenValues[] = array('label' => BL::lbl('Published'), 'value' => 'N');

		// create elements
		$this->frm->addText('title')->setAttribute('id', 'title');
		$this->frm->getField('title')->setAttribute('class', 'title ' . $this->frm->getField('title')->getAttribute('class'));

		$this->frm->addEditor('description');

		$this->frm->addImage('picture');

		$this->frm->addDropdown('categories', $this->categories);
		$this->frm->addRadiobutton('hidden', $rbtHiddenValues, 'N');

		$this->frm->addText('width');
		$this->frm->addText('height');

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

		// assign categories
		$this->tpl->assign('categories', $this->categories);
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
			$this->frm->getField('title')->isFilled(BL::err('TitleIsRequired'));

			$this->frm->getField('categories')->isFilled(BL::err('CategoryIsRequired'));

			$this->frm->getField('width')->isFilled(BL::err('WidthIsRequired'));
			
			//$this->frm->getField('height')->isFilled(BL::err('HeightIsRequired'));
			
			if($this->frm->getField('picture')->isFilled())
			{
				// correct extension
				if($this->frm->getField('picture')->isAllowedExtension(array('jpg', 'jpeg', 'gif', 'png'), BL::err('JPGGIFAndPNGOnly')))
				{
					// correct mimetype?
					$this->frm->getField('picture')->isAllowedMimeType(array('image/gif', 'image/jpg', 'image/jpeg', 'image/png'), BL::err('JPGGIFAndPNGOnly'));
				}
			}



			// no errors?
			if($this->frm->isCorrect())
			{
				// build item
				$item['user_id'] = BackendAuthentication::getUser()->getUserId();
				$item['category_id'] = $this->frm->getField('categories')->getValue();
				$item['language'] = BL::getWorkingLanguage();
				$item['title'] = $this->frm->getField('title')->getValue();
				$item['width'] = $this->frm->getField('width')->getValue();
				$item['height'] = $this->frm->getField('height')->getValue();											
				$item['description'] = $this->frm->getField('description')->getValue(true);
				if($this->frm->getField('picture')->isFilled())
				{
					// create new filename
					$filename = rand(0,100000) .$this->frm->getField('picture')->getExtension();
					$item['picture'] = $filename;
					$this->frm->getField('picture')->createThumbnail(FRONTEND_FILES_PATH . '/userfiles/files/slideshow/' . $filename, 960, 630, true, true, 100);
				}

				$item['hidden'] = $this->frm->getField('hidden')->getValue();
				$item['sequence'] = BackendSlideshowModel::getMaximumSlideshowGallerySequence($this->frm->getField('categories')->getValue()) + 1;
				$item['created_on'] = BackendModel::getUTCDate();

				// insert the item
				$item['id'] = BackendSlideshowModel::insertGallery($item);

				//add galleryId to item
				$item['gallery_id'] = $item['id'];

				// insert widget in modules_extras	
				$item['extra_id'] = BackendSlideshowModel::insertWidgetExtras($item);

				// delete gallery_id from array
				unset($item['gallery_id']);

				//update the gallery to insert extra_id
				BackendSlideshowModel::updateGallery($item);

				// trigger event
				BackendModel::triggerEvent($this->getModule(), 'after_add', array('item' => $item));

				// everything is saved, so redirect to the overview
				$this->redirect(BackendModel::createURLForAction('index') . '&report=added&var=' . urlencode($item['title']) . '&highlight=row-' . $item['id']);
			}
		}
	}
}

?>