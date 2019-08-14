<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_Resource_Slider_Content_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	/**
	 * Resource initialization
	 */
	protected function _construct()
	{
		$this->_init('magevol_slider/slider_content');
	}

	/**
	 * Add product_id filter to select
	 *
	 * @param array|Mage_Catalog_Model_Product|int $product
	 * @return Mage_Catalog_Model_Resource_Product_Option_Collection
	 */
	public function addSliderToFilter($slider)
	{
		if (empty($slider)) {
			$this->addFieldToFilter('slider_id', '');
		} elseif (is_array($slider)) {
			$this->addFieldToFilter('slider_id', array('in' => $slider));
		} elseif ($slider instanceof Magevol_Slider_Model_Slider) {
			$this->addFieldToFilter('slider_id', $slider->getSliderId());
		} else {
			$this->addFieldToFilter('slider_id', $slider);
		}

		return $this;
	}

	/**
	 * Add item to result
	 *
	 * @return Magevol_Slider_Model_Resource_Slider_Content_Collection
	 */
	public function addItemsToResult()
	{
		foreach ($this as $content) {
			if($content->getType() == 'text'){
				$items = Mage::getModel('magevol_slider/slider_content_text')->getCollection()
				->addContentToFilter($content->getId())
				->setOrder('sort_order', 'ASC');
			}elseif($content->getType() == 'button'){
				$items = Mage::getModel('magevol_slider/slider_content_button')->getCollection()
				->addContentToFilter($content->getId())
				->setOrder('sort_order', 'ASC');
			}
			 
			foreach ($items as $item) {
				$contentId = $item->getContentId();
				if($this->getItemById($contentId)) {
					if($content->getType() == 'text'){
						$this->getItemById($contentId)->addText($item);
					}elseif($content->getType() == 'button'){
						$this->getItemById($contentId)->addButton($item);
					}
					$item->setContent($this->getItemById($contentId));
				}
			}
		}

		return $this;
	}

	/**
	 * Call of protected method reset
	 *
	 * @return Magevol_Slider_Model_Resource_Slider_Content_Collection
	 */
	public function reset()
	{
		return $this->_reset();
	}
}
