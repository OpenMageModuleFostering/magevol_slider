<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_Slider_Content_Text extends Mage_Core_Model_Abstract
{
	protected $_texts = array();

	protected $_content;

	/**
	 * constructor
	 * @access public
	 * @return void
	 */
	public function _construct(){
		parent::_construct();
		$this->_init('magevol_slider/slider_content_text');
	}

	/**
	 * Add text for save it
	 *
	 * @param array $text
	 * @return Magevol_Slider_Model_Slider_Content
	 */
	public function addText($text)
	{
		$this->_texts[] = $text;
		return $this;
	}

	/**
	 * Get all texts
	 *
	 * @return array
	 */
	public function getTexts()
	{
		return $this->_texts;
	}

	/**
	 * Set texts for array
	 *
	 * @param array $texts
	 * @return Magevol_Slider_Model_Slider_Content_Text
	 */
	public function setTexts($texts)
	{
		$this->_texts = $texts;
		return $this;
	}

	public function unsetTexts()
	{
		$this->_texts = array();
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

	public function saveTexts()
	{
		foreach ($this->getTexts() as $text) {
			$this->setData($text)
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
	 * @return Magevol_Slider_Model_Slider_Content_Text
	 */
	public function deleteText($contentId)
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
