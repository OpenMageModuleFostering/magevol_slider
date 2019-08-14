<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_System_Config_Source_Fontweight extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray(){
		return array(
		array('value' => '', 	'label' => Mage::helper('magevol_slider')->__('-- Font Weight --')),
		array('value' => 'normal', 	'label' => Mage::helper('magevol_slider')->__('Normal')),
		array('value' => 'bold', 	'label' => Mage::helper('magevol_slider')->__('Bold')),
		array('value' => 'bolder', 	'label' => Mage::helper('magevol_slider')->__('Bolder')),
		array('value' => 'lighter', 'label' => Mage::helper('magevol_slider')->__('Lighter')),
		array('value' => '100', 	'label' => Mage::helper('magevol_slider')->__('100')),
		array('value' => '200', 	'label' => Mage::helper('magevol_slider')->__('200')),
		array('value' => '300', 	'label' => Mage::helper('magevol_slider')->__('300')),
		array('value' => '400', 	'label' => Mage::helper('magevol_slider')->__('400')),
		array('value' => '500', 	'label' => Mage::helper('magevol_slider')->__('500')),
		array('value' => '600', 	'label' => Mage::helper('magevol_slider')->__('600')),
		array('value' => '700', 	'label' => Mage::helper('magevol_slider')->__('700')),
		array('value' => '800', 	'label' => Mage::helper('magevol_slider')->__('800')),
		array('value' => '900', 	'label' => Mage::helper('magevol_slider')->__('900')),
		array('value' => 'inherit', 'label' => Mage::helper('magevol_slider')->__('Inherit'))
		);

	}
}
