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

class Magevol_Slider_Block_Adminhtml_Slider_Edit_Tab_Content extends Mage_Adminhtml_Block_Widget
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('magevol/slider/edit/content.phtml');
	}


	protected function _prepareLayout()
	{
		$this->setChild('add_button',
		$this->getLayout()->createBlock('adminhtml/widget_button')
		->setData(array(
                    'label' => Mage::helper('magevol_slider')->__('Add New Content'),
                    'class' => 'add',
                    'id'    => 'add_new_defined_content'
                    ))
                    );

                    $this->setChild('content_box',
                    $this->getLayout()->createBlock('magevol_slider/adminhtml_slider_edit_tab_content_content')
                    );

                    return parent::_prepareLayout();
	}

	public function getAddButtonHtml()
	{
		return $this->getChildHtml('add_button');
	}

	public function getContentBoxHtml()
	{
		return $this->getChildHtml('content_box');
	}

}
