<?php
/**
 * Magevol Slider
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA that is bundled with this package
 * in the file license.txt.
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This package designed for Magento community edition
 * MageEvol does not guarantee correct work of this extension
 * on any other Magento edition except Magento community edition.
 * MageEvol does not provide extension support in case of incorrect edition usage.
 * =================================================================
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Block_Adminhtml_Slider_Edit_Tab_Images extends Mage_Adminhtml_Block_Widget_Form
{
	/**
	 * prepare the form
	 * @access protected
	 * @return LogoSlider_Logo_Block_Adminhtml_Logo_Edit_Tab_Form
	 */
	protected function _prepareForm(){
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('slide_form', array('legend'=>Mage::helper('magevol_slider')->__('Image')));

		$fieldset->addField('slider_image', 'image', array(
            'label' => Mage::helper('magevol_slider')->__('Image slider'),
            'name'  => 'slider_image',

		));


		$formValues = Mage::registry('current_slider')->getDefaultValues();
		if (!is_array($formValues)){
			$formValues = array();
		}
		if (Mage::getSingleton('adminhtml/session')->getSlideData()){
			$formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getSlideData());
			Mage::getSingleton('adminhtml/session')->setSlideData(null);
		}
		elseif (Mage::registry('current_slider')){
			$formValues = array_merge($formValues, Mage::registry('current_slider')->getData());
		}
		$form->setValues($formValues);
		return parent::_prepareForm();
	}
}
