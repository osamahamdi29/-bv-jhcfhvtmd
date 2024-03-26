<?php
	 /*
	 *  AddOn Name      :   AdGem Offerwall
	 *  AddOn URL       :   https://www.droidoxy.com/item/adgem-offerwall/
	 *  AddOn License   :   https://www.droidoxy.com/licenses/
	 *
	 *  This Code is a part of Premium AddOn. Do not Share this code.
	 * 
	 *  ALL RIGHTS RESERVED
	 *
	 *  http://www.droidoxy.com
	 *  support@droidoxy.com
	 *
	 *  Copyright 2020 DroidOXY ( http://www.droidoxy.com )
	 *
	 */
    
    // URL : https://your-domain.com/postbacks/adgem.php?user_id={player_id}&amount={amount}
    
    include_once("../admin/core/init.inc.php");
	 
	$network_name = "AdGem";
    $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : 'none';
    $points = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : 0;
 
    
    $account = new account($dbo);
    $userdata = $account->getuserdata($user_id);
    $user_name_from_database = isset($userdata['username']) ? $userdata['username'] : "none";
    
    if($user_name_from_database === $user_id){
        
        // Valid User - Reward the user here
        $points = intval($points);
        $newBalanceofUser = $userdata['points'] + $points;
        $type = $network_name." offerwall Credit";
        $timeCurrent = time();
        
        // Updating user Points
        $sql = "UPDATE users SET points = '$newBalanceofUser' WHERE login = '$user_name_from_database'";
        $stmt = $dbo->prepare($sql);
        $stmt->execute();
        
        // Updating user Tracker
        $sql = "INSERT INTO tracker(username, points, type, date) values ('$user_name_from_database', '$points', '$type', '$timeCurrent')";
        $stmt = $dbo->prepare($sql);
        $stmt->execute();
        
        // All Good - Successfully Rewarded
        echo "OK - Postback Success";
        exit();
        
    }
    
    echo "NOT OK - Postback Failed";
    
?>
