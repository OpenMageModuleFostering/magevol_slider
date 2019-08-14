<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Helper_Data extends Mage_Core_Helper_Abstract
{

	public function getTransitionStyle()
	{
		return Mage::getStoreConfig('magevol_slider/general/transition');
	}
	public function getPaginationSpeed()
	{
		return Mage::getStoreConfig('magevol_slider/general/pagination_speed');
	}
	public function getSlideSpeed()
	{
		return Mage::getStoreConfig('magevol_slider/general/slide_speed');
	}
	public function getRewindSpeed()
	{
		return Mage::getStoreConfig('magevol_slider/general/rewind_speed');
	}
	public function getAutoPlay()
	{
		return Mage::getStoreConfig('magevol_slider/general/auto_play');
	}
	public function getStopOnHover()
	{
		return Mage::getStoreConfig('magevol_slider/general/stop_on_hover');
	}

}
