<?php
include_once('common.php');
include_once './libs/BaiduPCS.class.php';
//get_access_token();exit;
//global $access_token;
$access_token = '23.950b70f493527a96be0bc3a48baad7d0.2592000.1406207728.2604610008-2967571';

$pcs = new BaiduPCS($access_token);
$quota = $pcs->getQuota();
$quota = json_decode($quota, true);

if (isset($quota['error_code']) && !empty($quota['error_code'])) {
	echo $quota['error_msg'] . "\n";
	exit;
}
echo "total:" . format_bytes($quota['quota']) . "\n";
echo "used:" . format_bytes($quota['used']) . "\n";


