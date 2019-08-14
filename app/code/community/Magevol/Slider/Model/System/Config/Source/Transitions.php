<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_System_Config_Source_Transitions extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		return array(
		array('value' => '', 		'label'=>Mage::helper('magevol_slider')->__('Slide')),
		array('value' => 'fade',  		'label'=>Mage::helper('magevol_slider')->__('Fade')),
		array('value' => 'backSlide',  	'label'=>Mage::helper('magevol_slider')->__('BackSlide')),
		array('value' => 'goDown',  	'label'=>Mage::helper('magevol_slider')->__('GoDown')),
		array('value' => 'fadeUp',  	'label'=>Mage::helper('magevol_slider')->__('FadeUp')),
		);

	}
}
