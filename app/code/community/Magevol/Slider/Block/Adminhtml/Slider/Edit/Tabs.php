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

class Magevol_Slider_Block_Adminhtml_Slider_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

	public function __construct()
	{
		parent::__construct();
		$this->setId('slider_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('magevol_slider')->__('Slider'));
	}

	protected function _beforeToHtml()
	{
		$this->addTab('general_section', array(
          	'label'     => Mage::helper('magevol_slider')->__('<i class="fa fa-cog fa-fw" aria-hidden="true"></i>&nbsp; General'),
          	'title'     => Mage::helper('magevol_slider')->__('General'),
          	'content'   => $this->getLayout()->createBlock('magevol_slider/adminhtml_slider_edit_tab_general')->toHtml(),
		));

		$this->addTab('content_section', array(
          	'label'     => Mage::helper('magevol_slider')->__('<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>&nbsp; Content'),
          	'title'     => Mage::helper('magevol_slider')->__('Content'),
          	'content'   => $this->getLayout()->createBlock('magevol_slider/adminhtml_slider_edit_tab_content')->toHtml(),
		));

		$this->addTab('images_section', array(
            'label'        => Mage::helper('magevol_slider')->__('<i class="fa fa-picture-o fa-fw" aria-hidden="true"></i>&nbsp; Image'),
            'title'        => Mage::helper('magevol_slider')->__('Image'),
            'content'     => $this->getLayout()->createBlock('magevol_slider/adminhtml_slider_edit_tab_images')->toHtml(),
		));

		$this->addTab('cms_pages_section', array(
          	'label'     => Mage::helper('magevol_slider')->__('<i class="fa fa-bars fa-fw" aria-hidden="true"></i>&nbsp; Cms pages'),
          	'title'     => Mage::helper('magevol_slider')->__('Cms pages'),
          	'content'   => $this->getLayout()->createBlock('magevol_slider/adminhtml_slider_edit_tab_pages')->toHtml(),
		));

		$this->addTab('categories_section', array(
          	'label'     => Mage::helper('magevol_slider')->__('<i class="fa fa-align-left fa-fw" aria-hidden="true"></i>&nbsp; Categories'),
          	'title'     => Mage::helper('magevol_slider')->__('Categories'),
          	'content'   => $this->getLayout()->createBlock('magevol_slider/adminhtml_slider_edit_tab_categories')->toHtml(),
		));

		$this->addTab('stores_section', array(
          	'label'     => Mage::helper('magevol_slider')->__('<i class="fa fa-filter fa-fw" aria-hidden="true"></i>&nbsp; Stores'),
          	'title'     => Mage::helper('magevol_slider')->__('Stores'),
          	'content'   => $this->getLayout()->createBlock('magevol_slider/adminhtml_slider_edit_tab_stores')->toHtml(),
		));
			
		return parent::_beforeToHtml();
	}
}