<?php
mysql_connect("10.23.0.243","root","zSwZyLLjs2018");
mysql_select_db("smart_store");
mysql_query("SET NAMES 'utf8'");
$csv=file_get_contents("./cover.csv");
$lines=explode("\n",$csv);
foreach($lines as $line){
	$row=explode(',',$line);
	if(!isset($row[0])) continue;
	if(!isset($row[1])) continue;
	$sql="UPDATE `spu` SET `cover`='{$row[1]}' WHERE `id`='{$row[0]}'";
	mysql_query($sql);
}
echo 'ok';
?>