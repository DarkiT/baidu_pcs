<?php
require_once './libs/BaiduPCS.class.php';
//baidu account config
$bd_account_conf = array('api_key'     => 'Hj2XuP1pjs8FfVff9q3ipgfe',
			 'secret_key'  => 'VPMjulRaL0KOT1c5GgwaUiLb408uxc9e',
			 'authorize_uri' => 'https://openapi.baidu.com/oauth/2.0/token',
			 );

function get_access_token() {
	global $bd_account_conf;
	$params = array(
			'grant_type'    => 'client_credentials',
			'client_id'     => $bd_account_conf['api_key'],
			'client_secret' => $bd_account_conf['secret_key'],
			'scope'         => 'netdisk',
			);

	$params = http_build_query ( $params, '', '&' );
	$url  = $bd_account_conf['authorize_uri'];
	$url .= strpos($bd_account_conf['authorize_uri'], '?') ? '&' : '?';
	$url .= $params;
	echo $url;exit;
	$requestCore = new RequestCore();
	$requestCore->set_request_url($url);
	$requestCore->send_request();
	$result = $requestCore->get_response_body ();
	print_r($result);exit;
	return $result;
}
function http_post($url, $param = array()) {
	$post_data = '';
	if(!empty($param)) foreach ($param as $k=>$v) {
		$post_data .= '&'.$k.'='.urlencode($v);
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
	curl_setopt($ch, CURLOPT_POST, true) ;
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	$reponse = curl_exec($ch);
	curl_close($ch);
	return $reponse;
}

function format_bytes($size) { 
	$units = array(' B', ' KB', ' MB', ' GB', ' TB'); 
	for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024; 
	return round($size, 2).$units[$i]; 
}

function output($result) {
	$result = json_decode($result, true);
	if (isset($result['error_code']) && !empty($result['error_code'])) {
                echo "error code:" . $result['error_code'] . "\n";
		echo "error message:" . $result['error_msg'] . "\n";
		return false;
	}
	foreach((array)$result as $key => $val) {
		echo $key . ":" . $val . "\n";
	}
	return true;
}
$params = array(
	'grant_type'    => 'client_credentials',
	'client_id'     => $bd_account_conf['api_key'],
	'client_secret' => $bd_account_conf['secret_key'],
	'scope'         => 'netdisk',
	);


//$result = http_post('https://openapi.baidu.com/oauth/2.0/token',$params);
//print_r($result);

//get_access_token();
$access_token = '23.e4fa6dae708bb8b993660b7dbb6e4423.2592000.1405346988.2604610008-2921205';





