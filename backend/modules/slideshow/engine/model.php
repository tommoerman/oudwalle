<?php

/**
 * In this file we store all generic functions that we will be using in the slideshow module
 *
 * @package		backend
 * @subpackage	slideshow
 *
 * @author		Vinken Koen <koen@tagz.be> 
 * @author		Lecompte Pieter <info@webkings.be>
 * @since		1.0
 */
class BackendSlideshowModel
{
	/**
	 * Query to retrieve all galleries
	 *
	 * @var	string
	 */
	const QRY_DATAGRID_BROWSE = 'SELECT i.id, i.category_id, i.title, i.width, i.height, i.hidden, i.sequence
									FROM slideshow_galleries AS i
									WHERE i.language = ? AND i.category_id = ?
									ORDER BY i.sequence ASC';

	/**
	 * Query to retrieve all images
	 *
	 * @var	string
	 */
	const QRY_DATAGRID_BROWSE_IMAGES = 'SELECT i.id,i.title, i.description, i.picture, i.sequence
											FROM slideshow_images AS i
											WHERE i.gallery_id = ?
											ORDER BY i.sequence ASC';

	/**
	 * Query to retrieve all categories
	 *
	 * @var	string
	 */
	const QRY_DATAGRID_BROWSE_CATEGORIES = 'SELECT i.id, i.name
											FROM slideshow_categories AS i
											WHERE i.language = ?
											ORDER BY i.sequence ASC';
											
	/**
	 * Query to retrieve all widgets
	 *
	 * @var	string
	 */
	const QRY_DATAGRID_BROWSE_WIDGETS = 'SELECT i.id, i.title
											FROM slideshow_widgets AS i
											WHERE i.language = ?';											

	/**
	 * Generate html for preview
	 *
	 * @return	array
	 */	public static function getPreview($picture)
	{
		$path = FRONTEND_FILES_URL . '/userfiles/images/slideshow/thumbnails/' . $picture;
		return '<img src="' . $path . '" width="50" height="50" />';
	}

	/**
	 * Delete a specific category
	 *
	 * @return	void
	 * @param	int $id		The id of the category to be deleted.
	 */
	public static function deleteCategory($id)
	{
		// get db
		$db = BackendModel::getDB(true);

		// get item
		$item = self::getCategory($id);

		// build extra
		$extra = array('id' => $item['extra_id'],
						'module' => 'slideshow',
						'type' => 'block',
						'action' => 'category');

		// delete extra
		$db->delete('modules_extras', 'id = ? AND module = ? AND type = ? AND action = ?', array($extra['id'], $extra['module'], $extra['type'], $extra['action']));

		// delete the record
		$db->delete('slideshow_categories', 'id = ?', array((int) $id));
	}
	

	/**
	 * Create a widget
	 *
	 * @return	void
	 * @param	int $item	The details of the category to be deleted.
	 */
	public static function insertWidgetExtras($item)
	{
		// get db
		$db = BackendModel::getDB(true);

		// build extra
		$extra = array(	'id' => NULL,
						'module' => 'slideshow',
						'type' => 'widget',						
						'label' => 'Detail',
						'action' => 'detail',
						'data' =>serialize(
										array(
											'extra_label' => $item['title'],
											'gallery_id' => $item['gallery_id']
										)),
						'hidden' =>'N',
						'sequence' =>10000);						

		// insert and return the new id
		$item['id'] = $db->insert('modules_extras', $extra);

		// return the new id
		return $item['id'];		
	}	


	/**
	 * Update a widget
	 *
	 * @return	void
	 * @param	int $item	The details of the category to be deleted.
	 */
	public static function updateWidgetExtras($item)
	{
		// get db
		$db = BackendModel::getDB(true);

		// build extra
		$extra = array('id' => $item['extra_id'],
						'module' => 'slideshow',
						'type' => 'widget',						
						'label' => 'Detail',
						'action' => 'detail',
						'data' =>serialize(
										array(
											'extra_label' => $item['title'],
											'gallery_id' => $item['id']
										)),
						'hidden' =>'N',
						'sequence' =>10000);					

// update extra
$db->update('modules_extras', $extra, 'id = ? AND module = ? AND type = ? AND action = ?', array($extra['id'], $extra['module'], $extra['type'], $extra['action']));

		// return the new id
		return $item['id'];		
	}


