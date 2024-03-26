<?php

  
	

   $username =  $_REQUEST['user'];
    $user_id = $_REQUEST['id'];
   // $amount = $_REQUEST['amount'];
   // $linkid= $_REQUEST['url'];
   // $type = "Coustom offers";
    
    $B = array();

//Please edit database details

$B['DB_HOST'] = "localhost";                                //localhost or your Database host
$B['DB_NAME'] = "bestiaqn_bigclapps";                             //your Database name
$B['DB_USER'] = "bestiaqn_bigclapps";                             //your Database user
$B['DB_PASS'] = "syria321"; 

    $conn=mysqli_connect($B['DB_HOST'],$B['DB_USER'],$B['DB_PASS'],$B['DB_NAME']);

     if(mysqli_connect_error(!$conn))
        {
    echo "Unable To Connect";
        }else
        {

     $sql = "SELECT * FROM `offers_s` WHERE id='$user_id'";  
    $result = $conn->query($sql);

 if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$x_link = $row['link'];
$x_points= $row['points'];
 $timeCurrent = time();
 $time = time();
  $ysterday = $time - 24 * 3600;
  $today = date("Y-m-d",$time) ;
  $yster =   date("Y-m-d",$ysterday);

     $sql2 = "SELECT * FROM `tracker` WHERE link=' $linkid'  AND username='$username'";  
       $result2 = $conn->query($sql2); 
     if ($result2->num_rows > 0) { 
    echo "تم أخذ العرض بشكل مسبق";     
         
  // header("Location: $x_link");      
         
     }else{
  
   $sql3 = "SELECT * FROM `users` WHERE login='$username'";  
       $result3 = $conn->query($sql3); 
  $row3 = $result3->fetch_assoc();
  
  
    $newBalance = $row3['points'] + $x_points;
    
     $sql4 = "UPDATE users SET points = '$newBalance' WHERE login = '$username'";

 $result4 = $conn->query($sql4);
  $frod ="custom offers :".$user_id;
  $sql5 = "INSERT INTO tracker(username, points, type, date) values ('$username', '$x_points', '$frod', '$today')";  
   $result5 = $conn->query($sql5);
   
   echo "true";
   
   
   if($result5){
    header("Location: $x_link"); 
    
    
   }else{
       echo "لم يتم تحديث البيانات";
   }
         
     }




}else{
    
echo "عرض غير موجود";    
    
}


        }
    
  


?>