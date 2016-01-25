<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
$offset = ($page-1)*$rows;
require_once 'class/orders.class.php';
$ordersClass= new ordersClass();

session_start();//初始化session
$username=$_SESSION['username'];

$total=$ordersClass->getCountBydone2($username);


//$row = mysql_fetch_row($rs);  
$result["total"] = $total;  

$items = $ordersClass->getAllItemsBydone2($username,$offset,$rows);
$result["rows"] = $items;   
$jsonresult= json_encode($result); 
echo $jsonresult; 
?>