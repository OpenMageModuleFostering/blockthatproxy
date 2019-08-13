<?php

  class BlockThatProxy_Proxy_Model_Feed extends Mage_Core_Model_Abstract
  {
      protected $_model = NULL;
      
      protected function _construct()
      {
          $this->_model = 'Proxy/feed';
          $this->_init($this->_model);
      }
      
      /**
       * A simple delete all method.
       */
      public function deleteAll() 
      {
          // note that the item couldn't be deleted.
          Mage::log(
            "Attempting to clear the cache", 
            Zend_Log::INFO
            );
            
          $collection = Mage::getModel('Proxy/feed')->getCollection();
           
          foreach ($collection as $ProxyItem) {
              try { 
                  $ProxyItem->delete(); 
              } catch (Exception $e) {
                Mage::log(
                  sprintf("Couldn't delete record. [%s]", var_export($_item, TRUE)), 
                  Zend_Log::ERR
                  );
              }
          }
      }
  }