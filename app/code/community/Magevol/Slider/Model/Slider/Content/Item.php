<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_Slider_Content_Item extends Mage_Core_Model_Abstract
{
	protected $_items = array();

	protected $_content;

	protected $_textInstance;
	protected $_buttonInstance;

	/**
	 * constructor
	 * @access public
	 * @return void
	 */
	public function _construct(){
		parent::_construct();
		$this->_init('magevol_slider/slider_content_item');
	}

	/**
	 * Add item for save it
	 *
	 * @param array $item
	 * @return Magevol_Slider_Model_Slider_Content
	 */
	public function addItem($item)
	{
		$this->_items[] = $item;
		return $this;
	}

	/**
	 * Get all items
	 *
	 * @return array
	 */
	public function getItems()
	{
		return $this->_items;
	}

	/**
	 * Set items for array
	 *
	 * @param array $items
	 * @return Magevol_Slider_Model_Slider_Content_Item
	 */
	public function setItems($items)
	{
		$this->_items = $items;
		return $this;
	}

	public function unsetItems()
	{
		$this->_items = array();
		return $this;
	}

	public function setContent(Magevol_Slider_Model_Slider_Content $content)
	{
		$this->_content = $content;
		return $this;
	}

	public function unsetContent()
	{
		$this->_content = null;
		return $this;
	}

	public function getContent()
	{
		return $this->_content;
	}

	/**
	 * Retrieve text instance
	 *
	 * @return Magevol_Slider_Model_Slider_Content_Text
	 */
	public function getTextInstance()
	{
		if (!$this->_textInstance) {
			$this->_textInstance = Mage::getSingleton('magevol_slider/slider_content_text');
		}
		return $this->_textInstance;
	}
	/**
	 * Retrieve button instance
	 *
	 * @return Magevol_Slider_Model_Slider_Content_Button
	 */
	public function getButtonItemInstance()
	{
		if (!$this->_buttonInstance) {
			$this->_buttonInstance = Mage::getSingleton('magevol_slider/slider_content_button');
		}
		return $this->_buttonInstance;
	}

	public function saveItems()
	{
		if($type = $this->getContent()->getType()){
			switch($type){
				case 'text':
					$this->getTextInstance()->setContent($this->getContent())
					->setTexts($this->getItems())
					->saveTexts();
					break;
				case 'button':
					$this->getButtonItemInstance()->setContent($this->getContent())
					->setButtons($this->getItems())
					->saveButtons();
					break;
			}
		}
		 
		return $this;
	}

	/**
	 * Delete values by option id
	 *
	 * @param int $optionId
	 * @return Mage_Catalog_Model_Resource_Product_Option_Value
	 */
	public function deleteItem($contentId)
	{
		$this->_getWriteAdapter()->delete(
		$this->getMainTable(),
		array(
                'content_id = ?' => $contentId,
		)
		);

		return $this;
	}

}
