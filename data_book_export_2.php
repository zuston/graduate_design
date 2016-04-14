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
$value_sql='';
$i = 1235;
$sql = 'insert into book(book_code,book_name,book_author,book_price,book_type,book_count) values';
foreach($all_array as $key => $value){
	$value_sql .= '('.'"E'.$i++.'"'.','.'"'.$value[0].'"'.','.'"'.$value[1].'"'.','.rand(3000,4000).','.rand(1,6).','.rand(4,10).')'.',';

}
echo $sql.$value_sql;
