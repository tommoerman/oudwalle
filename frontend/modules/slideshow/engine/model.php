<?php

/**
 * This is the configuration-object
 *
 * @package		frontend
 * @subpackage	slideshow
 *
 * @author		Vinken Koen <koen@tagz.be>
 * @since		1.0
 */
class FrontendSlideshowModel
{
	/**
	 * Get all items in a category
	 *
	 * @return	array
	 * @param	int $categoryId			The id of the category.
	 */
	public static function getImages($Id)
	{
		return (array) FrontendModel::getDB()->getRecords('SELECT i.*
															FROM slideshow_images AS i
															WHERE i.gallery_id = ? AND i.language = ?
															ORDER BY i.sequence',
															array((int) $Id, FRONTEND_LANGUAGE));
	}


	/**
	 * Get all items in a category
	 *
	 * @return	array
	 * @param	int $categoryId			The id of the category.
	 */
	public static function getGallery($Id)
	{
		return (array) FrontendModel::getDB()->getRecords('SELECT i.*
															FROM slideshow_galleries AS i
															WHERE i.id = ? AND i.language = ? AND i.hidden = ?
															ORDER BY i.sequence',
															array((int) $Id, FRONTEND_LANGUAGE, 'N'));
	}


}

?>