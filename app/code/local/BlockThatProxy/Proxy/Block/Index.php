<?php   
class BlockThatProxy_Proxy_Block_Index extends Mage_Core_Block_Template{   
 
 protected function _gethashkey()
    {
		
		
		$sql = "SELECT *  FROM core_config_data WHERE path='Proxy/feed/blockthatproxy_hashkey'";
		$data = Mage::getSingleton('core/resource') ->getConnection('core_read')->fetchAll($sql);
		print_r($data);
		
		
         /*if (!$this->getData('product') instanceof Mage_Catalog_Model_Product) {
           
           
                $hashkey = Mage::getModel('proxy/proxy')->load();
                
           
        }*/
        return $hashkey;
    }




}