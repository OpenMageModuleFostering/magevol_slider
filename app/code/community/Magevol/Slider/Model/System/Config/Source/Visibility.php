<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_System_Config_Source_Visibility extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		return array(
		array('value' => '', 											'label'=>Mage::helper('magevol_slider')->__('-- Visibility --')),
		array('value' => 'visible-xs hidden-sm hidden-md hidden-lg', 	'label'=>Mage::helper('magevol_slider')->__('show-for-extra-small-only')),
		array('value' => 'visible-xs visible-sm visible-md visible-lg',	'label'=>Mage::helper('magevol_slider')->__('show-for-extra-small-up')),
		array('value' => 'hidden-xs visible-sm hidden-md hidden-lg', 	'label'=>Mage::helper('magevol_slider')->__('show-for-small-only')),
		array('value' => 'hidden-xs visible-sm visible-md visible-lg', 	'label'=>Mage::helper('magevol_slider')->__('show-for-small-up')),
		array('value' => 'visible-xs visible-sm hidden-md hidden-lg', 	'label'=>Mage::helper('magevol_slider')->__('show-for-small-down')),
		array('value' => 'hidden-xs visible-sm visible-md hidden-lg', 	'label'=>Mage::helper('magevol_slider')->__('show-for-small-and-medium')),
		array('value' => 'hidden-xs hidden-sm visible-md hidden-lg', 	'label'=>Mage::helper('magevol_slider')->__('show-for-medium-only')),
		array('value' => 'hidden-xs hidden-sm visible-md visible-lg',	'label'=>Mage::helper('magevol_slider')->__('show-for-medium-up')),
		array('value' => 'visible-xs visible-sm visible-md hidden-lg', 	'label'=>Mage::helper('magevol_slider')->__('show-for-medium-down')),
		array('value' => 'hidden-xs hidden-sm hidden-md visible-lg', 	'label'=>Mage::helper('magevol_slider')->__('show-for-large-up')),
		);

	}
}
