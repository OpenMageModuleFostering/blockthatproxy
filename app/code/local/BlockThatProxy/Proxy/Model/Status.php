<?php

class BlockThatProxy_Proxy_Model_Status  extends Mage_Adminhtml_Block_Sales_Order_Grid
{	

	public function __construct()
	{
		parent::__construct();
	}

	  public function setFraud($orderID)
		{
			$w = Mage::getSingleton('core/resource')->getConnection('core_write');
			$tableName = Mage::getSingleton('core/resource')->getTableName('sales_flat_order_grid'); 
		
			
		//   $w->query("UPDATE `{$tableName}`   SET status='fraud' WHERE `increment_id`={$orderID}");
		  $w->query("UPDATE `{$tableName}` SET status='fraud' WHERE `increment_id`={$orderID}");


				//	$this->load($orderID);
					
				///$this->setState('fraud',true);
//				$this->save();
//echo "sdfsdfs"; 
/*$order = Mage::getModel('sales/order')
                ->load($orderId);
echo $order->getId()."Lalit";
$data = array('status'=>'fraud');

$model = $order->addData($data);*/


/*$myShipment=Mage::getModel('sales/order'); 
$myShipment->setState("fraud");
$myShipment->save();*/

//$model->getOrderId($orderID)->save();
}
	
	
/*	 public function fraud()
    {
        if (!$this->canFraud()) {
            Mage::throwException(Mage::helper('sales')->__('Hold action is not available.'));
        }
     //   $this->setHoldBeforeState($this->getState());
  ///      $this->setHoldBeforeStatus($this->getStatus());
     //   $this->setState(self::STATE_HOLDED, true);
        return $this;
    }
	
    public function canFraud()
    {
        $state = $this->getState();
        if ($this->isCanceled() || $this->isPaymentReview() || $state === self::STATE_COMPLETE || $state === self::STATE_CLOSED || $state === self::STATE_FRAUD) {
            return false;
        }

    /*    if ($this->getActionFlag(self::ACTION_FLAG_HOLD) === false) {
            return false;
        }
        return true;
    }*/
	

}

?>