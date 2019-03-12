<?php
// $servername = "mysql"; 
// $username = "root"; 
// $password = "123456"; 

// try { 
//     $conn = new PDO("mysql:host=$servername;dbname=app_store", $username, $password); 
//     echo "Connected successfully"; 
//     } 
// catch(PDOException $e) 
//     { 
//     echo $e->getMessage(); 
//     } 
	// class a {}
	// $a = new a();
	// $test = $a->b->c->d??'';
	// var_dump($test);
	// exit;

$url = 'http://kpserverprod-1251506165.cossh.myqcloud.com/upload/upload/contract/1536746329_d034b2d10fa9ca3d5e01efaefb805a38.jpg';
// $pattern = '/^(http)s?:+\/\/[^\s]+\.(jpg|jpeg|png|gif|bmp|pdf)$/i';
// $pattern = '/^http(s)*:\/\/[^s]+$/i';
// if(preg_match($pattern, $url)){
	// echo 111;
// }
$img = file_get_contents('"'.$url.'"');
var_dump($img);



// $pattern = '/^([A-Z\d]{15})$|^([A-Z\d]{18})$|^([A-Z\d]{20})$/';
// $code = '91370100MA3NE9B';

// if(preg_match($pattern, $code)){
// 	echo 2222;
// }

// function func($a){
// 	return $a;
// }
// $a = func($a->b->c)??1;
// var_dump($a);

// function trimAll($attribute)
// {
//     $find = [" ", "　", "\t", "\n", "\r"];
//     $replace = ["", "", "", "", ""];
//     return str_replace($find, $replace, $attribute);
// }

// $pattern = '/^((0\d{2,3}-?\d{7,8})|(1[35784]\d{9}))$/';
// // $pattern = '/^(0\d{2,3}-?\d{7,8})$/';
// $mobile = '010-57321333';
// if(preg_match($pattern, trimAll($mobile))){
// 	echo 111;
// }