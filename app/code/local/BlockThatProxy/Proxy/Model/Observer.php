<?php

Zend_Loader::loadClass('Zend_Service_Flickr');

class BlockThatProxy_Proxy_Model_Observer
{
  protected $_flickrApiKey = NULL;
  protected $_userEmailAddress = NULL;

  public function __construct() 
  {
    // the flickr api key from the module config
    $this->_flickrApiKey = Mage::getStoreConfig('Proxy/feed/blockthatproxy_hashkey');

    // email address from the module config
    $this->_userEmailAddress = Mage::getStoreConfig('Proxy/feed/blockthatproxy_hashkey');
  }
  
  protected function _buildFeedOutput() 
  {
    $flickr = new Zend_Service_Flickr($this->_flickrApiKey);
    
    $results = $flickr->userSearch($this->_userEmailAddress);

    foreach ($results as $result) {

      // build the item data
      $data = array(
                  'title' => $result->title,
                  'thumbnail' => $result->Thumbnail
                  );
            
      // store the information
      Mage::getModel('Proxy/feed')->setData($data)->save();
    }
  }

  public function cacheFeeds()
  {
    $this->_buildFeedOutput();
  }

}