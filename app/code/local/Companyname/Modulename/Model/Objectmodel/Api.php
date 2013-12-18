<?php
class Companyname_Modulename_Model_Objectmodel_Api extends Mage_Api_Model_Resource_Abstract
{
     /**
     * method Name
     *
     * @param string $orderIncrementId
     * @return string
     */
    public function methodName( $arg )
    {
        Mage::log("Companyname_Modulename_Model_Objectmodel_Api: methodName called");
        $result = "hello world! My Argument is " . $arg;
        return $result;
    }
}
?>