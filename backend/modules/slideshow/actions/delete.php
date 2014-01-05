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
class BackendSlideshowDelete extends BackendBaseActionDelete
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
		if($this->id !== null && BackendSlideshowModel::existsGallery($this->id))
		{
			// call parent, this will probably add some general CSS/JS or other required files
			parent::execute();

			// get item
			$this->record = BackendSlideshowModel::getGallery($this->id);

			// delete widget from modules_extra
			BackendSlideshowModel::deleteWidget($this->id);	

			// delete item
			BackendSlideshowModel::deleteGallery($this->id);

			// trigger event
			BackendModel::triggerEvent($this->getModule(), 'after_delete', array('id' => $this->id));

			// item was deleted, so redirect
			$this->redirect(BackendModel::createURLForAction('index') . '&report=deleted');
		}

		// something went wrong
		else $this->redirect(BackendModel::createURLForAction('index') . '&error=non-existing');
	}
}

?>