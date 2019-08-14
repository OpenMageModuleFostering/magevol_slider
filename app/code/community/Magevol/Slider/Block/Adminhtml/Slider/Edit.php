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

class Magevol_Slider_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		$this->_objectId = 'id';
		$this->_blockGroup = 'magevol_slider';
		$this->_controller = 'adminhtml_slider';
		 
		parent::__construct();

		$objId = $this->getRequest()->getParam($this->_objectId);

		$this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
		), -100);
		$this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
	}

	public function getHeaderText()
	{
		if( Mage::registry('current_slider') && Mage::registry('current_slider')->getId() ) {
			return Mage::helper('magevol_slider')->__("Edition of the slider '%s'", $this->htmlEscape(Mage::registry('current_slider')->getName()));
		}
		else {
			return Mage::helper('magevol_slider')->__('Add a slider');
		}
	}
}