@extends('layouts.app')



@section('content')
   <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <center><div class="panel-heading">Login</div></center>
                <div class="panel-body">
            <center><a class="btn btn-primary" href="https://www.instagram.com/oauth/authorize/?client_id=cc8425bff673412aa4b13e01aa2b16d3&redirect_uri=http://127.0.0.1:8000/auth&response_type=code&scope=basic+public_content+follower_list+comments+relationships+likes">Login With Instagram</a></center>    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
