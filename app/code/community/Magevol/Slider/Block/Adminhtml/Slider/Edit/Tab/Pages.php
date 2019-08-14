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

class Magevol_Slider_Block_Adminhtml_Slider_Edit_Tab_Pages extends Mage_Adminhtml_Block_Widget_Form
{
	protected $_options;

	public function toOptionArray()
	{
		if (!$this->_options) {
			$collection = Mage::getResourceModel('cms/page_collection');
			if ($collection && $collection->count()>0) {
				foreach ($collection as $item) {
					$this->_options[] = array(
	                	'value'=> $item->getData('page_id'),
	            		'label'=> $item->getData('title'));
				}
			}
		}
		return $this->_options;
	}

	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('slider_form', array('legend'=>Mage::helper('magevol_slider')->__("Cms pages")));
			
		$fieldset->addField('pages', 'multiselect', array(
			'label'     => Mage::helper('magevol_slider')->__('Slider visible in'),
			'required'  => false,
			'name'      => 'pages[]',
			'values'    => $this->toOptionArray()
		));

		if (Mage::getSingleton('adminhtml/session')->getSliderData()) {
			$form->setValues(Mage::getSingleton('adminhtml/session')->getSliderData());
			Mage::getSingleton('adminhtml/session')->setSliderData(null);
		}
		elseif (Mage::registry('current_slider')) {
			$form->setValues(Mage::registry('current_slider')->getData());
		}
		return parent::_prepareForm();
	}
}