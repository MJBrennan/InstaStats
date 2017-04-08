@extends('layouts.app')



@section('content')

<center><div><p>Your Information:</p></div></center>

     <div class="container">
        <div class="list-group" id="dataHere">
        <div id="pic" c>

        </div>
        

        </div>
<div>
  <ul class="list-group">
  <a href="{{url('/landing')}}"><li class="list-group-item">Home</li></a>
  <a href="{{url('/followsme')}}"><li class="list-group-item">Your Followers</li></a>
  <a href="{{url('/followsyou')}}"><li class="list-group-item">Follows You</li></a>
  <a href="{{url('/photos')}}"><li class="list-group-item">Recently Uploaded Photos</li></a>
  <a href="{{url('/location')}}"><li class="list-group-item">Photos in Your Current Location</li></a>
  <a href="{{url('/logout')}}"><li class="list-group-item">Logout</li></a>
 </ul>
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
    url:"basicinfo",
    success: function(response){
      var maindata = $.parseJSON(response);
      console.log(maindata);
      //Prifile Picture
      var profile_pic = maindata.data.profile_picture;
      var username = maindata.data.username;
      var name = maindata.data.full_name;
      var bio = maindata.data.bio;
      var website = maindata.data.website;
      var followers = maindata.data.counts.followed_by;
      var follows = maindata.data.counts.follows;
      var media = maindata.data.counts.media;

      console.log(followers);

      $("#pic").append('<img src="'+ profile_pic + '" alt="..." class="img-thumbnail"><br>');
      $("#pic").append('<p><b>username:</b> '+username +'<p>');
       $("#pic").append('<b><p>Name:</b> '+name +'<p>');
       $("#pic").append('<b><p>Bio:</b> '+bio +'<p>');
       $("#pic").append('<b><p>Website:</b> '+website +'<p>');
       $("#pic").append('<b><p>Followers:</b> '+followers +'<p>');
       $("#pic").append('<b><p>Follows:</b> '+follows +'<p>');
        $("#pic").append('<b><p>Media uploaded:</b> '+media +'<p>');
        }
    });
});

</script>

@endsection