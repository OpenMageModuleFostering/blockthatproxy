<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @copyright  Copyright (c) 2009 Konstant Info Solution Pvt Ltd (http://www.konstantinfo.com)
 * @author : Lalit Kumar Jain
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class BlockThatProxy_Proxy_Block_Order_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


    public function __construct()
    {
        parent::__construct();
   //     $this->setId('OrderGrid');
        $this->_parentTemplate = $this->getTemplate();
        $this->setVarNameFilter('proxy_order');
        //$this->setTemplate('Shipping/List.phtml');	
        $this->setEmptyText('No Proxy Record Found');
        
        $this->setDefaultSort('po_order_id', 'desc');
        $this->setSaveParametersInSession(true);
    }
    /**
     * Charge la collection des devis
     *
     * @return unknown
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('proxy/Order')
        	->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
   /**
     * Défini les colonnes du grid
     *
     * @return unknown
     */
    protected function _prepareColumns()
    {
                
        $this->addColumn('po_order_id', array(
            'header'=> Mage::helper('proxy')->__('OrderId'),
            'index' => 'po_order_id',
			   'type'      => 'text',
        ));
        
		$this->addColumn('country', array(
            'header'=> Mage::helper('proxy')->__('Country'),
    		  'index' => 'country',
			  

        ));
		
		$this->addColumn('city', array(
            'header'=> Mage::helper('proxy')->__('City'),
    		  'index' => 'city',

        ));
		
		$this->addColumn('distance', array(
            'header'=> Mage::helper('proxy')->__('Distance'),
			'default'   => '--',
    		  'index' => 'distance',

        ));
		
		$this->addColumn('name', array(
            'header'=> Mage::helper('proxy')->__('Name'),
    		  'index' => 'name',

        ));
		
		$this->addColumn('email', array(
            'header'=> Mage::helper('proxy')->__('Email'),
    		  'index' => 'email',

        ));
		                            
        $this->addColumn('po_flag', array(
            'header'=> Mage::helper('proxy')->__('Proxy Detected'),
    		  'index' => 'po_flag',

        ));
		
		
		
        return parent::_prepareColumns();
    }
	
public function getRowUrl($row)
    {
			//return	Mage::helper("adminhtml")->getUrl("sales_order/view",array('order_id' => $row->getpo_order_id()));
			 return $this->getUrl('adminhtml/sales_order/view', array('order_id' => $row->getpo_order_id()));

	 		//     return $this->getUrl('/sales_order/view', array('order_id' => $row->getpo_order_id()));
    }

 
	public function getGridUrl()
    {
        return '';
    }

    public function getGridParentHtml()
    {
	
        $templateName = Mage::getDesign()->getTemplateFilename($this->_parentTemplate, array('_relative'=>true));
        return $this->fetchView($templateName);
    }

    
}
