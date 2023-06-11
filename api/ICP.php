<?php
header("Content-type:application/json; charset=UTF-8");
function getData($x){
	$url 	= "https://cgi.urlsec.qq.com/index.php?m=check&a=check&url={$x}";
	$header = [
		'Referer: https://guanjia.qq.com'
	];
	$options = array(
		'http' => array(
	        'header'  => $header,
	        'method'  => 'GET',
	        'timeout' => 5
	    )
	);
	$context = stream_context_create($options);
	$response = file_get_contents($url, false, $context);
	if ($response) {
		$response	=	substr($response, 1);
		$response	=	json_decode(substr($response, 0, -1));	
		$results	=	$response->data->results;

		$whitetype = [
			'报白',
			'拦截',
			'正常'
		];

		if ($results && empty($results->whitetype) == false) {
			//print_r($results);
			if($results->isDomainICPOk == 1){
				$json['ICPSerial']		=	$results->ICPSerial;
				$json['Orgnization']	=	$results->Orgnization;
			}

			$qqJson = array(
				'name'		=> 'QQ',
				'states'	=> $whitetype[$results->whitetype-1],
				'msg'		=> $results->WordingTitle
			);
		
			$json['data'][] = $qqJson;
			
			return $json;
		}
	}
	
}

$link = htmlspecialchars($_GET['d']);
if (!preg_match('/^(http|https):\/\//', $link)) {
	$link = 'http://'.$link;
}

print_r(json_encode(getData($link),128|256));

?>
