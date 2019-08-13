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
/**
 * Collection de quotation
 *
 */
class BlockThatProxy_Proxy_Model_Mysql4_Order_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('proxy/Order');
    }
    
    public function getFullList()
    {
			
		 $this->getSelect()
    		->join('proxy_supplier', 'po_sup_num=sup_id')
    		->joinLeft('proxy_order_product', 'po_num=pop_order_num', array('SUM(pop_qty-pop_supplied_qty)'=>'SUM(pop_qty-pop_supplied_qty)'))
            ->group('po_num');
      
        return $this;
    }
    

    public function getSelect()
    {
        return $this->_select;
    }
    
}