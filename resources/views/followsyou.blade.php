@extends('layouts.app')



@section('content')

<center><div><p>Follows You</p></div></center>

     <div class="container">
        <div class="list-group" id="dataHere">
        

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

$.ajaxSetup({
     headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
     });
/**
    $.ajax({
    method:"get",
    url:"getFollowers",
    success: function(response){
       var obj = $.parseJSON(response);
       var size = obj.data.length - 1 ;

       for($i=0;$i<=size;$i++)
       {
       $("#dataHere").append('<a href="#" class="list-group-item list-group-item-action"><b>Username:</b>    ' + obj.data[$i].username +' <b>Fullname:</b> '+ obj.data[$i].full_name +'</a>');
         }
        }
    });
**/

    $("#butt").click()
    {

         $.ajax({
    method:"get",
    url:"getFollowers",
    success: function(response){
       var obj = $.parseJSON(response);
       var size = obj.data.length - 1 ;

       for($i=0;$i<=size;$i++)
       {
       $("#dataHere").append('<a href="#" class="list-group-item list-group-item-action"><b>Username:</b>    ' + obj.data[$i].username +' <b>Fullname:</b> '+ obj.data[$i].full_name +'</a>');
         }
        }
    });

    }



});

</script>

@endsection
