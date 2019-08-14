<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_System_Config_Source_Textformat extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray(){
		return array(
		array('value' => 'p', 	'label' => Mage::helper('magevol_slider')->__('-- Text Format --')),
		array('value' => 'p', 	'label' => Mage::helper('magevol_slider')->__('Paragraph')),
		array('value' => 'h1', 	'label' => Mage::helper('magevol_slider')->__('H1')),
		array('value' => 'h2', 	'label' => Mage::helper('magevol_slider')->__('H2')),
		array('value' => 'h3', 	'label' => Mage::helper('magevol_slider')->__('H3')),
		array('value' => 'h4', 	'label' => Mage::helper('magevol_slider')->__('H4')),
		array('value' => 'h5', 	'label' => Mage::helper('magevol_slider')->__('H5')),
		array('value' => 'h6', 	'label' => Mage::helper('magevol_slider')->__('H6')),
		);

	}
}
