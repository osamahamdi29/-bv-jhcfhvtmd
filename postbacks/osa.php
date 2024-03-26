<?php

    /*!
	 * POCKET v3.4
	 *
	 * http://www.droidoxy.com
	 * support@droidoxy.com
	 *
	 * Copyright 2019 DroidOXY ( http://www.droidoxy.com )
	 */
	
	include_once("../admin/core/init.inc.php");
	
	// your Postbacl url :  https://earnplaycards.com/postbacks/ogads.php?of_id={offer_id}&of_name={offer_name}&amount={payout}&user={aff_sub3}
	
	// Eg.  https://earnplaycards.com/postbacks/ogads.php?of_id=23566&of_name=Castle%20Clash&amount=0.08&user=yashDev

    $user_id = $_REQUEST['user'];
    $amount = $_REQUEST['amount'];
    
    // Converting Amount to points as $1 USD = 500 Points
    
    
    $amount = intval($amount * 300);
    

    include("../admin/core/config.php");

    $conn=mysqli_connect($B['DB_HOST'],$B['DB_USER'],$B['DB_PASS'],$B['DB_NAME']);

     if(mysqli_connect_error(!$conn))
        {
    echo "Unable To Connect";
        }else
        {

        }
    
    $timeCurrent = time();
    
         $query ="SELECT * FROM `users` WHERE `login` ='".$user_id."'";
        $result = $conn->query($query);
    
    if ($result->num_rows == 0)
   {
       
       echo "the user don t exite";
   }else{
    
    $configs = new functions($dbo);
    
    $type = "OgAds : ".$_REQUEST['of_name'];;
    
    $account = new account($dbo, 1);
    $userdata = $account->getuserdata($user_id);
        
    
            
            // User Exists, Getting user current points ..
            $newBalance = $userdata['points'] + $amount;
                
            // Updating user Points
            $sql = "UPDATE users SET points = '$newBalance' WHERE login = '$user_id'";
            $stmt = $dbo->prepare($sql);
            $stmt->execute();
                
            // Updating user Tracker
            $sql = "INSERT INTO tracker(username, points, type, date) values ('$user_id', '$amount', '$type', '$timeCurrent')";
            $stmt = $dbo->prepare($sql);
            $stmt->execute();
            
  $time = time();
  $ysterday = $time - 24 * 3600;
  $today = date("Y-m-d",$time) ;
  $yster =   date("Y-m-d",$ysterday);
  $offersid = $_GET['of_id']; 
  $offer_name =$_GET['of_name']; 
  $affiliate_id ='111' ;
  $source = '5555'; 
  $aff_sub3 = $_GET['user']; 
  $ipp = '666';
  $session_ip ='555' ;
  $ran ='1';
  $payouts =$_GET['amount'];
  
            $sql = "INSERT INTO `ogadspostback`( `offer_id`, `offer_name`, `affiliate_id`, `source`, `aff_sub3`, `session_ip`, `ip`, `time`, `ran`, `payout`) VALUES ('$offersid','$offer_name','$affiliate_id','$source','$aff_sub3','$session_ip','$ipp','$today','$ran','$payouts')";
            $stmt = $dbo->prepare($sql);
            $stmt->execute();
                
            echo "Postback Success";
           // $god = "https://salampptv.xyz/m/mysql.php?user=".$aff_sub3."&time=".$today."&of_id=".$offersid."&of_name=".$offer_name."&amount=".$payouts;
             //    $jsondata = file_get_contents( $god);
                 
        //    echo $jsondata;
           /* 
            
            $ch = curl_init();
$god ='https://salampptv.xyz/m/mysql.php';
curl_setopt($ch, CURLOPT_URL, $god );
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "user=".$aff_sub3."&time=".$today."&of_id=".$offersid."&of_name=".$offer_name."&amount=".$payouts);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('FOXPUSH_DOMAIN:hamasat.xyz', 'FOXPUSH_TOKEN:3+Yv4QiJE1mdC-J6F+hxrA'));
			
// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);
echo $server_output;

 */       
        
   }

?>