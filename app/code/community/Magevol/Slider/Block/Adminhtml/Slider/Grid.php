<?php
/**
 * Magevol Slider
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA that is bundled with this package
 * in the file license.txt.
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This package designed for Magento community edition
 * MageEvol does not guarantee correct work of this extension
 * on any other Magento edition except Magento community edition.
 * MageEvol does not provide extension support in case of incorrect edition usage.
 * =================================================================
 *
 * @category    Magevol
 * @package     Magevol_Slider
 * @copyright  	Copyright (c) 2016-2017 magevol.com (ttp://www.magevol.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magevol_Slider_Block_Adminhtml_slider_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	/**
	 * Set defaults
	 */
	protected function _construct()
	{
		parent::_construct();
		$this->setId('sliderGrid');
		$this->setDefaultSort('slider_id');
		$this->setDefaultDir('desc');
	}

	/**
	 * Instantiate and prepare collection
	 *
	 * @return magevol_slider_Block_Adminhtml_slider_Grid
	 */
	protected function _prepareCollection()
	{
		$collection = Mage::getResourceModel('magevol_slider/slider_collection');
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	/**
	 * Define grid columns
	 */
	protected function _prepareColumns()
	{
		$this->addColumn(
            'slider_id',
		array(
                'header'=> Mage::helper('magevol_slider')->__('ID'),
            	'align'     => 'right',
                'type'  => 'number',
                'index' => 'slider_id',
		)
		);

		$this->addColumn(
            'name', array(
                'header'    => Mage::helper('magevol_slider')->__('Name'),
                'align'     => 'left',
                'index'     => 'name'
                )
                );

                $this->addColumn(
            'sort_order', array(
            'header'    => Mage::helper('magevol_slider')->__('Sort order'),
            'align'     => 'right',
            'index'     => 'sort_order',
            'type'  	=> 'number',
                )
                );

                $this->addColumn(
            'is_active', array(
            'header'    => Mage::helper('magevol_slider')->__('Status'),
         	'align'     => 'right',
          	'index'     => 'is_active',
        	'type'      => 'options',
        	'options'    => array(
	                '1' => Mage::helper('magevol_slider')->__('Enabled'),
	                '0' => Mage::helper('magevol_slider')->__('Disabled'),
                )
                )
                );

                if (!Mage::app()->isSingleStoreMode()) {
                	$this->addColumn(
                'stores', array(
                    'header'        => Mage::helper('magevol_slider')->__('Store View'),
                    'index'         => 'stores',
                    'type'          => 'store',
                    'store_all'     => true,
                    'store_view'    => true,
                    'sortable'      => false,
                    'filter_condition_callback' => array($this, '_filterStoreCondition'),
                	)
                	);
                }

                $this->addColumn(
        	'created_at', array(
            'header'    => Mage::helper('magevol_slider')->__('Created at'),
            'index'     => 'created_at',
            'width'     => '120px',
            'type'      => 'datetime',
                ));

                $this->addColumn(
        	'updated_at', array(
            'header'    => Mage::helper('magevol_slider')->__('Updated at'),
            'index'     => 'updated_at',
            'width'     => '120px',
            'type'      => 'datetime',
                ));

                return parent::_prepareColumns();
	}
	/**
	 * Prepare mass action options for this grid
	 */
	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('slider_id');
		$this->getMassactionBlock()->setFormFieldName('slider');

		$this->getMassactionBlock()->addItem(
        	'delete', array(
            'label'    => Mage::helper('magevol_slider')->__('Delete'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('magevol_slider')->__('Are you sure you want to delete these slides?')
		)
		);
		$this->getMassactionBlock()->addItem(
        	'status', array(
            'label'=> Mage::helper('magevol_slider')->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'status' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('magevol_slider')->__('Status'),
                        'values' => array(
                                '1' => Mage::helper('magevol_slider')->__('Enabled'),
                                '0' => Mage::helper('magevol_slider')->__('Disabled'),
		)
		)
		)
		));

		return $this;
	}

	/**
	 * Row click url
	 *
	 * @return string
	 */
	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}

	protected function _afterLoadCollection()
	{
		$this->getCollection()->walk('afterLoad');
		parent::_afterLoadCollection();
	}

	protected function _filterStoreCondition($collection, $column)
	{
		if (!$value = $column->getFilter()->getValue()) {
			return;
		}

		$this->getCollection()->addStoreFilter($value);
	}
}
