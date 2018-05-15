<form method="GET">
	<input type="text" name="orderCode">
	<input type="submit" name="submit">
</form>
<hr/>
<?php
if(!isset($_GET['orderCode']) || !isset($_GET['submit'])) die("请查询");
mysql_connect("10.23.0.243","root","zSwZyLLjs2018");
mysql_select_db("smart_store_log3");
mysql_query("SET NAMES 'utf8'");
$orderCode=mysql_real_escape_string($_GET['orderCode']);
//查订单
$sql="select * from `smart_store`.`order_record` where `code`='{$orderCode}';";
$result=mysql_query($sql); if(!$result) die(mysql_error());
$row=mysql_fetch_array($result);
if(!$row) die("没有订单");
if(!isset($row['id'])) die("没有订单id");
//查回调
$sql="select * from `pay_callback` where `callBackData` like '%\"attach\":\"{$row['id']}\"%' AND `status`='1'";
$result=mysql_query($sql);
$result=mysql_query($sql); if(!$result) die(mysql_error());
$count=0;
while ($row=mysql_fetch_array($result)) {
	$count++;
	$callBackData=json_decode($row['callBackData'],true);
	if(!isset($callBackData['total_fee'])) die("支付数据缺总额");
	if(!isset($callBackData['transaction_id'])) die("支付数据缺流水号");
	echo "支付金额(分):{$callBackData['total_fee']}<br/>流水号:{$callBackData['transaction_id']}<hr/>";
}
if(!$count) die("没有成功的支付记录");
?>
