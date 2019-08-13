<?php

class BlockIP_Proxy_Model_Mysql4_Proxy extends Mage_Core_Model_Mysql4_Abstract

{

	public function _construct()
	
	{
	
	$this->_init('proxy/proxy', 'proxy_id');
	
	}

}