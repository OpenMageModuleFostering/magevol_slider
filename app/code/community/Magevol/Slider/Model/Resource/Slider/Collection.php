<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_Resource_Slider_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	public function _construct()
	{
		parent::_construct();
		$this->_init('magevol_slider/slider');
		$this->_map['fields']['store'] = 'store_table.store_id';
	}


	/**
	 * Add filter by store
	 *
	 * @param int|Mage_Core_Model_Store $store
	 */
	public function addStoreFilter($store, $withAdmin = true)
	{
		if ($store instanceof Mage_Core_Model_Store) {
			$store = array($store->getId());
		}

		$this->getSelect()->join(array('wcs' => $this->getTable('magevol_slider/stores')), 'main_table.slider_id = wcs.slider_id',array())
		->where('wcs.store_id in (?) ', $withAdmin ? array(0, $store) : $store);

		return $this;
	}

	/**
	 * Adding slider custom contents to result collection
	 *
	 * @return Magevol_Slider_Model_Resource_Slider_Collection
	 */
	public function addContentToResult()
	{
		$sliderIds = array();
		foreach ($this as $slider) {
			$sliderIds[] = $slider->getId();
		}

		if (!empty($sliderIds)) {
			$contents = Mage::getResourceModel('magevol_slider/slider_content_collection')
			->addSliderToFilter($sliderIds)
			->setOrder('sort_order', 'ASC');

			$contents->addItemsToResult();

			foreach ($contents as $content) {
				if($this->getItemById($content->getSliderId())) {
					$this->getItemById($content->getSliderId())->addContent($content);
				}
			}
		}

		return $this;
	}

	/**
	 * Get SQL for get record count
	 *
	 * @return Varien_Db_Select
	 */
	public function getSelectCountSql()
	{
		$countSelect = parent::getSelectCountSql();
		$countSelect->reset(Zend_Db_Select::GROUP);
		return $countSelect;
	}
}
