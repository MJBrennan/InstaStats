<?php


namespace App\Classes;

	class Curl{

		public function curl_request($uri)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $uri); // uri
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // RETURN RESULT true
			curl_setopt($ch, CURLOPT_HEADER, 0); // RETURN HEADER false
			curl_setopt($ch, CURLOPT_NOBODY, 0); // NO RETURN BODY false / we need the body to return
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // VERIFY SSL HOST false
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // VERIFY SSL PEER false
			$result = curl_exec($ch); // execute curl
		
			if(curl_error($ch))
			{
				echo curl_error($ch);
			}
			return $result;
		}


		public function curl_init(Request $request)
		{

			 $string = $_GET['code'];
		     $uri = 'https://api.instagram.com/oauth/access_token'; 
		     $data = [
		    'client_id' => 'cc8425bff673412aa4b13e01aa2b16d3', 
		    'client_secret' => '7e937685e6374463baea6234d2f7f87f', 
		    'grant_type' => 'authorization_code', 
		    'redirect_uri' => 'http://instastatsapp.herokuapp.com/auth', 
		    'code' => $string
		     ];
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $uri); // uri
		    curl_setopt($ch, CURLOPT_POST, true); // POST
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // POST DATA
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // RETURN RESULT true
		    curl_setopt($ch, CURLOPT_HEADER, 0); // RETURN HEADER false
		    curl_setopt($ch, CURLOPT_NOBODY, 0); // NO RETURN BODY false / we need the body to return
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // VERIFY SSL HOST false
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // VERIFY SSL PEER false
		    $result = json_decode(curl_exec($ch)); // execute curl
		    $message = json_encode($result->access_token);
		    $mess = trim($message,'"');
		    $request->session()->put('token', $mess);
		    header("location:/return");
		}

	}