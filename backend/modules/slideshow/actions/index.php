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
class BackendSlideshowIndex extends BackendBaseActionIndex
{
	/**
	 * The datagrids
	 *
	 * @var	array
	 */
	private $dataGrids;


	/**
	 * Execute the action
	 *
	 * @return	void
	 */
	public function execute()
	{
		// call parent, this will probably add some general CSS/JS or other required files
		parent::execute();

		// load the datagrids
		$this->loadDataGrids();

		// parse the datagrids
		$this->parse();

		// display the page
		$this->display();
	}


	/**
	 * Load the datagrids
	 *
	 * @return	void
	 */
	private function loadDataGrids()
	{
		// load all categories
		$categories = BackendSlideshowModel::getCategories();

		// run over categories and create datagrid for each one
		foreach($categories as $category)
		{
			// create datagrid
			$dataGrid = new BackendDataGridDB(BackendSlideshowModel::QRY_DATAGRID_BROWSE, array(BL::getWorkingLanguage(), $category['id']));
			
			// set attributes
			//$dataGrid->setAttributes(array('class' => 'dataGrid sequenceByDragAndDrop'));

			// disable paging
			$dataGrid->setPaging(false);

			// set colum URLs
			$dataGrid->setColumnURL('title', BackendModel::createURLForAction('edit') . '&amp;id=[id]');
			
			// set colums hidden
			$dataGrid->setColumnsHidden(array('category_id', 'sequence'));

			// add image column
			$dataGrid->addColumn('images', null, BL::lbl('UploadImages'), BackendModel::createURLForAction('images'). '&amp;id=[id]', BL::lbl('Add'));					

			// add edit column
			$dataGrid->addColumn('edit', null, BL::lbl('Edit'), BackendModel::createURLForAction('edit') . '&amp;id=[id]', BL::lbl('Edit'));		

			// our JS needs to know an id, so we can send the new order
			$dataGrid->setRowAttributes(array('id' => '[id]'));

			// add datagrid to list
			$this->dataGrids[] = array('id' => $category['id'],
									   'name' => $category['name'],
									   'content' => $dataGrid->getContent());
		}
	}


	/**
	 * Parse the datagrids and the reports
	 *
	 * @return	void
	 */
	protected function parse()
	{
		// parse datagrids
		if(!empty($this->dataGrids)) $this->tpl->assign('dataGrids', $this->dataGrids);
	}
}

?>