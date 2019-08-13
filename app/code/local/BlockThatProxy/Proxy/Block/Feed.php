<?php

class BlockThatProxy_Proxy_Block_Feed extends Mage_Core_Block_Template
{ 
      public function retrieveFeed($orderId,$addcity,$countryName,$cname,$cemail,$incId)
      { 
	  
        $ip=$_SERVER['REMOTE_ADDR'];
	    //$returnvalue=$this->check4proxy($data[0]['value']);
		$XML_hashKey= 'proxy/feed/blockthatproxy_hashkey';
		$XML_bodyMess='proxy/feed/blockthatproxy_message';
		$XML_bodySub='proxy/feed/blockthatproxy_subject';
		$XML_PATH_EMAIL_RECIPIENT = 'proxy/feed/blockthatproxy_toemail';
		$Proxydetected="Proxy Detected";
		$XML_PATH_EMAIL_SENDER = 'proxy/feed/blockthatproxy_fromemail';
		$XML_Redirect = 'proxy/feed/blockthatproxy_redirectpage';
		$XML_RedirectEnable='proxy/feed/blockthatproxy_redirectpageenable';
		
		 $redirectPageE=Mage::getStoreConfig($XML_RedirectEnable);
		
		
		
		/***************************************************************/
		
		 $senderemail=Mage::getStoreConfig($XML_PATH_EMAIL_SENDER);
	  	 $Recieveremail=Mage::getStoreConfig($XML_PATH_EMAIL_RECIPIENT);
		 
		 $bodyMess=Mage::getStoreConfig($XML_bodyMess);
		
		
		 $mailSub=Mage::getStoreConfig($XML_bodySub);
		 $hashKey=Mage::getStoreConfig($XML_hashKey);
		 $rPage=Mage::getStoreConfig($XML_Redirect);
		 
		$bodyMess=str_replace("[ORDERID]",$orderId,$bodyMess);
		
		$bodyMess=str_replace("[IP]",$ip,$bodyMess);
		
		
			//$orderSuspect = Mage::getModel('proxy/status');
		//	$orderSuspect->setFraud($orderId);
		 
		 /**************************************************************/
	
		$returnvalue=$this->check4proxy($hashKey);
		
		$distance=$this->checkDistanceApi($hashKey,$addcity,$countryName);
		
	//	 Mage::getSingleton('');
		/* $model
    		->po_order_id($orderId)
    		->po_flag("Flag")
			->save();*/
    	
		if($distance>=0)
		{
			$bodyMess=str_replace("[Distance]",$distance,$bodyMess);
//			$bodyMess.="\n Distance of the customer is :".$distance;
		
		
		}else{
		
			$bodyMess=str_replace("[Distance]",$distance,$bodyMess);
		
//			$bodyMess.="\n Unable to calculate distance.";
		}
	
		if($returnvalue==true)
		{
		
				 		$mail = new Zend_Mail();
						$mail->setBodyText($bodyMess);
					
						//	$mail->setFrom($senderemail);
					
						$mail->addTo($Recieveremail, 'BlockThatProxy');
						$mail->setSubject($mailSub);
						try {
							$mail->send();
					  	}        
						catch(Exception $ex) {
							Mage::getSingleton('core/session')->addError('Unable to send email.');
				 
						}
						
						$orderSuspect = Mage::getModel('proxy/status');
						$orderSuspect->setFraud($incId);
						
						$model = mage::getModel('proxy/Order');
						$distance=$distance."Km";
						$model ->addnewProxy($orderId,$Proxydetected,$distance,$cemail,$cname,$countryName,$addcity);
					if($redirectPageE==1)
					{	
					
						header("Location:".$rPage);
						exit();
			/*			if($rPage=="shoppingcart")
						{
							Mage::app()->getResponse()->setRedirect(Mage::getBaseUrl() . 'checkout/cart/');
						}elseif($rPage=="homepage")
						{
								Mage::app()->getResponse()->setRedirect(Mage::getBaseUrl());
						}*/
					}
			}	
			
       }

		
		function checkDistanceApi($hash,$addcity,$countryName)
		{
			  $headers = array();
			  
				foreach(array_keys($_SERVER) as $skey)
				{
					$headers[$skey] = $_SERVER[$skey];
				}
				$header_str='';
				foreach ($headers as $header => $value) 
				{
					
					if ($header == "REMOTE_ADDR") 
					{
						 $ip = "ip=".$value;
					 }
				//	$header_str .= $header."=".$value."~\n";
					
					
				}
				if(isset($addcity) && $addcity!="")
				{
					$cityparam=$addcity;
				
				}else{
					$cityparam="-";
				}
				
				if(isset($countryName) && $countryName!="")
				{
					$countryparam=$countryName;
				
				}else{
					$countryparam="-";
				}
				//echo $ip."<br />";
			//	echo $hash;
			//	$post_string = "address=".$cityparam.",".$countryparam."&ip=".$ip."&hash=".$hash;
				//echo $post_string;
				//$post_string = "address=Delhi,India&ip=123.236.63.222&hash=94370CC0C8C000FEF4D7FD4D0BF389EB8E186119";
									//address=Delhi,India&ip=ip=123.236.63.222&hash=94370CC0C8C000FEF4D7FD4D0BF389EB8E186119-
		   $post_string = "address=".$cityparam.",".$countryparam."&".$ip."&hash=".$hash;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, "http://www.blockthatproxy.com/detect_distance.aspx");
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_USERAGENT, "");
					curl_setopt($ch, CURLOPT_TIMEOUT, 15);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($ch, CURLOPT_HEADER, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					$contents = curl_exec($ch);
					 curl_close($ch);
					$lines = explode("\n",$contents);
					foreach($lines as $line){
					$lastline=$line;
					//echo $line;
					}
			$distance =$lastline;
				if ($distance >= 0)
				return $distance;
				else
				return -1;
		}
		
			   function check4proxy($hash)
	   {
				$headers = array();
				foreach(array_keys($_SERVER) as $skey){
					$headers[$skey] = $_SERVER[$skey];
				}
				$header_str='';
				foreach ($headers as $header => $value) 
				{
					
					if ($header == "REMOTE_ADDR") 
					{
						 $ip = "ip=".$value;
					 }
					$header_str .= $header."=".$value."~\n";
				}
				$post_string = "data=".urlencode($header_str)."&".$ip."&hash=".$hash;
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://www.blockthatproxy.com/detect.aspx");
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_USERAGENT, "");
				curl_setopt($ch, CURLOPT_TIMEOUT, 15);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_HEADER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				$contents = curl_exec($ch); 
				curl_close($ch);
				
				$proxy_level = intval(substr($contents, -2));
			
				if ($proxy_level > 3)
				return true;
				else
				return false;
		}
 }