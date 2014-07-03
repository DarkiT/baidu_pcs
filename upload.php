<?php
include_once('common.php');
include_once './libs/BaiduPCS.class.php';
$access_token = get_access_token();exit;
print_r($access_token);exit;
//global $access_token;
$access_token = '23.950b70f493527a96be0bc3a48baad7d0.2592000.1406207728.2604610008-2967571';

$appName = 'hammer';

$root_dir = '/apps' . '/' . $appName . '/';

$targetPath = $root_dir;
if ($argc <= 1) {
	exit("Please input the uploaded file.\n");
}
//print_r($args);
$file = $argv[1];
if (!file_exists($file)) {
	exit("The File does not exist.\n");
}
//$file = dirname(__FILE__) . '/' . 'README.md';
//file name
$fileName = basename($file);

$newFileName = '';

$pcs = new BaiduPCS($access_token);
$fileSize = filesize($file);
$handle = fopen($file, 'rb');
$fileContent = fread($handle, $fileSize);
$result = $pcs->upload($fileContent, $targetPath, $fileName, $newFileName);
fclose($handle);
output($result);
