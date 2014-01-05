CREATE TABLE IF NOT EXISTS `slideshow_categories` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `language` varchar(5) NOT NULL,
 `name` varchar(255) NOT NULL,
 `sequence` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `slideshow_galleries` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `category_id` int(11) NOT NULL,
 `extra_id` int(4) NOT NULL,
 `language` varchar(5) NOT NULL,
 `title` varchar(255) NOT NULL,
 `description` text NOT NULL,
 `picture` varchar(255) NULL,
 `width` int(4) NOT NULL, 
 `height` int(4) NOT NULL,
 `hidden` enum('N', 'Y') NOT NULL DEFAULT 'N',
 `sequence` int(11) NOT NULL,
 `created_on` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `slideshow_images` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `gallery_id` int(11) NOT NULL,
 `language` varchar(5) NOT NULL,
 `title` varchar(255) NOT NULL,
 `description` text NOT NULL,
 `picture` varchar(255) NULL,
 `sequence` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;