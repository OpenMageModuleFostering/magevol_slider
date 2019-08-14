<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_Slider_Content extends Mage_Core_Model_Abstract
{
	/**
	 * Content
	 *
	 * @var array
	 */
	protected $_contents = array();

	/**
	 * items
	 *
	 * @var array
	 */
	protected $_items = array();

	/**
	 * Item instance
	 *
	 * @var Magevol_Slider_Model_Slider_Content_Item
	 */
	protected $_itemInstance;

	/**
	 * constructor
	 * @access public
	 * @return void
	 */
	public function _construct(){
		parent::_construct();
		$this->_init('magevol_slider/slider_content');
	}

	/**
	 * Add item of content to items array
	 *
	 * @param Magevol_Slider_Model_Slider_Content_Item $item
	 * @return Magevol_Slider_Model_Slider_Content
	 */
	public function addItem(Magevol_Slider_Model_Slider_Content_Item $item)
	{
		$this->_items[$item->getContentTypeId()] = $item;
		return $this;
	}

	/**
	 * Add text of content to items array
	 *
	 * @param Magevol_Slider_Model_Slider_Content_Text $item
	 * @return Magevol_Slider_Model_Slider_Content
	 */
	public function addText(Magevol_Slider_Model_Slider_Content_Text $item)
	{
		$this->_items[$item->getContentTypeId()] = $item;
		return $this;
	}

	/**
	 * Add button of content to items array
	 *
	 * @param Magevol_Slider_Model_Slider_Content_Button $item
	 * @return Magevol_Slider_Model_Slider_Content
	 */
	public function addButton(Magevol_Slider_Model_Slider_Content_Button $item)
	{
		$this->_items[$item->getContentTypeId()] = $item;
		return $this;
	}

	/**
	 * Get items
	 *
	 * @return array
	 */
	public function getItems()
	{
		return $this->_items;
	}

	/**
	 * Retrieve item instance
	 *
	 * @return Magevol_Slider_Model_Slider_Content_Item
	 */
	public function getItemInstance()
	{
		if (!$this->_itemInstance) {
			$this->_itemInstance = Mage::getSingleton('magevol_slider/slider_content_item');
		}
		return $this->_itemInstance;
	}

	/**
	 * Add content for save it
	 *
	 * @param array $content
	 * @return Magevol_Slider_Model_Slider_Content
	 */
	public function addContent($content)
	{
		$this->_contents[] = $content;
		return $this;
	}

	/**
	 * Get all content
	 *
	 * @return array
	 */
	public function getContents()
	{
		return $this->_contents;
	}

	/**
	 * Set content for array
	 *
	 * @param array $contents
	 * @return Magevol_Slider_Model_Slider_Content
	 */
	public function setContents($contents)
	{
		$this->_contents = $contents;
		return $this;
	}

	/**
	 * Set options to empty array
	 *
	 * @return Mage_Catalog_Model_Product_Option
	 */
	public function unsetContents()
	{
		$this->_contents = array();
		return $this;
	}

	/**
	 * Retrieve slider instance
	 *
	 * @return Magevol_Slider_Model_Slider
	 */
	public function getSlider()
	{
		return $this->_slider;
	}

	/**
	 * Set slider instance
	 *
	 * @param Magevol_Slider_Model_Slider $slider
	 * @return Magevol_Slider_Model_Slider_Content
	 */
	public function setSlider(Magevol_Slider_Model_Slider $slider = null)
	{
		$this->_slider = $slider;
		return $this;
	}

	public function saveContent()
	{
		$slider_id = $this->getSlider()->getId();
		foreach ($this->getContents() as $content)
		{
			$this->setData($content)
			->setData('slider_id', $slider_id);

			if ($this->getData('content_id') == '0') {
				$this->unsetData('content_id');
			} else {
				$this->setId($this->getData('content_id'));
			}

			$isEdit = (bool)$this->getData('id') ? true:false;
			if ($this->getData('is_delete') == '1') {
				if ($isEdit) {
					$this->delete();
				}
			} else {
				$this->save();
			}
		}

		return $this;
	}

	/**
	 * After save
	 *
	 * @return Mage_Core_Model_Abstract
	 */
	protected function _afterSave()
	{
		$this->getItemInstance()->unsetItems();
		if (is_array($this->getData('items'))) {
			foreach ($this->getData('items') as $value) {
				$this->getItemInstance()->addItem($value);
			}

			$this->getItemInstance()->setContent($this)
			->saveItems();
		}

		return parent::_afterSave();
	}

	/**
	 * get Slider Content Collection
	 *
	 * @param Magevol_Slider_Model_Slider_Content $slider
	 * @return Magevol_Slider_Model_Resource_Slider_Content_Collection
	 */
	public function getSliderContentCollection(Magevol_Slider_Model_Slider $slider)
	{
		$collection = $this->getCollection()
		->addSliderToFilter($slider->getId())
		->setOrder('sort_order', 'asc');

		$collection->addItemsToResult();
		return $collection;
	}

}
