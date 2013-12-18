<?php

// require_once dirname(dirname(dirname(__FILE__))).'/Mobile/SMS.php';

class Kentec_Checkoutexd_Model_Order_Observer {

    // public function __construct()
    // {
    // }
    
    public function sendTWN($mobile, $message) {
        $username = "atonaatona";       // 帳號
        $password = "";     // 密碼
        // $mobile = "0931274075";  // 電話
        // $message = "簡訊測試";   // 簡訊內容
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

      


    public function submitCheckoutData($observer)
    {

        $order = $observer->getEvent()->getOrder();

        if($order->getCustomerId()) {
            try {
                $customer = Mage::getModel('customer/customer')->load($order->getCustomerId());
                
                $payMethod = '';
                if( $order->getPayment()->getMethod() == 'checkmo') {
                    $payMethod = '貨到付歀';
                } else if( $order->getPayment()->getMethod() == 'ccsave') {
                    $payMethod = '信用卡';
                }
                
                $msg = $order->getCustomerFirstname().$order->getCustomerLastname().'您好!'.
                    '謝謝您在金運商城購物。'.
                    '你的訂單編號:'.$order->getIncrementId().
                    ',總金額: NT$'.$order->getGrandTotal().
                    ',付歀方式: '.$payMethod.
                    '。謝謝。'; 

                
                file_put_contents("order.msg", $msg);
                // $boxconfigModel = Mage::getModel('checkoutexd/creditcard');
                // $boxconfigModel->setId('7')
                //             ->setCustomerId('9')
                //             ->setName($msg)
                //             ->setType('VI')
                //             ->setNumber('4916 9975 4941 3906')
                //             ->setExpYear('2018')
                //             ->setExpMonth('1')
                //             ->setVerifyNumber('504')
                //             ->save();
                            
                // SMS::sendHINET($customer->getMobile(), $msg);
                // $this->sendTWN($customer->getMobile(), $msg);

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }    
        } 


        
        
    }
    
}