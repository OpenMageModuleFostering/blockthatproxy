<?php

  class BlockThatProxy_Proxy_Model_Mysql4_Feed_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
  {
      protected function _construct()
      {
          parent::_construct();
          $this->_init('proxy/feed');
      }

  }