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
class BackendSlideshowAddCategory extends BackendBaseActionAdd
{
	/**
	 * Execute the action
	 *
	 * @return	void
	 */
	public function execute()
	{
		// call parent, this will probably add some general CSS/JS or other required files
		parent::execute();

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
	 * Load the form
	 *
	 * @return	void
	 */
	private function loadForm()
	{
		// create form
		$this->frm = new BackendForm('add_category');

		// create elements
		$this->frm->addText('name');
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
			$this->frm->getField('name')->isFilled(BL::err('NameIsRequired'));

			// no errors?
			if($this->frm->isCorrect())
			{
				// build item
				$item['language'] = BL::getWorkingLanguage();
				$item['name'] = $this->frm->getField('name')->getValue();
				$item['sequence'] = BackendSlideshowModel::getMaximumSlideshowCategorySequence() + 1;

				// insert the item
				$item['id'] = BackendSlideshowModel::insertCategory($item);

				// trigger event
				BackendModel::triggerEvent($this->getModule(), 'after_add_category', array('item' => $item));

				// everything is saved, so redirect to the overview
				$this->redirect(BackendModel::createURLForAction('categories') . '&report=added-category&var=' . urlencode($item['name']) . '&highlight=row-' . $item['id']);
			}
		}
	}
}

?>
