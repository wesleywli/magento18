<?php

/* �W�١GhiAir Send Text For PHP�d�ҵ{��
 * ���g�� : HiNet - hiAir , Chih-Ming Liao
 * ��� : 2006/06/27
 */

include "sms2.inc";

error_reporting (E_ALL);

echo "<h2> hiAir �ǰe��r²�T </h2>\n";

/* Socket to Air Server IP ,Port */
$server_ip = '202.39.54.130';
$server_port = 8000;
$TimeOut=10;

$user_acc  = "airtest5";
$user_pwd  = "MZmGO";
$mobile_number= "0931274075";
$message= "hiAir²�T����";


/*�إ߳s�u*/
$mysms = new sms2();
$ret_code = $mysms->create_conn($server_ip, $server_port, $TimeOut, $user_acc, $user_pwd);
$ret_msg = $mysms->get_ret_msg();

if($ret_code==0){ 
      echo "�s�u���\\"."<br>\n";
      /*�p���ǰe�h��²�T�A�s�u���\��ϥΰj�����$mysms->send_text()�Y�i*/
      $ret_code = $mysms->send_text($mobile_number, $message);
      $ret_msg = $mysms->get_ret_msg();
      if($ret_code==0){
      	 echo "²�T�ǰe���\\"."<br>";
         echo "ret_code=".$ret_code."<br>\n";
         echo "ret_msg=".$ret_msg."<br>\n";
      }else{
      	 echo "²�T�ǰe����"."<br>\n";
         echo "ret_code=".$ret_code."<br>\n";
         echo "ret_msg=".$ret_msg."<br>\n";
      }
} else {  
      echo "�s�u����"."<br>\n";
      echo "ret_code=".$ret_code."<br>\n";
      echo "ret_msg=".$ret_msg."<br>\n";
}

/*�����s�u*/
$mysms->close_conn();
?>

