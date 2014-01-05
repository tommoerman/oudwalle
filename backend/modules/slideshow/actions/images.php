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
class BackendSlideshowImages extends BackendBaseActionAdd
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
		
		// call parent, this will probably add some general CSS/JS or other required files
		parent::execute();

		// get all data for the item we want to edit
		$this->getData();		

		// load datagrids
		$this->loadDataGrid();

		// parse page
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
		// get the record
		$this->record = BackendSlideshowModel::getGallery($this->id);
	}

	/**
	 * Loads the datagrid
	 *
	 * @return	void
	 */
	private function loadDataGrid()
	{
		// create datagrid
		$this->dataGrid = new BackendDataGridDB(BackendSlideshowModel::QRY_DATAGRID_BROWSE_IMAGES, array($this->id));

		// disable paging
		$this->dataGrid->setPaging(false);
		
		// create a thumbnail preview		
		$this->dataGrid->addColumn('preview', SpoonFilter::ucfirst(BL::lbl('Preview')));
		$this->dataGrid->setColumnFunction(array('BackendSlideshowModel', 'getPreview'),'[picture]', 'preview', true);
		
		// enable drag and drop
		$this->dataGrid->enableSequenceByDragAndDrop();

		// add edit column
		$this->dataGrid->addColumn('edit', null, BL::lbl('Edit'), BackendModel::createURLForAction('edit_image') . '&amp;id=[id]&amp;galleryid='. $this->id, BL::lbl('Edit'));
	}


	/**
	 * Parse & display the page
	 *
	 * @return	void
	 */
	protected function parse()
	{
		// assign the active record and additional variables
		$this->tpl->assign('item', $this->record);
		
		$this->tpl->assign('dataGrid', ($this->dataGrid->getNumResults() != 0) ? $this->dataGrid->getContent() : false);
	}
}

?>
