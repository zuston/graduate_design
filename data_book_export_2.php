<?php 
$file = fopen('data_book_2.txt','r') or exit('unable to open file');
$all_array = array();

while(!feof($file)){
	$array = split('\(',fgets($file));
	if(count($array)==2){
		$dataP = trim($array[0]);
		$all_array[] = split('\/',$dataP);
	}
}
var_dump($all_array);
