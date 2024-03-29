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
class BlockThatProxy_Proxy_Block_Order_Edit_Tabs_Deliveries extends Mage_Adminhtml_Block_Widget_Form
{
	private $_order = null;
	
	/**
	 * Constructeur: on charge
	 *
	 */
	public function __construct()
	{
		
		parent::__construct();
		
		$this->setTemplate('Proxy/Order/Edit/Tab/Deliveries.phtml');
	}	
	
		
	/**
	 * Retourne l'objet
	 *
	 * @return unknown
	 */
	public function getOrder()
	{
		if ($this->_order == null)
		{
	        $po_num = Mage::app()->getRequest()->getParam('po_num', false);	
	        $model = Mage::getModel('Proxy/Order');
			$this->_order = $model->load($po_num);
		}
		return $this->_order;
	}
}