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
class BlockThatProxy_Proxy_Model_Order  extends Mage_Core_Model_Abstract
{

	private $_products = null;
	private $_currency = null;
	

	/*****************************************************************************************************************************
	* ***************************************************************************************************************************
	* Constructeur
	*
	*/
	public function _construct()
	{
		parent::_construct();
		$this->_init('proxy/Order');
	}

	 public function addnewProxy($orderId,$Proxydetected,$distance,$email,$name,$country,$city)
	{

				mage::getModel('proxy/Order')
				->setpo_order_id($orderId)
				->setpo_flag($Proxydetected)
				->setdistance($distance)
				->setemail($email)
				->setname($name)
				->setcountry($country)
				->setcity($city)
				->save();
	
	}

	
	


}