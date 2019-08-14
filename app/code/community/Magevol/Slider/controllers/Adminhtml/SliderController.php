<?php
/**
 * Magevol Slider
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Adminhtml_SliderController extends Mage_Adminhtml_Controller_Action
{
	/**
	 * Init actions
	 *
	 * @return Mage_Adminhtml_Cms_BlockController
	 */
	protected function _initAction()
	{
		$this->loadLayout()
		->_setActiveMenu('cms/sliders')
		->_title($this->__('Manage sliders'));
		return $this;
	}

	/**
	 * Initialize slider from request parameters
	 *
	 * @return Magevol_Slider_Model_Slider
	 */
	protected function _initSlider()
	{
		$slider_Id = $this->getRequest()->getParam('id');
		$slider = Mage::getModel('magevol_slider/slider');

		if ($slider_Id) {
			$slider->load($slider_Id);
		}
		/**
		 * Initialize slider content
		 */
		if ($data = $this->getRequest()->getPost()) {
			$sliderContent = $data['slider']['content'];
			if (isset($sliderContent)) {
				$slider->setSliderContent($sliderContent);
			}
		}

		Mage::register('slider', $slider);
		Mage::register('current_slider', $slider);

		return $slider;
	}

	/**
	 * Sliders list
	 *
	 * @return void
	 */
	public function indexAction()
	{
		$this->_initAction()
		->renderLayout();
	}

	/**
	 * Create new slider
	 */
	public function newAction()
	{
		$this->_forward('edit');
	}

	/**
	 * Edit action
	 *
	 */
	public function editAction()
	{
		$slider = $this->_initSlider();

		if ($slider->getId() || $slider_Id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$slider->setData($data);
			}
				
			$this->loadLayout();
			$this->_setActiveMenu('cms/sliders');
				
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
				
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
				
			$this->_addContent($this->getLayout()->createBlock('magevol_slider/adminhtml_slider_edit'))
			->_addLeft($this->getLayout()->createBlock('magevol_slider/adminhtml_slider_edit_tabs'));
				
			$this->renderLayout();
		}
		else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('magevol_slider')->__('This slider no longer exists.'));
			$this->_redirect('*/*/');
		}
	}

	/**
	 * Save action
	 */
	public function saveAction()
	{
		// check if data sent
		if ($data = $this->getRequest()->getPost()) {
			try {
				 
				$slider = $this->_initSlider();
				$slider->addData($data);

				// Set categories
				if ($data['category_ids']) {
					$categoryIds = array_unique(explode(',', $data['category_ids']));
					$data['category_ids'] = $categoryIds;
				}

				// Set new image
				if($_FILES['slider_image']['name']){
					$image 	= $this->_uploadImage('slider_image');
					$slider->setData('slider_image', $image);
				}else{
					$slider->unsetData('slider_image');
				}

				$slider->save();

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('magevol_slider')->__('The slide was successfully saved.'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				// check if 'Save and Continue'
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $slider->getId()));
					return;
				}
				// go to grid
				$this->_redirect('*/*/');
				return;

			}catch (Mage_Core_Exception $e){
				if (isset($data['filename']['value'])){
					$data['filename'] = $data['filename']['value'];
				}
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setSlideData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
			catch (Exception $e) {
				Mage::logException($e);
				if (isset($data['filename']['value'])){
					$data['filename'] = $data['filename']['value'];
				}
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('magevol_slider')->__('There was a problem saving the image.'));
				Mage::getSingleton('adminhtml/session')->setSlideData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		$this->_redirect('*/*/');
	}

	protected function _uploadImage($input) {
		try{
			if (isset($data[$input]['delete'])){
				return '';
			}
			else{
				$uploader = new Varien_File_Uploader($input);
				$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
				$uploader->setFilesDispersion(true);
				$uploader->setAllowCreateFolders(true);
				 
				$path = Mage::getBaseDir('media') . DS . 'magevol' . DS . 'slider' .DS;
				$result = $uploader->save($path );
				$fileinputname = 'magevol' . DS . 'slider' . $result['file'];
				return $fileinputname;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() != Varien_File_Uploader::TMP_NAME_EMPTY) {
				throw $e;
			}
			else{
				if (isset($data[$input]['value'])){
					return $data[$input]['value'];
				}
			}
		}
		return '';
	}

	public function categoriesJsonAction()
	{
		$sliderId = $this->getRequest()->getParam('id');
		$model = Mage::getModel('magevol_slider/slider')->load($sliderId);
		 
		Mage::register('current_slider', $model);

		$this->getResponse()->setBody(
		$this->getLayout()->createBlock('magevol_slider/adminhtml_slider_edit_tab_categories')
		->getCategoryChildrenJson($this->getRequest()->getParam('category'))
		);
	}

	/**
	 * Delete action
	 *
	 */
	public function deleteAction()
	{
		// check if we know what should be deleted
		if ($id = $this->getRequest()->getParam('id')) {
			try {
				// init model and delete
				$model = Mage::getModel('magevol_slider/slider');
				$model->load($id);
				$model->delete();
				// display success message
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('magevol_slider')->__('The slider has been deleted.'));
				// go to grid
				$this->_redirect('*/*/');
				return;

			} catch (Exception $e) {
				// display error message
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				// go back to edit form
				$this->_redirect('*/*/edit', array('id' => $id));
				return;
			}
		}
		// display error message
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('magevol_slider')->__('Unable to find the slider to delete.'));
		// go to grid
		$this->_redirect('*/*/');
	}

	/**
	 * Delete specified banners using grid massaction
	 *
	 */
	public function massDeleteAction()
	{
		$ids = $this->getRequest()->getParam('slider');
		if (!is_array($ids)) {
			$this->_getSession()->addError($this->__('Please select items.'));
		} else {
			try {
				foreach ($ids as $id) {
					$model = Mage::getSingleton('magevol_slider/slider')->load($id);
					$model->delete();
				}

				$this->_getSession()->addSuccess(
				$this->__('Total of %d record(s) have been deleted.', count($ids))
				);
			} catch (Mage_Core_Exception $e) {
				$this->_getSession()->addError($e->getMessage());
			} catch (Exception $e) {
				$this->_getSession()->addError(Mage::helper('magevol_contact')->__('An error occurred while mass deleting contacts. Please review log and try again.'));
				Mage::logException($e);
				return;
			}
		}
		$this->_redirect('*/*/index');
	}

	/**
	 * Update slider(s) status action
	 */
	public function massStatusAction(){
		$ids = $this->getRequest()->getParam('slider');
		if (!is_array($ids)) {
			$this->_getSession()->addError($this->__('Please select items.'));
		} else {
			try {
				foreach ($ids as $id) {
					$model = Mage::getSingleton('magevol_slider/slider')->load($id)
					->setIsActive($this->getRequest()->getParam('status'))
					->setIsMassupdate(true)
					->save();
				}
				$this->_getSession()->addSuccess($this->__('Total of %d sliders were successfully updated.', count($ids)));
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('magevol_slider')->__('There was an error updating the slider.'));
				Mage::logException($e);
			}
		}
		$this->_redirect('*/*/index');
	}


	/**
	 * Check the permission to run it
	 *
	 * @return boolean
	 */
	protected function _isAllowed()
	{
		return Mage::getSingleton('admin/session')->isAllowed('cms/magevol_slider');
	}

}
