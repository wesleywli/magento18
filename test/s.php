<?php
    $mage_url = "http://localhost/magento17/api/soap?wsdl";
	$mage_user = 'wesley';
	$mage_api_key = 'wesleyapikey';
	$soap = new SoapClient('http://emilk.kenmec.com/magento17/index.php/api/soap?wsdl', array('trace' => 1, 'connection_timeout' => 120));
	$session_id = $soap->login( $mage_user, $mage_api_key );
// Make the API-call
$resources = $soap->resources( $session_id );
?>
<?php if( is_array( $resources ) && !empty( $resources )) { ?> 
<?php foreach( $resources as $resource ) { ?> 
<h1><?php echo $resource['title']; ?></h1> 
Name: <?php echo $resource['name']; ?><br/>
Aliases: <?php echo implode( ',', $resource['aliases'] ); ?> 
<table> 
    <tr> 
        <th>Title</th> 
        <th>Path</th> 
        <th>Name</th> 
    </tr> 
    <?php foreach( $resource['methods'] as $method ) { ?> 
    <tr> 
        <td><?php echo $method['title']; ?></td> 
        <td><?php echo $method['path']; ?></td> 
        <td><?php echo $method['name']; ?></td> 
        <td><?php echo implode( ',', $method['aliases'] ); ?></td> 
    </tr> 
    <?php } ?> 
</table> 
<?php } ?> 
<?php } ?> 
