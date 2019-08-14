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

class Magevol_Slider_Block_Adminhtml_Slider_Edit_Tab_Content_Type_Button extends
Magevol_Slider_Block_Adminhtml_Slider_Edit_Tab_Content_Type_Abstract
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('magevol/slider/edit/content/type/button.phtml');
	}

	protected function _prepareLayout()
	{

		$this->setChild('button_type',
		$this->getLayout()->createBlock('adminhtml/html_select')
		->setData(array(
                    'id' => 'slider_content_{{id}}_item_{{item_id}}_button_type',
                    'class' => 'select'
                    ))
                    );
                    $this->getChild('button_type')->setName('slider[content][{{id}}][items][{{item_id}}][button_type]')
                    ->setOptions(Mage::getModel('magevol_slider/system_config_source_buttontype')->toOptionArray());


                    return parent::_prepareLayout();
	}

	public function getButtonTypeSelectHtml()
	{
		return $this->getChildHtml('button_type');
	}

	public function getButtonStyleSelectHtml()
	{
		return $this->getChildHtml('button_style');
	}

	public function getButtonSizeSelectHtml()
	{
		return $this->getChildHtml('button_size');
	}

}
