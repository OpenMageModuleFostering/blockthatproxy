<?php

class BlockThatProxy_Proxy_Model_Proxy extends Mage_Core_Model_Abstract

{
	
	public function _construct()
	
	{
	
		parent::_construct();
		
		$this->_init('proxy/proxy');
	
	}

}