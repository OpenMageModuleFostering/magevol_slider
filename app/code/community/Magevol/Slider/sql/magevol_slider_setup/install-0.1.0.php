<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;
$installer->startSetup();

$installer->run("
CREATE TABLE IF NOT EXISTS `{$this->getTable('magevol_slider/slider')}` (
  `slider_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NULL DEFAULT '',
  `sort_order` int(11) NULL DEFAULT 0,
  `has_contents` tinyint(1) NULL DEFAULT '0',
  `is_active` tinyint(1) NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Created At',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Updated At',
  
  `slider_image` varchar(255) NULL DEFAULT '',
  
  PRIMARY KEY  (`slider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('magevol_slider/slider_content')}` (
  `content_id` int(11) unsigned NOT NULL auto_increment,
  `slider_id` int(11) unsigned NOT NULL,
  `type` varchar(255) NULL DEFAULT '',
  `sort_order` int(11) NULL DEFAULT 0,
  `width` varchar(255) NULL DEFAULT '35%',
  `horizontal_position` varchar(255) NULL DEFAULT '',
  `vertical_position` varchar(255) NULL DEFAULT '',
  `horizontal_position_value` varchar(255) NULL DEFAULT '',
  `vertical_position_value` varchar(255) NULL DEFAULT '',
  `content_alignment` varchar(255) NULL DEFAULT '',
  
  PRIMARY KEY (`content_id`,`slider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('magevol_slider/slider_content_text')}` (
  `content_type_id` int(11) unsigned NOT NULL auto_increment,
  `content_id` int(11) unsigned NOT NULL,
  `text` varchar(255) NULL DEFAULT '',
  `text_color` varchar(255) NULL DEFAULT '',
  `background_color` varchar(255) NULL DEFAULT '',
  `text_align` varchar(255) NULL DEFAULT '',
  `text_format` varchar(255) NULL DEFAULT '',
  `font_size` varchar(255) NULL DEFAULT '',
  `font_weight` varchar(255) NULL DEFAULT '',
  `link` varchar(255) NULL DEFAULT '',
  `animation_start` varchar(255) NULL DEFAULT '',
  `animation_end` varchar(255) NULL DEFAULT '',
  `animation_delay` varchar(255) NULL DEFAULT '',
  `visibility` varchar(255) NULL DEFAULT '',
  `sort_order` int(11) NULL DEFAULT 0,
  
  PRIMARY KEY (`content_type_id`,`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('magevol_slider/slider_content_button')}` (
  `content_type_id` int(11) unsigned NOT NULL auto_increment,
  `content_id` int(11) unsigned NOT NULL,
  `text` varchar(255) NULL DEFAULT '',
  `text_color` varchar(255) NULL DEFAULT '',
  `text_color_hover` varchar(255) NULL DEFAULT '',
  `button_type` varchar(255) NULL DEFAULT '',
  `background_color` varchar(255) NULL DEFAULT '',
  `background_color_hover` varchar(255) NULL DEFAULT '',
  `link` varchar(255) NULL DEFAULT '',
  `animation_start` varchar(255) NULL DEFAULT '',
  `animation_end` varchar(255) NULL DEFAULT '',
  `animation_delay` varchar(255) NULL DEFAULT '',
  `visibility` varchar(255) NULL DEFAULT '',
  `sort_order` int(11) NULL DEFAULT 0,
  
  PRIMARY KEY (`content_type_id`,`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('magevol_slider/stores')}` (
  `slider_id` int(11) unsigned NOT NULL auto_increment,
  `store_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`slider_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('magevol_slider/pages')}` (
  `slider_id` int(11) unsigned NOT NULL auto_increment,
  `page_id` smallint(6) NOT NULL,
  PRIMARY KEY (`slider_id`,`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `{$this->getTable('magevol_slider/categories')}` (
  `slider_id` int(11) unsigned NOT NULL auto_increment,
  `category_id` int(10) NOT NULL,
  PRIMARY KEY (`slider_id`,`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
");
$installer->endSetup();