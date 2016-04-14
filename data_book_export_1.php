<?php
	$file = fopen('data_book_1.txt','r') or exit('unable to open file');
	$all_array = array();
	while(!feof($file)){
		$array = split(' ',fgets($file));
		if(count($array)==2){
			$all_array[] = $array;
		}
	}
	foreach($all_array as $key => &$value){
		$value[0] = trim(split('、',$value[0])[1]);
		$value[1] = trim($value[1]);
		if($value[0]==''){
			$value[0] = split('》',$value[1])[0];
			$value[0] = split('《',$value[0])[1];
			$value[1] = split('》',$value[1])[1];
		}
	}
	$value_sql='';
	$i = 3000;
	$sql = 'insert into book(book_code,book_name,book_author,book_price,book_type,book_count) values';
	foreach($all_array as $key => $value){
			$value_sql .= '('.'"F'.$i++.'"'.','.'"'.$value[0].'"'.','.'"'.$value[1].'"'.','.rand(3000,10000).','.rand(1,6).','.rand(4,10).')'.',';
	}
	echo $sql.$value_sql;
