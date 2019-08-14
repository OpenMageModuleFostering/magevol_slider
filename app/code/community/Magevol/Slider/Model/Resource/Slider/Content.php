<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_Resource_Slider_Content extends Mage_Core_Model_Resource_Db_Abstract
{
	/**
	 * Define main table and initialize connection
	 *
	 */
	protected function _construct()
	{
		$this->_init('magevol_slider/slider_content', 'content_id');
	}

}