	/**
	 * Delete a specific gallery
	 *
	 * @return	void
	 * @param	int $id		The id of the gallery to be deleted.
	 */
	public static function deleteGallery($id)
	{
		// get db
		$db = BackendModel::getDB(true);
				
		// delete the record
		$db->delete('slideshow_galleries', 'id = ?', array((int) $id));
	}

	/**
	 * Delete a specific image
	 *
	 * @return	void
	 * @param	int $id		The id of the image to be deleted.
	 */
	public static function deleteImage($id)
	{
		// get db
		$db = BackendModel::getDB(true);
				
		// delete the record
		$db->delete('slideshow_images', 'id = ?', array((int) $id));
	}	

	/**
	 * Delete a widget
	 *
	 * @return	void
	 * @param	int $id		The id of the widget to be deleted.
	 */
	public static function deleteWidget($id)
	{
		// get db
		$db = BackendModel::getDB(true);
		
		// get item
		$item = self::getGallery($id);

		// build extra
		$extra = array( 'module' => 'slideshow',
						'type' => 'widget',
						'id' => $item['extra_id']
						);

		// delete extra
		$db->delete('modules_extras', 'module = ? AND type = ? AND id = ?', array($extra['module'], $extra['type'], $extra['id']));		
		
		// delete the record
		//$db->delete('slideshow_widgets', 'id = ?', array((int) $id));
	}	
	
	
	/**
	 * Checks if a category exists
	 *
	 * @return	bool
	 * @param	int $id				The id of the category to check for existence.
	 */
	public static function existsCategory($id)
	{
		return (bool) BackendModel::getDB()->getVar('SELECT COUNT(i.id)
														FROM slideshow_categories AS i
														WHERE i.id = ? AND i.language = ?',
														array((int) $id, BL::getWorkingLanguage()));
	}


	/**
	 * Checks if a widget exists
	 *
	 * @return	bool
	 * @param	int $id				The id of the widget to check for existence.
	 */
	public static function existsWidget($id)
	{
		return (bool) BackendModel::getDB()->getVar('SELECT COUNT(i.id)
														FROM slideshow_widgets AS i
														WHERE i.id = ? AND i.language = ?',
														array((int) $id, BL::getWorkingLanguage()));
	}


	/**
	 * Checks if a gallery exists
	 *
	 * @return	bool
	 * @param	int $id				The id of the gallery to check for existence.
	 */
	public static function existsGallery($id)
	{
		return (bool) BackendModel::getDB()->getVar('SELECT COUNT(i.id)
														FROM slideshow_galleries AS i
														WHERE i.id = ? AND i.language = ?',
														array((int) $id, BL::getWorkingLanguage()));
	}


	/**
	 * Checks if an image exists
	 *
	 * @return	bool
	 * @param	int $id				The id of the image to check for existence.
	 */
	public static function existsImage($id)
	{
		return (bool) BackendModel::getDB()->getVar('SELECT COUNT(i.id)
														FROM slideshow_images AS i
														WHERE i.id = ? AND i.language = ?',
														array((int) $id, BL::getWorkingLanguage()));
	}


	/**
	 * Get all categories
	 *
	 * @return	array
	 */
	public static function getCategories()
	{
		return (array) BackendModel::getDB()->getRecords('SELECT i.*
															FROM slideshow_categories AS i
															WHERE i.language = ?
															ORDER BY i.sequence ASC',
															array(BL::getWorkingLanguage()));
	}
	
	
	/**
	 * Get all images
	 *
	 * @return	array
	 */
	public static function getImages()
	{
		return (array) BackendModel::getDB()->getRecords('SELECT i.*
															FROM slideshow_galleries AS i
															WHERE i.language = ?
															ORDER BY i.sequence ASC',
															array(BL::getWorkingLanguage()));
	}	


