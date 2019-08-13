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
class BlockThatProxy_Proxy_Model_Config_Redirectpage
{

    public function toOptionArray()
    {
        return array(
            array('value'=>'shoppingcart', 'label'=>Mage::helper('adminhtml')->__('Shoppingcart')),
            array('value'=>'homepage', 'label'=>Mage::helper('adminhtml')->__('HomePage')),
        );
    }

}
