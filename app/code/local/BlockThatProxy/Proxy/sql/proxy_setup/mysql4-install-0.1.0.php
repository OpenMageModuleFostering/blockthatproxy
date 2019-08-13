<?php 
    $installer = $this;
      $installer->startSetup();


																																											
$installer->endSetup();

     $installer->run(" 
     	CREATE TABLE IF NOT EXISTS `proxy_flag` (
	  `po_num` int(11) NOT NULL AUTO_INCREMENT,
	  `po_order_id` varchar(20) NOT NULL,
	  `po_flag` varchar(20) NOT NULL,
	  `distance` varchar(50) NOT NULL,
	  `email` varchar(50) NOT NULL,
	  `name` varchar(50) NOT NULL,
	  `city` varchar(50) NOT NULL,
	  `country` varchar(50) NOT NULL,
	  PRIMARY KEY (`po_num`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;
    ");
	  
	  
       
    $installer->endSetup();
?>