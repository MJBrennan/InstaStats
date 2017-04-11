@extends('layouts.app')
@section('content')
<center><div><p>Your Current Location is:</p><br><p>Here are some photos in this location</p></div></center>
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
     <center><button id="butt" class="btn btn-primary">Load More</button></center>
     </div>
     </div>

@endsection

@section('scripts')

<script src="https://blackrockdigital.github.io/startbootstrap-thumbnail-gallery/js/jquery.js"></script>
<script src="https://blackrockdigital.github.io/startbootstrap-thumbnail-gallery/js/bootstrap.min.js"></script>
 <script>



$(window).ready(function(){


function successFunction(position) {
   var lat1 = position.coords.latitude;
   var long1 = position.coords.longitude;

   $.ajaxSetup({
     headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
     });

   $.ajax({
    method:"post",
   // dataType:"json",
    data:{"lat":lat1,"long":long1},
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


   $("#butt").click(function()
    {
        $.ajax(
        {
            url:"getMore",
            method:"post",
            data:{"more" : next_page},
            success:function(response)
            {
                var myObj = $.parseJSON(response);
                var size = myObj.data.length - 1 ;
                for($i=0;$i<=size;$i++){
                $("#appendHere").append(' <div class="col-lg-3 col-md-4 col-xs-6 thumb"><a class="thumbnail" href="'+  myObj.data[$i].images.standard_resolution.url  +'"> <img class="img-responsive" src="'+  myObj.data[$i].images.standard_resolution.url  +'" alt=""></a></div>');
                next_page = myObj.pagination.next_url;
                }
            }
        });
    });


}


if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successFunction);
} else {
    alert('It seems like Geolocation, which is required for this page, is not enabled in your browser. Please use a browser which supports it.');
}




});

</script>

@endsection
