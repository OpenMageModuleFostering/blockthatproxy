<?php

/*
surcharge pour activer le theme mdn
*/
class BlockThatProxy_Proxy_Block_Adminhtml_Page  extends Mage_Adminhtml_Block_Page
{

    public function __construct()
    {
        parent::__construct();
        
        //Active le theme mdn
        Mage::getDesign()
        	->setTheme('mdn')
        	->setArea('adminhtml')
        	->setPackageName('default');
    }

}

?>