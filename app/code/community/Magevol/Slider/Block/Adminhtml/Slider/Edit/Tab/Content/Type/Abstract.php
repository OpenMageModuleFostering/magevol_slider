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

class Magevol_Slider_Block_Adminhtml_Slider_Edit_Tab_Content_Type_Abstract extends Mage_Adminhtml_Block_Widget
{
	protected function _prepareLayout()
	{
		 
		$this->setChild('add_item_row_button',
		$this->getLayout()->createBlock('adminhtml/widget_button')
		->setData(array(
                    'label' => Mage::helper('magevol_slider')->__('Add New Item'),
                    'class' => 'add add-item-row',
                    'id'    => 'add_item_row_button_{{content_id}}'
                    ))
                    );
                    $this->setChild('delete_item_row_button',
                    $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                    'label' => Mage::helper('magevol_slider')->__('Delete Item'),
                    'class' => 'delete delete-item-row icon-btn',
                    'id'    => 'delete_item_row_button'
                    ))
                    );


                    $this->setChild('visibility',
                    $this->getLayout()->createBlock('adminhtml/html_select')
                    ->setData(array(
                    'id' => 'slider_content_{{id}}_item_{{item_id}}_visibility',
                    'class' => 'select'
                    ))
                    );
                    $this->getChild('visibility')->setName('slider[content][{{id}}][items][{{item_id}}][visibility]')
                    ->setOptions(Mage::getModel('magevol_slider/system_config_source_visibility')->toOptionArray());

                    return parent::_prepareLayout();
	}

	public function getAddButtonHtml()
	{
		return $this->getChildHtml('add_item_row_button');
	}

	public function getDeleteButtonHtml()
	{
		return $this->getChildHtml('delete_item_row_button');
	}


	public function getanimationStartSelectHtml()
	{
		return $this->getChildHtml('animation_start');
	}

	public function getanimationEndSelectHtml()
	{
		return $this->getChildHtml('animation_end');
	}

	public function getVisibilitySelectHtml()
	{
		return $this->getChildHtml('visibility');
	}

}
