<?php


	namespace App\Classes;

	class Location extends Curl{

		public $locationId;
		public $token;
		public $lat;
		public $long;
		
		public function __construct($token,$lat,$long)
		{
			$this->token = $token;
			$this->lat = $lat;
			$this->long = $long;

		}


		public function locate()
		{
			$this->getLatlong();
			$uri = "https://api.instagram.com/v1/locations/".$this->locationId."/media/recent?count=1&access_token=". $this->token."";
			$instagram_data = $this->curl_request($uri);
			return $instagram_data;
			
		}


		public function getLatlong()
		{
	$uri = "https://api.instagram.com/v1/locations/search?lat=". $this->lat ."&lng=".$this->long."&access_token=". $this->token."";
			$instagram_data = $this->curl_request($uri);
			$instagram_data = json_decode($instagram_data, true);
			$location = $instagram_data["data"]["0"];
			$this->locationId = $location["id"];
		}
	}