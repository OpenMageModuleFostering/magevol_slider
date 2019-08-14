<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_Resource_Slider_Content_Text_Collection
extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	/**
	 * Resource initialization
	 */
	protected function _construct()
	{
		$this->_init('magevol_slider/slider_content_text');
	}


	/**
	 * Add content to filter
	 *
	 * @param array|Magevol_Slider_Model_Slider_Content|int $content
	 * @return Magevol_Slider_Model_Resource_Slider_Content_Text_Collection
	 */
	public function addContentToFilter($content)
	{
		if (empty($content)) {
			$this->addFieldToFilter('content_id', '');
		} elseif (is_array($content)) {
			$this->addFieldToFilter('content_id', array('in' => $content));
		} elseif ($content instanceof Magevol_Slider_Model_Slider_Content) {
			$this->addFieldToFilter('content_id', $content->getId());
		} else {
			$this->addFieldToFilter('content_id', $content);
		}

		return $this;
	}
}
