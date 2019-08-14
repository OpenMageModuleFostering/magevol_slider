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

class Magevol_Slider_Block_Adminhtml_Slider_Edit_Tab_Content_Content extends Mage_Adminhtml_Block_Widget
{
	protected $_slider;

	protected $_sliderInstance;

	protected $_values;

	protected $_itemCount = 1;

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('magevol/slider/edit/content/content.phtml');
	}

	public function getItemCount()
	{
		return $this->_itemCount;
	}

	public function setItemCount($itemCount)
	{
		$this->_itemCount = max($this->_itemCount, $itemCount);
		return $this;
	}

	/**
	 * Get Slider
	 *
	 * @return Magevol_Slider_Model_Slider
	 */
	public function getSlider()
	{
		if (!$this->_sliderInstance) {
			if ($slider = Mage::registry('slider')) {
				$this->_sliderInstance = $slider;
			} else {
				$this->_sliderInstance = Mage::getSingleton('magevol_slider/slider');
			}
		}

		return $this->_sliderInstance;
	}

	public function setSlider($slider)
	{
		$this->_sliderInstance = $slider;
		return $this;
	}

	/**
	 * Retrieve content field name prefix
	 *
	 * @return string
	 */
	public function getFieldName()
	{
		return 'slider[content]';
	}

	/**
	 * Retrieve content field id prefix
	 *
	 * @return string
	 */
	public function getFieldId()
	{
		return 'slider_content';
	}

	/**
	 * Check block is readonly
	 *
	 * @return boolean
	 */
	public function isReadonly()
	{
		return $this->getSlider()->getContentReadonly();
	}

	protected function _prepareLayout()
	{
		$this->setChild('delete_button',
		$this->getLayout()->createBlock('adminhtml/widget_button')
		->setData(array(
                    'label' => Mage::helper('catalog')->__('Delete Content'),
                    'class' => 'delete delete-content '
                    ))
                    );

                    $path = 'global/slider/content/custom/groups';

                    foreach (Mage::getConfig()->getNode($path)->children() as $group) {
                    	$this->setChild($group->getName() . '_content_type',
                    	$this->getLayout()->createBlock(
                    	(string) Mage::getConfig()->getNode($path . '/' . $group->getName() . '/render')
                    	)
                    	);
                    }


                    $this->setChild('content_type',
                    $this->getLayout()->createBlock('adminhtml/html_select')
                    ->setData(array(
                    'id' => $this->getFieldId().'_{{id}}_type',
                	'class' => 'select select_content_type required-entry'
                	))
                	);
                	$this->getChild('content_type')->setName($this->getFieldName().'[{{id}}][type]')
                	->setOptions(Mage::getModel('magevol_slider/system_config_source_contenttype')->toOptionArray());


                	$this->setChild('position_absolute',
                	$this->getLayout()->createBlock('adminhtml/html_select')
                	->setData(array(
                    'id' => 'content_position_absolute_{{id}}',
                	'value'=> 0,
                    'class' => 'select'
                    ))
                    );
                    $this->getChild('position_absolute')->setName('slider[content][{{id}}][position_absolute]')
                    ->setOptions(Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray());


                    $this->setChild('horizontal_position',
                    $this->getLayout()->createBlock('adminhtml/html_select')
                    ->setData(array(
                    'id' => 'slider_content_{{id}}_horizontal_position',
                    'class' => 'select horizontal_position'
                    ))
                    );
                    $this->getChild('horizontal_position')->setName('slider[content][{{id}}][horizontal_position]')
                    ->setOptions(Mage::getModel('magevol_slider/system_config_source_horizontalalignment')->toOptionArray());

                    $this->setChild('absolute_horizontal_position',
                    $this->getLayout()->createBlock('adminhtml/html_select')
                    ->setData(array(
                    'id' => 'slider_content_{{id}}_absolute_horizontal_position',
                    'class' => 'select horizontal_position'
                    ))
                    );
                    $this->getChild('absolute_horizontal_position')->setName('slider[content][{{id}}][absolute_horizontal_position]')
                    ->setOptions(Mage::getModel('magevol_slider/system_config_source_absolutehorizontalalignment')->toOptionArray());


                    $this->setChild('vertical_position',
                    $this->getLayout()->createBlock('adminhtml/html_select')
                    ->setData(array(
                    'id' => 'slider_content_{{id}}_vertical_position',
                    'class' => 'select vertical_position'
                    ))
                    );
                    $this->getChild('vertical_position')->setName('slider[content][{{id}}][vertical_position]')
                    ->setOptions(Mage::getModel('magevol_slider/system_config_source_verticalalignment')->toOptionArray());
                     
                    $this->setChild('absolute_vertical_position',
                    $this->getLayout()->createBlock('adminhtml/html_select')
                    ->setData(array(
                    'id' => 'slider_content_{{id}}_absolute_vertical_position',
                    'class' => 'select vertical_position'
                    ))
                    );
                    $this->getChild('absolute_vertical_position')->setName('slider[content][{{id}}][absolute_vertical_position]')
                    ->setOptions(Mage::getModel('magevol_slider/system_config_source_absoluteverticalalignment')->toOptionArray());

                    $this->setChild('content_alignment',
                    $this->getLayout()->createBlock('adminhtml/html_select')
                    ->setData(array(
                    'id' => 'slider_content_{{id}}_content_alignment',
                    'class' => 'select vertical_position'
                    ))
                    );
                    $this->getChild('content_alignment')->setName('slider[content][{{id}}][content_alignment]')
                    ->setOptions(Mage::getModel('magevol_slider/system_config_source_contentalignment')->toOptionArray());


                    return parent::_prepareLayout();
	}

	public function getAddButtonId()
	{
		$buttonId = $this->getLayout()
		->getBlock('admin.slider.content')
		->getChild('add_button')->getId();
		return $buttonId;
	}

	public function getDeleteButtonHtml()
	{
		return $this->getChildHtml('delete_button');
	}

	/**
	 * Retrieve html templates for different types of slider custom content
	 *
	 * @return string
	 */
	public function getTemplatesHtml()
	{
		$path = 'global/slider/content/custom/groups';

		$templates = '';
		foreach (Mage::getConfig()->getNode($path)->children() as $group) {
			$templates .= $this->getChildHtml($group->getName() .'_content_type'). "\n" ;
		}

		return $templates;
	}

	public function getTypeSelectHtml()
	{
		return $this->getChildHtml('content_type');
	}

	public function getPositionAbsoluteSelectHtml()
	{
		return $this->getChildHtml('position_absolute');
	}

	public function getHorizontalPositionSelectHtml()
	{
		return $this->getChildHtml('horizontal_position');
	}
	public function getAbsoluteHorizontalPositionSelectHtml()
	{
		return $this->getChildHtml('absolute_horizontal_position');
	}

	public function getVerticalPositionSelectHtml()
	{
		return $this->getChildHtml('vertical_position');
	}
	public function getAbsoluteVerticalPositionSelectHtml()
	{
		return $this->getChildHtml('absolute_vertical_position');
	}

	public function getContentAlignmentSelectHtml()
	{
		return $this->getChildHtml('content_alignment');
	}

	public function getContentValues()
	{
		$contentArr = array_reverse($this->getSlider()->getContents(), true);
		if (!$this->_values) {
			$values = array();
			foreach ($contentArr as $content) {
				/* @var $content Magevol_Slider_Model_Slider_Content */
				$this->setItemCount($content->getContentId());

				$value = array();
				$value['id'] = $content->getContentId();
				$value['item_count'] = $this->getItemCount();
				$value['slider_id'] = $content->getSliderId();
				$value['content_id'] = $content->getContentId();
				$value['sort_order'] = $content->getSortOrder();
				$value['type'] = $content->getType();
				$value['width'] = $content->getWidth();
				$value['position_absolute'] = $content->getPositionAbsolute();
				$value['absolute_horizontal_position'] = $content->getAbsoluteHorizontalPosition();
				$value['horizontal_position'] = $content->getHorizontalPosition();
				$value['absolute_vertical_position'] = $content->getAbsoluteVerticalPosition();
				$value['vertical_position'] = $content->getVerticalPosition();
				$value['horizontal_position_value'] = $content->getHorizontalPositionValue();
				$value['vertical_position_value'] = $content->getVerticalPositionValue();
				$value['content_alignment'] = $content->getContentAlignment();

				$itemCount = 0;
				$i = 0;
				if($type = $content->getType()){
					foreach ($content->getItems() as $_item) {
						$value['contentValues'][$i] = array(
		                        'content_type_id' => $_item->getContentTypeId(),
			                  	'content_id' => $_item->getContentId(),
			                  	'visibility' => $_item->getVisibility(),
			                  	'sort_order' => $_item->getSortOrder()
						);

						switch($type){
							case 'text':
								$value['contentValues'][$i]['text'] = $_item->getText();
								$value['contentValues'][$i]['text_color'] = $_item->getTextColor();
								$value['contentValues'][$i]['text_format'] = $_item->getTextFormat();
								$value['contentValues'][$i]['font_size'] = $_item->getFontSize();
								$value['contentValues'][$i]['font_weight'] = $_item->getFontWeight();
								break;
							case 'button':
								$value['contentValues'][$i]['text'] = $_item->getText();
								$value['contentValues'][$i]['text_color'] = $_item->getTextColor();
								$value['contentValues'][$i]['text_color_hover'] = $_item->getTextColorHover();
								$value['contentValues'][$i]['button_type'] = $_item->getButtonType();
								$value['contentValues'][$i]['link'] = $_item->getLink();
								$value['contentValues'][$i]['background_color'] = $_item->getBackgroundColor();
								$value['contentValues'][$i]['background_color_hover'] = $_item->getBackgroundColorHover();
								break;
						}
						$i++;
					}
				}
				$values[] = new Varien_Object($value);
			}
			$this->_values = $values;
		}
		return $this->_values;
	}

}
