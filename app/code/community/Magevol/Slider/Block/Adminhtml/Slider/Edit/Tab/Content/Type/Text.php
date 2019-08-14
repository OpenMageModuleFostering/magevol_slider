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

class Magevol_Slider_Block_Adminhtml_Slider_Edit_Tab_Content_Type_Text extends
Magevol_Slider_Block_Adminhtml_Slider_Edit_Tab_Content_Type_Abstract
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('magevol/slider/edit/content/type/text.phtml');
	}

	protected function _prepareLayout()
	{

		$this->setChild('font_weight',
		$this->getLayout()->createBlock('adminhtml/html_select')
		->setData(array(
                    'id' => 'slider_content_{{id}}_item_{{item_id}}_font_weight',
                    'class' => 'select'
                    ))
                    );
                    $this->getChild('font_weight')->setName('slider[content][{{id}}][items][{{item_id}}][font_weight]')
                    ->setOptions(Mage::getModel('magevol_slider/system_config_source_fontweight')->toOptionArray());


                    $this->setChild('text_format',
                    $this->getLayout()->createBlock('adminhtml/html_select')
                    ->setData(array(
                    'id' => 'slider_content_{{id}}_item_{{item_id}}_text_format',
                    'class' => 'select'
                    ))
                    );
                    $this->getChild('text_format')->setName('slider[content][{{id}}][items][{{item_id}}][text_format]')
                    ->setOptions(Mage::getModel('magevol_slider/system_config_source_textformat')->toOptionArray());


                    return parent::_prepareLayout();
	}

	public function getTextFormatSelectHtml()
	{
		return $this->getChildHtml('text_format');
	}

	public function getFontWeightSelectHtml()
	{
		return $this->getChildHtml('font_weight');
	}

}
