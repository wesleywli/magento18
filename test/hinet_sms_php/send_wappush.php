<?php

/* �W�١GhiAir Send WapPush For PHP�d�ҵ{��
 * ���g�� : HiNet - hiAir , Chih-Ming Liao
 * ��� : 2006/06/27
 */

include "sms2.inc";

error_reporting (E_ALL);

echo "<h2> hiAir �ǰeWapPush </h2>\n";

/* Socket to Air Server IP ,Port */
$server_ip = '202.39.54.130';
$server_port = 8000;
$TimeOut=10;

$user_acc  = "�b��";
$user_pwd  = "�K�X";
$mobile_number= "��������";
$wap_title= "wap���D";
$wap_url= "http://xxx.xxx";

/*�إ߳s�u*/
$mysms = new sms2();
$ret_code = $mysms->create_conn($server_ip, $server_port, $TimeOut, $user_acc, $user_pwd);
$ret_msg = $mysms->get_ret_msg();

if($ret_code==0){ 
      echo "�s�u���\\"."<br>\n";
      /*�p���ǰe�h���A�s�u���\��ϥΰj�����$mysms->send_wappush()�Y�i*/
      $ret_code = $mysms->send_wappush($mobile_number, $wap_title, $wap_url);
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

