<?php

  class BlockThatProxy_Proxy_Model_Mysql4_Feed extends Mage_Core_Model_Mysql4_Abstract
  {
      protected function _construct()
      {
          $this->_init('proxy/feed', 'item_id');
      }
  }