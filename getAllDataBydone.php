<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;  
$offset = ($page-1)*$rows;
require_once 'class/orders.class.php';
$ordersClass= new ordersClass();

//$total=$ordersClass->getCount();
$total=$ordersClass->getCountBydone();


//$row = mysql_fetch_row($rs);  
$result["total"] = $total;  

$items = $ordersClass->getAllItemsBydone($offset,$rows);
$result["rows"] = $items;   
$jsonresult= json_encode($result); 
echo $jsonresult; 
?>