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
class BackendSlideshowCategories extends BackendBaseActionIndex
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

		// load datagrids
		$this->loadDataGrid();

		// parse page
		$this->parse();

		// display the page
		$this->display();
	}


	/**
	 * Loads the datagrid
	 *
	 * @return	void
	 */
	private function loadDataGrid()
	{
		// create datagrid
		$this->dataGrid = new BackendDataGridDB(BackendSlideshowModel::QRY_DATAGRID_BROWSE_CATEGORIES, BL::getWorkingLanguage());

		// disable paging
		$this->dataGrid->setPaging(false);

		// enable drag and drop
		//$this->dataGrid->enableSequenceByDragAndDrop();

		// set column URLs
		$this->dataGrid->setColumnURL('name', BackendModel::createURLForAction('edit_category') . '&amp;id=[id]');

		// add edit column
		$this->dataGrid->addColumn('edit', null, BL::lbl('Edit'), BackendModel::createURLForAction('edit_category') . '&amp;id=[id]', BL::lbl('Edit'));
	}


	/**
	 * Parse & display the page
	 *
	 * @return	void
	 */
	protected function parse()
	{
		$this->tpl->assign('dataGrid', ($this->dataGrid->getNumResults() != 0) ? $this->dataGrid->getContent() : false);
	}
}

?>