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

class Magevol_Slider_Block_Adminhtml_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container
{

	/**
	 * Initialize banners manage page
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->_controller = 'adminhtml_slider';
		$this->_blockGroup = 'magevol_slider';
		$this->_headerText = Mage::helper('magevol_slider')->__('Manage sliders');
		$this->_addButtonLabel = Mage::helper('magevol_slider')->__('Add Slider');
		parent::__construct();
	}
}
