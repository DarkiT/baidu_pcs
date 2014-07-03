<?php
include_once('common.php');
include_once './libs/BaiduPCS.class.php';
$access_token = '23.a02461d8d757b48aaabaf11b6e2f0290.2592000.1405521387.2604610008-2921205';
$appName = 'hammer';
//应用根目录
$root_dir = '/apps' . '/' . $appName . '/';

//要创建的目录路径
$path = $root_dir . '.1.1.1.';


$pcs = new BaiduPCS($access_token);
$result = $pcs->makeDirectory($path);

$result = json_decode($result, true);

if (isset($result['error_code']) && !empty($result['error_code'])) {
	echo "error code:" . $result['error_code'] . "\n" . "error message:" . $result['error_msg'] . "\n";
	exit;
}