	/**
	 * Get all category names for dropdown
	 *
	 * @return	array
	 */
	public static function getCategoriesForDropdown()
	{
		return (array) BackendModel::getDB()->getPairs('SELECT i.id, i.name
														FROM slideshow_categories AS i
														WHERE i.language = ?
														ORDER BY i.sequence ASC',
														array(BL::getWorkingLanguage()));
	}


	/**
	 * Get all image names for dropdown
	 *
	 * @return	array
	 */
	public static function getGalleriesForDropdown()
	{
		return (array) BackendModel::getDB()->getPairs('SELECT i.id, i.title
														FROM slideshow_galleries AS i
														WHERE i.language = ?
														ORDER BY i.sequence ASC',
														array(BL::getWorkingLanguage()));
	}


	/**
	 * Get the max sequence id for category
	 *
	 * @return	int
	 * @param	int $id		The category id.	 	 
	 */
	public static function getMaximumSlideshowCategorySequence()
	{
		return (int) BackendModel::getDB()->getVar('SELECT MAX(i.sequence)
													FROM slideshow_categories AS i');
	}

	
	/**
	 * Get the max sequence id for image
	 *
	 * @return	int
	 * @param	int $id		The image id.	 
	 */
	public static function getMaximumSlideshowImageSequence($id)
	{
		return (int) BackendModel::getDB()->getVar('SELECT MAX(i.sequence)
													FROM slideshow_images AS i
													WHERE i.gallery_id = ?',
													array((int) $id)); 
	}	


	/**
	 * Get the max sequence id for gallery
	 *
	 * @return	int
	 * @param	int $id		The gallery id.
	 */
	public static function getMaximumSlideshowGallerySequence($id)
	{
		return (int) BackendModel::getDB()->getVar('SELECT MAX(i.sequence)
													FROM slideshow_galleries AS i
													WHERE i.category_id = ?',
													array((int) $id));
	}

	
	/**
	 * Get a Gallery by id
	 *
	 * @return	array
	 * @param	int $id		The gallery id.w
	 */
	public static function getGallery($id)
	{
		return (array) BackendModel::getDB()->getRecord('SELECT i.*
															FROM slideshow_galleries AS i
															WHERE i.id = ?',
															array((int) $id));
	}


	/**
	 * Get a Image by id
	 *
	 * @return	array
	 * @param	int $id		The image id.w
	 */
	public static function getImage($id)
	{
		return (array) BackendModel::getDB()->getRecord('SELECT i.*
															FROM slideshow_images AS i
															WHERE i.id = ?',
															array((int) $id));
	}


	/**
	 * Get category by id
	 *
	 * @return	array
	 * @param	int $id		The id of the category.
	 */
	public static function getCategory($id)
	{
		return (array) BackendModel::getDB()->getRecord('SELECT i.*
															FROM slideshow_categories AS i
															WHERE i.id = ?',
															array((int) $id));
	}


	/**
	 * Get a Widget by id
	 *
	 * @return	array
	 * @param	int $id		The widget id.
	 */
	public static function getWidget($id)
	{
		return (array) BackendModel::getDB()->getRecord('SELECT i.*
															FROM slideshow_widgets AS i
															WHERE i.id = ?',
															array((int) $id));
	}


	/**
	 * Get the last added widget
	 *
	 * @return	array
	 * @param	int $id		The widget id.
	 */
	public static function getLastWidget()
	{
		return (array) BackendModel::getDB()->getRecord('SELECT i.*
															FROM modules_extras AS i
															ORDER BY id DESC 
															LIMIT 1'
															);
	}	


	/**
	 * Get the last added gallery
	 *
	 * @return	array
	 * @param	int $id		The widget id.
	 */
	public static function getLastGallery()
	{
		return (array) BackendModel::getDB()->getRecord('SELECT i.*
															FROM slideshow_galleries AS i
															ORDER BY id DESC 
															LIMIT 1'
															);
	}


	/**
	 * Add a new gallery.
	 *
	 * @return	int
	 * @param	array $item		The data to insert.
	 */
	public static function insertGallery(array $item)
	{
		return BackendModel::getDB(true)->insert('slideshow_galleries', $item);
	}


	/**
	 * Add a new category.
	 *
	 * @return	int
	 * @param	array $item		The data to insert.
	 */
	public static function insertCategory(array $item)
	{
		// get db
		$db = BackendModel::getDB(true);

		// insert and return the new id
		$item['id'] = $db->insert('slideshow_categories', $item);
	
		// return the new id
		return $item['id'];
	}


	/**
	 * Create an image item
	 *
	 * @return	int
	 * @param	array $item		The data to insert.
	 */
	public static function insertImage(array $item)
	{
		return BackendModel::getDB(true)->insert('slideshow_images', $item);
	}	


	/**
	 * Add a new widget.
	 *
	 * @return	int
	 * @param	array $item		The data to insert.
	 */
	public static function insertWidget(array $item)
	{
		// get db
		$db = BackendModel::getDB(true);

		// insert and return the new id
		$item['id'] = $db->insert('slideshow_widgets', $item);
	
		// return the new id
		return $item['id'];
	}


	/**
	 * Is this category allowed to be deleted?
	 *
	 * @return	bool
	 * @param	int $id		The category id to check.
	 */
	public static function isCategoryAllowedToBeDeleted($id)
	{
		return ! (bool) BackendModel::getDB()->getVar('SELECT COUNT(i.id)
														FROM slideshow_galleries AS i
														WHERE i.category_id = ?',
														array((int) $id));
	}


	/**
	 * Update a category item
	 *
	 * @return	int
	 * @param	array $item	The updated values.
	 */
	public static function updateCategory(array $item)
	{
		// get db
		$db = BackendModel::getDB(true);

		// build extra
		$extra = array('id' => $item['extra_id'],
						'module' => 'slideshow',
						'type' => 'block',
						'label' => 'Slideshow',
						'action' => 'category',
						'data' => serialize(array('id' => $item['id'],
													'extra_label' => ucfirst(BL::lbl('Slideshow', 'core')) . ': ' . $item['name'],
													'language' => $item['language'],
													'edit_url' => BackendModel::createURLForAction('edit') . '&id=' . $item['id'])),
						'hidden' => 'N');

		// update extra
		$db->update('modules_extras', $extra, 'id = ? AND module = ? AND type = ? AND action = ?', array($extra['id'], $extra['module'], $extra['type'], $extra['action']));

		// update category
		return $db->update('slideshow_categories', $item, 'id = ? AND language = ?', array($item['id'], $item['language']));
	}

	public static function updateCategorySequence(array $item)
	{
		BackendModel::getDB(true)->update('slideshow_categories', $item, 'id = ?', array($item['id']));
	}

	public static function updateImageSequence(array $item)
	{
		BackendModel::getDB(true)->update('slideshow_images', $item, 'id = ?', array($item['id']));
	}

	/**
	 * Update a gallery item
	 *
	 * @return	int
	 * @param	array $item		The updated item.
	 */
	public static function updateGallery(array $item)
	{
		return BackendModel::getDB(true)->update('slideshow_galleries', $item, 'id = ?', array((int) $item['id']));
	}

	/**
	 * Update an image item
	 *
	 * @return	int
	 * @param	array $item		The updated item.
	 */
	public static function updateImage(array $item)
	{
		return BackendModel::getDB(true)->update('slideshow_images', $item, 'id = ?', array((int) $item['id']));
	}		
	
}

?>
