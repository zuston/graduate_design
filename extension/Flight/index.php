<?php
require 'flight/Flight.php';

Flight::route('/user/', function(){
    echo 'hello!';
});

Flight::route('',function(){
    echo 'hello world';
});
Flight::start();
?>
