<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/account.class.php';
require_once 'class/log.class.php';


$username = isset($_POST['account']) ? $_POST['account'] : '';  
$password = isset($_POST['password']) ? $_POST['password'] : '';  
$imgCode2 = isset($_POST['imgCode']) ? $_POST['imgCode'] : '';  



@session_start();
// store session data
$imgCode=$_SESSION['securimage_code_value'];

//将字母均转换为小写之后再比较
if(strtolower($imgCode)!=strtolower($imgCode2)){
	$result["total"] = -1;  
	$result["rows"] = array();  
	$jsonresult= json_encode($result); 
	echo $jsonresult; 
}
if(strtolower($imgCode)==strtolower($imgCode2)){

	$accountClass = new accountClass();
	$total=$accountClass->getCountByusername($username,$password);


	//$row = mysql_fetch_row($rs);  
	$result["total"] = $total;  

	$items = $accountClass->getAllItemsByusername($username,$password);
	$result["rows"] = $items;  
	if($total==1){
		//session_start();
		// store session data
		$_SESSION['username']=$items[0]['username'];
		$_SESSION['name']=$items[0]['name'];
		$_SESSION['role']=$items[0]['role'];
		$_SESSION['email']=$items[0]['email'];
		$_SESSION['fee']=$items[0]['fee'];
		$_SESSION['numbers']=$items[0]['numbers'];
		$_SESSION['numbers2']=$items[0]['numbers2'];
	} 

	$logClass = new logClass();
	$logClass->addItem($username);
	$jsonresult= json_encode($result); 
	echo $jsonresult; 	

}
?>