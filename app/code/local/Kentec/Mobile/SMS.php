<?php

include "sms2.inc";

class SMS {
	public static function sendTWN($mobile, $message) {
		$username = "atonaatona";		// 帳號
		$password = "";		// 密碼
		// $mobile = "0931274075";	// 電話
		// $message = "簡訊測試";	// 簡訊內容
		$MSGData = "";
		$Tmp="";

		$msg = "username=".$username."&password=".$password."&mobile=".$mobile."&message=".urlencode($message);
		$num = strlen($msg);		

		// 打開 API 閘道
		$fp = fsockopen ("api.twsms.com", 80);
		if ($fp) {
			$MSGData .= "POST /smsSend.php HTTP/1.1\r\n";
			$MSGData .= "Host: api.twsms.com\r\n";
			$MSGData .= "Content-Length: ".$num."\r\n";
			$MSGData .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$MSGData .= "Connection: Close\r\n\r\n";
			$MSGData .= $msg."\r\n";
			fputs ($fp, $MSGData);

			// 取出回傳值
			while (!feof($fp)) $Tmp.=fgets ($fp,128); 

			// 關閉閘道
			fclose ($fp);

			// echo "傳送完成:".$Tmp;
		} else {
			// echo "您無法連接 TwSMS API Server";
		}
	}


	public static function sendHINET($mobile_number, $message) {
		// error_reporting (E_ALL);

		// echo "<h2> hiAir 傳送文字簡訊 </h2>\n";

		/* Socket to Air Server IP ,Port */
		$server_ip = '202.39.54.130';
		$server_port = 8000;
		$TimeOut=10;

		$user_acc  = "airtest5";
		$user_pwd  = "MZmGO";
		// $mobile_number= "";
		// $message= "hiAir簡訊測試";


		/*建立連線*/
		$mysms = new sms2();
		$ret_code = $mysms->create_conn($server_ip, $server_port, $TimeOut, $user_acc, $user_pwd);
		$ret_msg = $mysms->get_ret_msg();


		if($ret_code==0){ 
		      // echo "連線成功"."<br>\n";
		      /*如欲傳送多筆簡訊，連線成功後使用迴圈執行$mysms->send_text()即可*/
		      $ret_code = $mysms->send_text($mobile_number, $message);
		      $ret_msg = $mysms->get_ret_msg();
		      if($ret_code==0){
		      	 // echo "簡訊傳送成功"."<br>";
		        //  echo "ret_code=".$ret_code."<br>\n";
		        //  echo "ret_msg=".$ret_msg."<br>\n";
		         return true;
		      }else{
		      	 // echo "簡訊傳送失敗"."<br>\n";
		        //  echo "ret_code=".$ret_code."<br>\n";
		        //  echo "ret_msg=".$ret_msg."<br>\n";
		         return false;
		      }

		      
		} else {  
				 // echo "連線失敗"."<br>\n";
			  //    echo "ret_code=".$ret_code."<br>\n";
			  //    echo "ret_msg=".$ret_msg."<br>\n";

			  return false;
		}	

		/*關閉連線*/
		$mysms->close_conn();

	}
}