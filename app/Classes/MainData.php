<?php

	namespace App\Classes;
	use Illuminate\Http\Request;

	session_start();
	class MainData extends Curl{

		public $token;

		public function __construct($token)
		{
			$this->token = $token;
		}

		public function profileInfo()
		{
			$uri = "https://api.instagram.com/v1/users/self/?access_token=". $this->token."";
			$request = $this->curl_request($uri);

			return $request;
		}


		public function getMoreInfo($data)
		{

			$uri = $data;
			//var_dump(expression)
			$request = $this->curl_request($uri);
			return var_dump($request);
		}

		public function recentLikes()
		{
			$uri = "https://api.instagram.com/v1/users/self/media/liked?count=1&access_token=". $this->token."";
			$instagram_data = $this->curl_request($uri);
			return $instagram_data;
		}


		public function recentPhotos()
		{
			$uri = "https://api.instagram.com/v1/users/self/media/recent/?count=2&access_token=". $this->token."";
			$instagram_data = $this->curl_request($uri);
			return $instagram_data;

		}


		public function follows()
		{
			$uri = "https://api.instagram.com/v1/users/self/follows?access_token=".$this->token."";
			$instagram_data = $this->curl_request($uri);                                                                                                      
			return $instagram_data;
		}

		public function followedBy()
		{
			$uri = "https://api.instagram.com/v1/users/self/followed-by?access_token=". $this->token."";
			$instagram_data = $this->curl_request($uri);                                                                                                      
			return $instagram_data;
		}

		public function getPhotosLocation()
		{
			$uri = "https://api.instagram.com/v1/locations/search?lat=53.375811&lng=-6.231447&access_token=". $this->token."";
			$uri = "https://api.instagram.com/v1/locations/250498934/media/recent?access_token=". $this->token."";
			$instagram_data = $this->curl_request($uri);                                                                                          
		}

		public function loadNewPhotos($newPhotos)
		{
			$uri = $newPhotos;
			$instagram_data = $this->curl_request($uri);
			return $instagram_data;
		}
	}