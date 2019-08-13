<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * admin product edit tabs
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class BlockThatProxy_Proxy_Block_Order_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	private $_proxyOrder = null;
	
    public function __construct()
    {
        parent::__construct();
        $this->setId('proxy_order_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle('');
    }

    protected function _beforeToHtml()
    {
        $product = $this->getProduct();

        $this->addTab('tab_info', array(
            'label'     => Mage::helper('proxy')->__('Summary'),
            'content'   => $this->getLayout()->createBlock('Proxy/Order_Edit_Tabs_Info')->toHtml(),
        ));

        $this->addTab('tab_products', array(
            'label'     => Mage::helper('proxy')->__('Products'),
            'content'   => $this->getLayout()->createBlock('Proxy/Order_Edit_Tabs_Products')->toHtml(),
        ));
        
        if ($this->getProxyOrder()->getpo_status() == BlockThatProxy_Proxy_Model_Order::STATUS_WAITING_FOR_DELIVERY)
        {
	        $this->addTab('tab_deliveries', array(
	            'label'     => Mage::helper('proxy')->__('Deliveries'),
	            'content'   => $this->getLayout()->createBlock('Proxy/Order_Edit_Tabs_Deliveries')->toHtml(),
	        ));	
        }
        
        if ($this->getProxyOrder()->getpo_status() == BlockThatProxy_Proxy_Model_Order::STATUS_NEW)
        {
	        $this->addTab('tab_add_products', array(
	            'label'     => Mage::helper('proxy')->__('Add Products'),
	            'url'   => $this->getUrl('*/*/ProductSelectionGrid', array('_current'=>true, 'po_num' => $this->getProxyOrder()->getId())),
	            'class' => 'ajax',
	        ));
        }
        
        if ($this->getProxyOrder()->getpo_status() != BlockThatProxy_Proxy_Model_Order::STATUS_COMPLETE)
        {
	        $this->addTab('tab_send_to_supplier', array(
	            'label'     => Mage::helper('proxy')->__('Send to supplier'),
	            'content'   => $this->getLayout()->createBlock('Proxy/Order_Edit_Tabs_SendToSupplier')->setOrderId($this->getProxyOrder()->getId())->toHtml(),
	        ));
        }
        
        //set active tab
        $defaultTab = $this->getRequest()->getParam('tab');
        if ($defaultTab == null)
        	$defaultTab = 'tab_info';
        $this->setActiveTab($defaultTab);

        return parent::_beforeToHtml();
    }

    /**
     * Retrive product object from object if not from registry
     *
     * @return Mage_Catalog_Model_Product
     */
    public function getProxyOrder()
    {
		if ($this->_proxyOrder == null)
		{
			$this->_proxyOrder = mage::getModel('Proxy/Order')->load($this->getRequest()->getParam('po_num'));
		}
		return $this->_proxyOrder;
    }

}
