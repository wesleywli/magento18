<?php

/* 名稱：hiAir Send Text For PHP範例程式
 * 撰寫者 : HiNet - hiAir , Chih-Ming Liao
 * 日期 : 2006/06/27
 */

include "sms2.inc";

error_reporting (E_ALL);

echo "<h2> hiAir 傳送文字簡訊 </h2>\n";

/* Socket to Air Server IP ,Port */
$server_ip = '202.39.54.130';
$server_port = 8000;
$TimeOut=10;

$user_acc  = "airtest5";
$user_pwd  = "MZmGO";
$mobile_number= "0931274075";
$message= "hiAir簡訊測試";


/*建立連線*/
$mysms = new sms2();
$ret_code = $mysms->create_conn($server_ip, $server_port, $TimeOut, $user_acc, $user_pwd);
$ret_msg = $mysms->get_ret_msg();

if($ret_code==0){ 
      echo "連線成功\"."<br>\n";
      /*如欲傳送多筆簡訊，連線成功後使用迴圈執行$mysms->send_text()即可*/
      $ret_code = $mysms->send_text($mobile_number, $message);
      $ret_msg = $mysms->get_ret_msg();
      if($ret_code==0){
      	 echo "簡訊傳送成功\"."<br>";
         echo "ret_code=".$ret_code."<br>\n";
         echo "ret_msg=".$ret_msg."<br>\n";
      }else{
      	 echo "簡訊傳送失敗"."<br>\n";
         echo "ret_code=".$ret_code."<br>\n";
         echo "ret_msg=".$ret_msg."<br>\n";
      }
} else {  
      echo "連線失敗"."<br>\n";
      echo "ret_code=".$ret_code."<br>\n";
      echo "ret_msg=".$ret_msg."<br>\n";
}

/*關閉連線*/
$mysms->close_conn();
?>

