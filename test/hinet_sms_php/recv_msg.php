<?php

/* �W�١GhiAir recv Text For PHP�d�ҵ{��
 * ���g�� : HiNet - hiAir , Chih-Ming Liao
 * ��� : 2007/01/09
 */

include "sms2.inc";

error_reporting (E_ALL);

echo "<h2> hiAir ������r²�T���G </h2>\n";

/* Socket to Air Server IP ,Port */
$server_ip = '202.39.54.130';
$server_port = 8000;
$TimeOut=10;

$user_acc  = "�b��";
$user_pwd  = "�K�X";


/*�إ߳s�u*/
$mysms = new sms2();
$ret_code = $mysms->create_conn($server_ip, $server_port, $TimeOut, $user_acc, $user_pwd);
$ret_msg = $mysms->get_ret_msg();

if($ret_code==0){ 
      echo "�s�u���\\"."<br>\n";
      $ret_code = $mysms->recv_msg();
      $ret_msg = $mysms->get_ret_msg();
      $send_tel = $mysms->get_send_tel();
      echo "�������G:"."<br>\n";
      echo "ret_code=".$ret_code."<br>\n";
      echo "ret_msg=".$ret_msg."<br>\n";
      echo "send_tel=".$send_tel."<br>\n";
} else {  
      echo "�s�u����"."<br>\n";
      echo "ret_code=".$ret_code."<br>\n";
      echo "ret_msg=".$ret_msg."<br>\n";
}

/*�����s�u*/
$mysms->close_conn();
?>

