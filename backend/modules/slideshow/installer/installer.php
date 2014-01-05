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
class SlideshowInstaller extends ModuleInstaller
{
	/**
	 * Install the module
	 *
	 * @return	void
	 */
	public function install()
	{	
		// load install.sql
		$this->importSQL(dirname(__FILE__) . '/data/install.sql');

		// add 'slideshow' as a module
		$this->addModule('slideshow');

		// import locale
		$this->importLocale(dirname(__FILE__) . '/data/locale.xml');

		// module rights
		$this->setModuleRights(1, 'slideshow');

		// action rights
		$this->setActionRights(1, 'slideshow', 'index');
		$this->setActionRights(1, 'slideshow', 'add');
		$this->setActionRights(1, 'slideshow', 'edit');
		$this->setActionRights(1, 'slideshow', 'delete');
		$this->setActionRights(1, 'slideshow', 'sequence');
		$this->setActionRights(1, 'slideshow', 'categories');
		$this->setActionRights(1, 'slideshow', 'add_category');
		$this->setActionRights(1, 'slideshow', 'edit_category');
		$this->setActionRights(1, 'slideshow', 'delete_category');
		$this->setActionRights(1, 'slideshow', 'images');
		$this->setActionRights(1, 'slideshow', 'add_image');
		$this->setActionRights(1, 'slideshow', 'edit_image');
		$this->setActionRights(1, 'slideshow', 'delete_image');		
		
		// set navigation
		$navigationModulesId = $this->setNavigation(null, 'Modules');
		$navigationBlogId = $this->setNavigation($navigationModulesId, 'Slideshow');
		$this->setNavigation($navigationBlogId, 'Galleries', 'slideshow/index', array('slideshow/add',	'slideshow/edit',	'slideshow/images',	'slideshow/edit_image',	'slideshow/add_image'));
		$this->setNavigation($navigationBlogId, 'Categories', 'slideshow/categories', array('slideshow/add_category',	'slideshow/edit_category'));
		
	}
}

?>