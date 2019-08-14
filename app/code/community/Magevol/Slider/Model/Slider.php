<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_Slider extends Mage_Core_Model_Abstract
{

	protected $_contentInstance;
	protected $_contents = array();

	/**
	 * constructor
	 * @access public
	 * @return void
	 */
	public function _construct(){
		parent::_construct();
		$this->_init('magevol_slider/slider');
	}

	/**
	 * Add content to array of slider contents
	 *
	 * @param Magevol_Slider_Model_Slider_Content $content
	 * @return Magevol_Slider_Model_Slider
	 */
	public function addContent(Magevol_Slider_Model_Slider_Content $content)
	{
		$this->_contents[$content->getId()] = $content;
		return $this;
	}


	/**
	 * Get all contents of slider
	 *
	 * @return array
	 */
	public function getContents()
	{
		return $this->_contents;
	}

	/**
	 * Retrieve option instance
	 *
	 * @return Mage_Catalog_Model_Product_Option
	 */
	public function getContentInstance()
	{
		if (!$this->_contentInstance) {
			$this->_contentInstance = Mage::getSingleton('magevol_slider/slider_content');
		}
		return $this->_contentInstance;
	}

	/**
	 * Saving slider content data
	 *
	 * @return Magevol_Slider_Model_Slider
	 */
	protected function _afterSave()
	{
		/**
		 * Slider Content
		 */
		if(!$this->getIsMassupdate()){
			$this->getContentInstance()->setSlider($this)
			->saveContent();
		}

		return parent::_afterSave();
	}

	/**
	 * before save slider
	 * @access protected
	 * @return Magevol_Slider_Model_Slider
	 */
	protected function _beforeSave(){
		parent::_beforeSave();
		$now = Mage::getSingleton('core/date')->gmtDate();
		if ($this->isObjectNew()){
			$this->setCreatedAt($now);
		}
		 
		foreach ($this->getSliderContent() as $content) {
			$this->getContentInstance()->addContent($content);
			if ((!isset($content['is_delete'])) || $content['is_delete'] != '1') {
				$this->setHasContents(true);
			}
		}

		$this->setUpdatedAt($now);
		return $this;
	}

	/**
	 * Retrieve options collection of product
	 *
	 * @return Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Option_Collection
	 */
	public function getSliderContentsCollection()
	{
		$collection = $this->getContentInstance()
		->getSliderContentCollection($this);

		return $collection;
	}

	/**
	 * Load product options if they exists
	 *
	 * @return Mage_Catalog_Model_Product
	 */
	protected function _afterLoad()
	{
		parent::_afterLoad();
		/**
		 * Load slider contents
		 */
		if ($this->getHasContents()) {
			foreach ($this->getSliderContentsCollection() as $content) {
				$content->setSlider($this);
				$this->addContent($content);
			}
		}
		return $this;
	}
}
