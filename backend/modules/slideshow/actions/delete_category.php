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
class BackendSlideshowDeleteCategory extends BackendBaseActionDelete
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

		// does the item exist
		if($this->id !== null && BackendSlideshowModel::existsCategory($this->id))
		{
			// call parent, this will probably add some general CSS/JS or other required files
			parent::execute();

			// get item
			$this->record = BackendSlideshowModel::getCategory($this->id);

			// delete item
			BackendSlideshowModel::deleteCategory($this->id);

			// trigger event
			BackendModel::triggerEvent($this->getModule(), 'after_delete_category', array('id' => $this->id));

			// item was deleted, so redirect
			$this->redirect(BackendModel::createURLForAction('categories') . '&report=deleted&var=' . urlencode($this->record['name']));
		}

		// something went wrong
		else $this->redirect(BackendModel::createURLForAction('categories') . '&error=non-existing');
	}
}

?>