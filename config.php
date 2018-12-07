<?php 


class NeutrinoApiClient {
	const CONNECTION_TIMEOUT = 10;
	const ENDPOINT = "https://neutrinoapi.com/phone-validate";
	const USER_ID = "yaroslavk";
	const API_KEY = "VMudQCgwzN1KB5X0MA4mDguMhFJzlUPt5VauKW5RXuVe7pEi";

	private function curl_request($data) 
	{
		$url = static::ENDPOINT;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		curl_close($ch);
		return $content;
	}
	public function verify($number = null) 
	{
		$data = array(
			"user-id" => static::USER_ID,
			"api-key" => static::API_KEY,
			"number" => $number
		);

		$json = $this->curl_request($data); 
		$result = json_decode($json, true);
		return $result;
	}
}