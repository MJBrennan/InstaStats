@extends('layouts.app')
@section('content')
<center><div><p>Your Current Location is:</p></div></center>
<center><div id="location"></div></center>
     <div class="container">
        <div class="row" id="appendHere">
        	<div class="col-lg-12">
                <center><h4 class="page-header">`</h4></center>
            </div>                                         
        </div>
     </div>
     <div class="container">
     <div class="row">
     <button id="butt">Load More</button>
     </div>
     </div>

@endsection

@section('scripts')

<script src="https://blackrockdigital.github.io/startbootstrap-thumbnail-gallery/js/jquery.js"></script>
<script src="https://blackrockdigital.github.io/startbootstrap-thumbnail-gallery/js/bootstrap.min.js"></script>
 <script>

$(window).ready(function(){

var latLong;
var lat = 53.375349;
var long = -6.231568;
/**
$.ajax({
    method:"get",
    url:"http://freegeoip.net/json/",
    success: function(data){
    var data = data.latitude;
    //console.log(data);
    latLong.data;
        }
     });


     */

	$.ajaxSetup({
     headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
     });

	$.ajax({
	method:"post",
   // dataType:"json",
	data:{"lat":lat,"long":long},
	url:"currentlocation",
	success: function(response){
	var obj = $.parseJSON(response);
	var location = obj.data[0].location.name;
    //First Data
    $("#location").append("<p>"+ location +"</p>");

    //Second Data
    var size = obj.data.length - 1 ;
        for($i=0;$i<=size;$i++)
        {
        $("#appendHere").append(' <div class="col-lg-3 col-md-4 col-xs-6 thumb"><a class="thumbnail" href="#"> <img class="img-responsive" src="'+  obj.data[$i].images.standard_resolution.url  +'" alt=""></a></div>');
            next_page = obj.pagination.next_url;
        }
	 }

     
	});

});

</script>

@endsection
