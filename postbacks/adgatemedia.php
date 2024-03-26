<?php

    /*!
	 * POCKET v3.5
	 *
	 * http://www.droidoxy.com
	 * support@droidoxy.com
	 *
	 * Copyright 2019 DroidOXY ( http://www.droidoxy.com )
	 */
	
	include_once("../admin/core/init.inc.php");
	
	// http://yoururl.com/postbacks/adgatemedia.php?tx_id={transaction_id}&user_id={s2}&point_value={points}&usd_value={payout}&offer_title={vc_title}
	
    $user_id = $_REQUEST['user_id'];
    $amount = $_REQUEST['point_value'];
    
    $timeCurrent = time();
    
    $configs = new functions($dbo);
    
    $type = "AdGateMedia offerwall Credit";
    
    // Checking Remote Ip
    if($configs->isWhitelisted($_SERVER["REMOTE_ADDR"])){
        
        $account = new account($dbo, 1);
        $userdata = $account->getuserdata($user_id);
            
        if($userdata['username'] != $user_id){ api::printError(ERROR_UNKNOWN, "Account Mismatch"); }else{
                
            $newBalance = $userdata['points'] + $amount;
                
            // Updating user Points
            $sql = "UPDATE users SET points = '$newBalance' WHERE login = '$user_id'";
            $stmt = $dbo->prepare($sql);
            $stmt->execute();
                
            // Updating user Tracker
            $sql = "INSERT INTO tracker(username, points, type, date) values ('$user_id', '$amount', '$type', '$timeCurrent')";
            $stmt = $dbo->prepare($sql);
                
            if($stmt->execute()){ $configs->sendPush($userdata['gcm'], "credit", $amount, "none", "none"); }
                
            echo "1";
            
        }
        
		
	// Unknown Ip
	}else{ api::printError(ERROR_UNKNOWN, "Unknown Error"); }

?>