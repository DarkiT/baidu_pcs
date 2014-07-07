<?php
include_once('common.php');
include_once './libs/BaiduPCS.class.php';
//$access_token = get_access_token();exit;
//global $access_token;

$pcs = new BaiduPCS($access_token);
$appName = 'hammer';

$root_dir = '/apps' . '/' . $appName . '/';

if ($argc <= 1) {
	exit("Please input the uploaded file.\n");
}
//print_r($args);
$file = $argv[1];
if (!file_exists($file)) {
	exit("The File does not exist.\n");
}
$newFileName = '';
if (isset($argv[2])) {
	//if path exists
	$path = $root_dir . $argv[2];
	$targetPath = dirname($path) . '/';
	$resMeta = $pcs->getMeta($targetPath);
	$arrMeta = json_decode($resMeta, true);
	//print_r($arrMeta);
	//echo $targetPath;exit;
	if (isset($arrMeta['error_code']) && $arrMeta['error_code'] == 31066) {

		$resDir = $pcs->makeDirectory($targetPath);
		$arrDir = json_decode($resDir, true);
	}
	$newFileName = basename($path);
}

$fileName = basename($file);


$pcs = new BaiduPCS($access_token);
$fileSize = filesize($file);
$handle = fopen($file, 'rb');
$fileContent = fread($handle, $fileSize);
$result = $pcs->upload($fileContent, $targetPath, $fileName, $newFileName);
fclose($handle);
output($result);
