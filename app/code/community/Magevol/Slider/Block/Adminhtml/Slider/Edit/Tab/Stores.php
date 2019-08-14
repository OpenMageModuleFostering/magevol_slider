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

class Magevol_Slider_Block_Adminhtml_Slider_Edit_Tab_Stores extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('sliders_form', array('legend'=>Mage::helper('magevol_slider')->__("Stores")));
			
		$fieldset->addField('stores', 'multiselect', array(
			'name'      => 'stores[]',
			'label' => Mage::helper('magevol_slider')->__('Store Views'),
            'title' => Mage::helper('magevol_slider')->__('Store Views'),
			'required'  => true,
			'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
		));

		if (Mage::getSingleton('adminhtml/session')->getSlidersData()) {
			$form->setValues(Mage::getSingleton('adminhtml/session')->getSlidersData());
			Mage::getSingleton('adminhtml/session')->setSlidersData(null);
		}
		elseif (Mage::registry('current_slider')) {
			$form->setValues(Mage::registry('current_slider')->getData());
		}
		return parent::_prepareForm();
	}
}