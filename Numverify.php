<?php 
/***********************************************

Wrapper for working with Numverify Api
Docs: https://numverify.com/documentation

Login data: 
 - user name: notmyspambox@mail.ru
 - password: 123123
 
 - api key: afd0d449aa7f1a0ff9485ffe29e9c673

Author: ageruuu@gmail.com

***********************************************/


class NumverifyApiClient {
	const ENDPOINT = "http://apilayer.net/api/validate";
	const API_KEY = "afd0d449aa7f1a0ff9485ffe29e9c673";

	private function curl_request($data) 
	{
		$url = static::ENDPOINT;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url.'?'.http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		curl_close($ch);
		return $content;
	}
	public function verify($number = null) 
	{
		$data = array(
			"access_key" => static::API_KEY,
			"number" => $number,
			"format"=>1
		);

		$json = $this->curl_request($data); 
		$result = json_decode($json, true);
		return $result;
	}
}