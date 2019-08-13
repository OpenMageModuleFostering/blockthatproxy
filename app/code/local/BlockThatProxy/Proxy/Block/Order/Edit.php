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
class BlockThatProxy_Proxy_Block_Order_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	private $_order;
	
	/**
	 * Constructeur: on charge le devis
	 *
	 */
	public function __construct()
	{
        $this->_objectId = 'id';
        $this->_controller = 'order';
        $this->_blockGroup = 'Proxy';
		
		parent::__construct();
		
		$this->_addButton(
            'print',
            array(
                'label'     => Mage::helper('proxy')->__('Print'),
                'onclick'   => "window.location.href='".$this->getUrl('Proxy/Orders/Print').'po_num/'.$this->getOrder()->getId()."'",
                'level'     => -1
            )
        );
        
        $this->_addButton(
            'import',
            array(
                'label'     => Mage::helper('proxy')->__('Import from Supply Needs'),
                'onclick'   => "window.open('".$this->getUrl('Proxy/Orders/ImportFromSupplyNeeds', array('po_num' => $this->getOrder()->getId()))."', '');",
                'level'     => -1
            )
        );

        $this->_addButton(
            'delete',
            array(
                'label'     => Mage::helper('proxy')->__('Delete'),
                'onclick'   => "if (window.confirm('".Mage::helper('proxy')->__('Are you sure ?')."')) {document.location.href='".$this->getUrl('Proxy/Orders/delete', array('po_num' => $this->getOrder()->getId()))."';}",
                'level'     => -1,
                'class'		=> 'delete'
            )
        );
	}
		
	public function getHeaderText()
    {
        return $this->__('Proxy Order #').$this->getOrder()->getpo_order_id();
    }
	
	/**
	 * Retourne l'url pour retourner a la liste des manufacturers
	 */
	public function GetBackUrl()
	{
		return $this->getUrl('Proxy/Orders/List', array());
	}
	
	public function getOrder()
	{
		if ($this->_order == null)
		{
			$this->_order = mage::getModel('Proxy/Order')->load($this->getRequest()->getParam('po_num'));
		}
		return $this->_order;
	}
	
	public function getSaveUrl()
    {
        return $this->getUrl('Proxy/Orders/Save');
    }
}