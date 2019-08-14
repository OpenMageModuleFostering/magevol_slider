<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_System_Config_Source_Verticalalignment extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
	/**
	 * Options getter
	 *
	 * @return array
	 */
	public function toOptionArray()
	{
		return array(
		array('value' => 'default', 		'label'=>Mage::helper('magevol_slider')->__('Default')),
		array('value' => 'margin', 			'label'=>Mage::helper('magevol_slider')->__('Margin top')),
		);

	}
}
