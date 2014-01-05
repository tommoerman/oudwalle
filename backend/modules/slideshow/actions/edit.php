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
class BackendSlideshowEdit extends BackendBaseActionEdit
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
		// get parameters
		$this->id = $this->getParameter('id', 'int');

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
		
		//spoon::dump($this->record);

		// get categories
		$this->categories = BackendSlideshowModel::getCategoriesForDropdown();
	}


	/**
	 * Load the form
	 *
	 * @return	void
	 */
	private function loadForm()
	{
		// create form
		$this->frm = new BackendForm('edit');

		// set hidden values
		$rbtHiddenValues[] = array('label' => BL::lbl('Hidden'), 'value' => 'Y');
		$rbtHiddenValues[] = array('label' => BL::lbl('Published'), 'value' => 'N');

		// create elements
		$this->frm->addText('title', $this->record['title'])->setAttribute('id', 'title');
		$this->frm->getField('title')->setAttribute('class', 'title ' . $this->frm->getField('title')->getAttribute('class'));
		$this->frm->addImage('picture');
		$this->frm->addText('width', $this->record['width']);
		$this->frm->addText('height', $this->record['height']);		
		$this->frm->addEditor('description', $this->record['description']);
		$this->frm->addDropdown('categories', $this->categories, $this->record['category_id']);
		$this->frm->addRadiobutton('hidden', $rbtHiddenValues, $this->record['hidden']);
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

			$this->frm->getField('categories')->isFilled(BL::err('CategoryIsRequired'));

			// no errors?
			if($this->frm->isCorrect())
			{
				//get the gallery data
				$item = BackendSlideshowModel::getGallery($this->id);

				// build item
				$item['id'] = $this->id;
				$item['language'] = $this->record['language'];
				$item['category_id'] = $this->frm->getField('categories')->getValue();
				$item['title'] = $this->frm->getField('title')->getValue();
				$item['description'] = $this->frm->getField('description')->getValue(true);
				$item['width'] = $this->frm->getField('width')->getValue();
				$item['height'] = $this->frm->getField('height')->getValue();				
				$item['hidden'] = $this->frm->getField('hidden')->getValue();
				if($this->frm->getField('picture')->isFilled())
				{
					// only delete the picture when there is one allready
					if(!empty($this->record['picture']))
					{
						SpoonFile::delete(FRONTEND_FILES_PATH . '/userfiles/images/slideshow/thumbnails/' . $this->record['picture']);
						SpoonFile::delete(FRONTEND_FILES_PATH . '/userfiles/images/slideshow/' . $this->record['picture']);
					}
					// create new filename
					$filename = rand(0,100000).".".$this->frm->getField('picture')->getExtension();

					$item['picture'] = $filename;

					$this->frm->getField('picture')->createThumbnail(FRONTEND_FILES_PATH . '/userfiles/images/slideshow/' . $filename, 960, 630, true, true, 100);
					$this->frm->getField('picture')->createThumbnail(FRONTEND_FILES_PATH . '/userfiles/images/slideshow/thumbnails/' . $filename, 260, 150, true, true, 100);
				}

				// update gallery values in database
				BackendSlideshowModel::updateGallery($item);

				// update the extra
				BackendSlideshowModel::updateWidgetExtras($item);

				// trigger event
				BackendModel::triggerEvent($this->getModule(), 'after_edit', array('item' => $item));

				// everything is saved, so redirect to the overview
				$this->redirect(BackendModel::createURLForAction('index') . '&report=saved&var=' . urlencode($item['title']) . '&highlight=row-' . $item['id']);
			}
		}
	}
}

?>
