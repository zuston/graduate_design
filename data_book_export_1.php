<?php
$file = fopen('data_book_1.txt','r') or exit('unable to open file');
$all_array = array();
while(!feof($file)){
	$array = split(' ',fgets($file));
	if(count($array)!=1){
		$all_array[] = $array;
	}
}
foreach($all_array as $key => &$value){
	$value[0] = split('、',$value[0])[1];
}
var_dump($all_array);
