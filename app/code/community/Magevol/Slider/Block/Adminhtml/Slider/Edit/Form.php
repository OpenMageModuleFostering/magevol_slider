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

class Magevol_Slider_Block_Adminhtml_Slider_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	/**
	 * prepare form
	 * @access protected
	 * @return Magevol_Slider_Block_Adminhtml_Slider_Edit_Form
	 */
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form(array(
					'id' => 'edit_form',
					'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
					'method' => 'post',
					'enctype' => 'multipart/form-data'
					)
					);

					$form->setUseContainer(true);
					$this->setForm($form);
					return parent::_prepareForm();
	}
}