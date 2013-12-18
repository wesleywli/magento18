<?php
$string = file_get_contents("list.json");
$json_a=json_decode($string,true);
echo  $json_a['msg'];

foreach($json_a['data'] as $key => $value) {
	echo 'record \n';
	echo $value['id'].'\n';
	echo $value['name'].'\n';
	echo $value['url'].'\n';
	echo '\n';
}