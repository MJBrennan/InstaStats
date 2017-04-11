<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Login;
use App\Classes\MainData;
use App\Classes\Location;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginUser()
    {
       return "Hi!";
    }

    public function token(Request $request)
    {
     $string = $_GET['code'];
     $uri = 'https://api.instagram.com/oauth/access_token'; 
     $data = [
    'client_id' => 'cc8425bff673412aa4b13e01aa2b16d3', 
    'client_secret' => '7e937685e6374463baea6234d2f7f87f', 
    'grant_type' => 'authorization_code', 
    'redirect_uri' => 'http://127.0.0.1:8000/auth', 
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
    return redirect('/landing');
    }


    public function returnData(Request $request)
    {
        $value = $request->session()->get('token');
        $data = new MainData($value);
        $ret = $data->profileInfo();
        return $ret;
    }

     public function recentPhotos(Request $request)
    {
        $value = $request->session()->get('token');
        $data = new MainData($value);
        $ret = $data->recentPhotos();
        return $ret;
    }

    public function location(Request $request)
    {
        $lat = $_POST["lat"];
        $long = $_POST["long"];
        $value = $request->session()->get('token');
        $data = new Location($value,$lat,$long);
        $ret = $data->locate();
        return  $ret;
    }

     public function followers(Request $request)
    {
        $value = $request->session()->get('token');
        $data = new MainData($value);
        $ret = $data->follows();
        return $ret; 
    }


    public function extraData(Request $request)
    {
       $more =  $_POST["more"];
       $value = $request->session()->get('token');
       $data = new MainData($value);
       $ret = $data->loadNewPhotos($more);
       return $ret; 
    }


    public function followsMe(Request $request)
    {
        $value = $request->session()->get('token');
        $data = new MainData($value);
        $ret = $data->followedBy();
        return $ret; 
    }

    public function logOut(Request $request)
    {
        $request->session()->forget('token');
        return redirect('/');
    }
}
