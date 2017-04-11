@extends('layouts.app')



@section('content')

<center><div><p>Follows You</p></div></center>

     <div class="container">
        <div class="list-group" id="dataHere">
        

        </div>
     </div>

     <div class="container">
     <div class="row">
     <center><button class="btn btn-primary" id="butt">Load More</button></center>
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

    $.ajax({
    method:"get",
    url:"getFollowers",
    success: function(response){
       var obj = $.parseJSON(response);
       var size = obj.data.length - 1 ;
       for($i=0;$i<=size;$i++)
       {
       $("#dataHere").append('<a href="#" class="list-group-item list-group-item-action"><b>Username:</b>    ' + obj.data[$i].username +' <b>Fullname:</b> '+ obj.data[$i].full_name +'</a>');
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
                console.log(response);
                var myObj = $.parseJSON(response);
                var size = myObj.data.length - 1 ;
                for($i=0;$i<=size;$i++){
                $("#appendHere").append(' <div class="col-lg-3 col-md-4 col-xs-6 thumb"><a class="thumbnail" href="'+  myObj.data[$i].images.standard_resolution.url  +'"> <img class="img-responsive" src="'+  myObj.data[$i].images.standard_resolution.url  +'" alt=""></a></div>');
                next_page = myObj.pagination.next_url;
                }
            }
        });
    });



});

</script>

@endsection
