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

class Magevol_Slider_Block_Slider extends Mage_Core_Block_Template
{
	/**
	 * get slides collection
	 * @access public
	 * @return Mage_Eav_Model_Entity_Collection_Abstract
	 */
	public function getSlides()
	{
		$collection = Mage::getResourceModel('magevol_slider/slider_collection')
		->addStoreFilter(Mage::app()->getStore()->getId())
		->addFieldToFilter('is_active',1)
		->setOrder('sort_order', 'ASC');
		 
		if ($this->getCategoryId()) {
			$tableName = Mage::getSingleton('core/resource')->getTableName('magevol_slider/categories');
			$collection->getSelect()
			->join( array('sc'=>$tableName),
									'main_table.slider_id = sc.slider_id', array('sc.*'))
			->where('sc.category_id = ?', $this->getCategoryId());
		}

		if($this->getPageId()){
			$tableName = Mage::getSingleton('core/resource')->getTableName('magevol_slider/pages');
			$collection->getSelect()
			->join( array('sp'=>$tableName), 'main_table.slider_id = sp.slider_id', array('sp.*'))
			->where('sp.page_id = ?', $this->getPageId());
		}

		$collection->addContentToResult();

		return $collection;
	}

	public function getPageId()
	{
		if ($pageId = (int)Mage::getBlockSingleton('cms/page')->getPage()->getPageId()) {
			return $pageId;
		}
		return 0;
	}

	public function getCategoryId()
	{
		if (Mage::registry('current_category')) {
			return Mage::registry('current_category')->getId();
		}
		return 0;
	}


}