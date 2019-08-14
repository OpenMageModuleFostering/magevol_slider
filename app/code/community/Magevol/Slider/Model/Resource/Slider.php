<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Model_Resource_Slider extends Mage_Core_Model_Resource_Db_Abstract
{

	/**
	 * Slider to category linkage table
	 *
	 * @var string
	 */
	protected $_sliderStoreTable;

	/**
	 * Slider to cms page linkage table
	 *
	 * @var string
	 */
	protected $_sliderPageTable;

	/**
	 * Slider to category linkage table
	 *
	 * @var string
	 */
	protected $_sliderCategoryTable;

	/**
	 * constructor
	 * @access public
	 */
	public function _construct(){
		$this->_init('magevol_slider/slider', 'slider_id');
		$this->_sliderStoreTable = $this->getTable('magevol_slider/stores');
		$this->_sliderPageTable = $this->getTable('magevol_slider/pages');
		$this->_sliderCategoryTable = $this->getTable('magevol_slider/categories');
	}

	/**
	 * Retrieve product category identifiers
	 *
	 * @param Mage_Catalog_Model_Product $product
	 * @return array
	 */
	public function getCategoryIds($slider)
	{
		$adapter = $this->_getReadAdapter();

		$select = $adapter->select()
		->from($this->_sliderCategoryTable, 'category_id')
		->where('slider_id = ?', (int)$slider->getId());

		return $adapter->fetchCol($select);
	}

	protected function _afterDelete(Mage_Core_Model_Abstract $object)
	{
		 
		$condition = $this->_getWriteAdapter()->quoteInto('slider_id = ?', $object->getId());
		 
		// Stores
		$this->_getWriteAdapter()->delete($this->_sliderStoreTable, $condition);
		 
		// Cms pages
		$this->_getWriteAdapter()->delete($this->_sliderPageTable, $condition);
		 
		// Category ids
		$this->_getWriteAdapter()->delete($this->_sliderCategoryTable, $condition);
		 
		return parent::_afterDelete($object);
	}

	/**
	 * Save data related with product
	 *
	 * @param Mage_Core_Model_Abstract $object
	 */
	protected function _afterSave(Mage_Core_Model_Abstract $object)
	{
		$this->_saveStores($object)
		->_savePages($object)
		->_saveCategories($object);

		return parent::_afterSave($object);
	}

	/**
	 * Save slider store relations
	 *
	 * @param Varien_Object $object
	 * @return Magevol_Slider_Model_Resource_Slider
	 */
	protected function _saveStores(Varien_Object $object)
	{
		$stores = $object->getStores();
		$write = $this->_getWriteAdapter();
		 
		$condition = $this->_getWriteAdapter()->quoteInto('slider_id = ?', $object->getId());
		$write->delete($this->_sliderStoreTable, $condition);
		 
		$data = array();
		foreach ($stores as $store) {
			$data[] = array(
                    'store_id' => (int)$store,
                    'slider_id'  => (int)$object->getId(),
			);
		}
		$write->insertMultiple($this->_sliderStoreTable, $data);

		return $this;
	}

	/**
	 * Save slider page relations
	 *
	 * @param Varien_Object $object
	 * @return Magevol_Slider_Model_Resource_Slider
	 */
	protected function _savePages(Varien_Object $object)
	{
		$pages = $object->getPages();
		$write = $this->_getWriteAdapter();
		 
		$condition = $this->_getWriteAdapter()->quoteInto('slider_id = ?', $object->getId());
		$write->delete($this->_sliderPageTable, $condition);
		 
		$data = array();
		foreach ($pages as $page) {
			$data[] = array(
                    'page_id' => (int)$page,
                    'slider_id'  => (int)$object->getId(),
			);
		}
		$write->insertMultiple($this->_sliderPageTable, $data);

		return $this;
	}

	/**
	 * Save product category relations
	 *
	 * @param Varien_Object $object
	 * @return Magevol_Slider_Model_Resource_Slider
	 */
	protected function _saveCategories(Varien_Object $object)
	{
		/**
		 * If category ids data is not declared we haven't do manipulations
		 */
		if (!$object->hasCategoryIds()) {
			return $this;
		}
		$categoryIds = $object->getCategoryIds();
		$oldCategoryIds = $this->getCategoryIds($object);

		$object->setIsChangedCategories(false);

		$insert = array_diff($categoryIds, $oldCategoryIds);
		$delete = array_diff($oldCategoryIds, $categoryIds);

		$write = $this->_getWriteAdapter();
		if (!empty($insert)) {
			$data = array();
			foreach ($insert as $categoryId) {
				if (empty($categoryId)) {
					continue;
				}
				$data[] = array(
                    'category_id' => (int)$categoryId,
                    'slider_id'  => (int)$object->getId()
				);
			}
			if ($data) {
				$write->insertMultiple($this->_sliderCategoryTable, $data);
			}
		}

		if (!empty($delete)) {
			foreach ($delete as $categoryId) {
				$where = array(
                    'slider_id = ?'  => (int)$object->getId(),
                    'category_id = ?' => (int)$categoryId,
				);

				$write->delete($this->_sliderCategoryTable, $where);
			}
		}

		if (!empty($insert) || !empty($delete)) {
			$object->setAffectedCategoryIds(array_merge($insert, $delete));
			$object->setIsChangedCategories(true);
		}

		return $this;
	}


	public function load(Mage_Core_Model_Abstract $object, $value, $field=null)
	{

		if (!intval($value) && is_string($value)) {
			$field = 'slider_id';
		}
		return parent::load($object, $value, $field);
	}

	/**
	 *
	 * @param Mage_Core_Model_Abstract $object
	 */
	protected function _afterLoad(Mage_Core_Model_Abstract $object)
	{
		if ($object->getId()) {
			 
			// Content
			$contents = Mage::getModel('magevol_slider/slider_content')
			->getCollection()
			->addFieldToFilter('slider_id', $object->getId());

			$contentArray = array();
			foreach ($contents as $content) {
				$contentArray[] = $content;
			}
			$object->setData('content', $contentArray);

			// Stores
			$select = $this->_getReadAdapter()->select()
			->from($this->getTable('magevol_slider/stores'))
			->where('slider_id = ?', $object->getId());
			if ($data = $this->_getReadAdapter()->fetchAll($select)) {
				$storesArray = array();
				foreach ($data as $row) {
					$storesArray[] = $row['store_id'];
				}
				$object->setData('stores', $storesArray);
			}

			// Cms pages
			$select = $this->_getReadAdapter()->select()
			->from($this->getTable('magevol_slider/pages'))
			->where('slider_id = ?', $object->getId());
			if ($data = $this->_getReadAdapter()->fetchAll($select)) {
				$pagesArray = array();
				foreach ($data as $row) {
					$pagesArray[] = $row['page_id'];
				}
				$object->setData('pages', $pagesArray);
			}

			// Category ids
			$select = $this->_getReadAdapter()->select()
			->from($this->getTable('magevol_slider/categories'))
			->where('slider_id = ?', $object->getId());
			if ($data = $this->_getReadAdapter()->fetchAll($select)) {
				$categoriesArray = array();
				foreach ($data as $row) {
					$categoriesArray[] = $row['category_id'];
				}
				$object->setData('category_ids', $categoriesArray);
			}
		}
		return parent::_afterLoad($object);
	}

	/**
	 * Retrieve select object for load object data
	 *
	 * @param string $field
	 * @param mixed $value
	 * @return Zend_Db_Select
	 */
	protected function _getLoadSelect($field, $value, $object)
	{

		$select = parent::_getLoadSelect($field, $value, $object);

		if ($object->getStoreId()) {
			$select->join(array('wcs' => $this->getTable('magevol_slider/stores')), $this->getMainTable().'.slider_id = wcs.slider_id')
			->where('wcs.store_id in (0, ?) ', $object->getStoreId())
			->order('store_id DESC')
			->limit(1);
		}
		return $select;
	}

	/**
	 * Get store ids to which specified item is assigned
	 *
	 * @param int $id
	 * @return array
	 */
	public function lookupStoreIds($id)
	{
		return $this->_getReadAdapter()->fetchCol(
		$this->_getReadAdapter()->select()
		->from($this->getTable('magevol_slider/stores'), 'store_id')
		->where("{$this->getIdFieldName()} = ?", $id)
		);
	}

}
