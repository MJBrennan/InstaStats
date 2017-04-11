@extends('layouts.app')



@section('content')
<center>Your Recent Photos:</center>
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


        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Author</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <img src="http://lorempixel.com/207/316/nature" class="img-fluid" alt="Responsive image">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
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
	//dataType: "json",
	url:"photosload",
	success: function(response){
	var obj = $.parseJSON(response);
	var size = obj.data.length - 1 ;
		for($i=0;$i<=size;$i++)
		{
		$("#appendHere").append(' <div class="col-lg-3 col-md-4 col-xs-6 thumb"><a class="thumbnail" href="'+ obj.data[$i].images.standard_resolution.url+'"> <img class="img-responsive" src="'+  obj.data[$i].images.standard_resolution.url  +'" alt=""></a></div>');
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


    $(".thumbnail").click(function()
   {
        alert("Thumbnail");
   });



   });



</script>

@endsection










