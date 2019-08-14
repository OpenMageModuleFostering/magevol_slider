<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_System_Config_Source_Buttontype extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray(){
		return  array(
		array('value' => '', 		'label' => Mage::helper('magevol_slider')->__('-- Button Type --')),
		array('value' => 'normal', 'label' => Mage::helper('magevol_slider')->__('Normal')),
		array('value' => 'ghost', 'label' => Mage::helper('magevol_slider')->__('Ghost')),
		);

	}
}
