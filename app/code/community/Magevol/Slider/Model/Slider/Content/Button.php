<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_Slider_Content_Button extends Mage_Core_Model_Abstract
{
	protected $_buttons = array();

	protected $_content;

	/**
	 * constructor
	 * @access public
	 * @return void
	 */
	public function _construct(){
		parent::_construct();
		$this->_init('magevol_slider/slider_content_button');
	}

	/**
	 * Add button for save it
	 *
	 * @param array $button
	 * @return Magevol_Slider_Model_Slider_Content
	 */
	public function addButton($button)
	{
		$this->_buttons[] = $button;
		return $this;
	}

	/**
	 * Get all buttons
	 *
	 * @return array
	 */
	public function getButtons()
	{
		return $this->_buttons;
	}

	/**
	 * Set buttons for array
	 *
	 * @param array $buttons
	 * @return Magevol_Slider_Model_Slider_Content_Button
	 */
	public function setButtons($buttons)
	{
		$this->_buttons = $buttons;
		return $this;
	}

	public function unsetButtons()
	{
		$this->_buttons = array();
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

	public function saveButtons()
	{
		foreach ($this->getButtons() as $button) {
			$this->setData($button)
			->setData('content_id', $this->getContent()->getId());

			if ($this->getData('content_type_id') == '-1') {//change to 0
				$this->unsetData('content_type_id');
			} else {
				$this->setId($this->getData('content_type_id'));
			}

			if ($this->getData('is_delete') == '1') {
				if ($this->getId()) {
					$this->delete();
				}
			} else {
				$this->save();
			}
		}//eof foreach()
		return $this;
	}

	/**
	 * Delete values by content id
	 *
	 * @param int $contentId
	 * @return Magevol_Slider_Model_Slider_Content_Button
	 */
	public function deleteButton($contentId)
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
