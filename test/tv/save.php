<?php
$obj = $_POST['obj'];
// $objFromPost = filter_input(INPUT_POST, 'obj', FILTER_SANITIZE_STRING);
// $obj = json_decode($objFromPost);
$list = array();

for($i=0; $i<count($obj)/4; $i++) {
	$row = array(
			"id"=>(int)$obj[$i*4]['value'],
			"name"=>$obj[$i*4+1]['value'],
			"image"=>$obj[$i*4+2]['value'],
	        "url"=>$obj[$i*4+3]['value'],
			);
	array_push($list, $row);	
}

$info = array (
		"code" => 0,
		"msg" => "OK",
		"data" => $list 
);
		
$file = file_put_contents("list.php", json_encode ( $info ));