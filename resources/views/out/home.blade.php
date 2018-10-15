@extends('out.index')
@section('content')
  <link rel="stylesheet" href="css/custom.css">
  <div id="carouselExampleSlidesOnly" class="carousel slide myslide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="tests/1.jpg" alt="First slide">

      </div>

      <div class="carousel-item">
        <img class="d-block w-100" src="tests/2.jpg" alt="Second slide">

      </div>

      <div class="carousel-item">
        <img class="d-block w-100" src="tests/4.jpg" alt="Third slide">

      </div>
        <span class="slidetext">We Are <span class="name">SomePhotography</span>
        <small class="tag">We click your memories</small></span>
    </div>
  </div>

<script type="text/javascript">
function getMessage(id,elm){

var design1 = 'btn-info';
var design='btn-outline-primary';
 $.ajax({
    type:'GET',
    url:'/api/likesof/'+id+"?api_token={{Auth::user()->api_token}}",
    success:function(data){
      //alert(Object.keys(data.msg).length);

      if (data.me) {
        $(elm).text('Liked');
         $(elm).removeClass(design);
       $(elm).addClass(design1);
      }
      else {
        $(elm).text('Like');
        $(elm).removeClass(design1);
      $(elm).addClass(design);
      }
      $(elm).parent().find('#count').text(data.msg.length+' Likes ♡');
    }
 });
}
</script>
<div id="#msg">

</div>
<div class="jumbotron text-center">
  <h1 class="text">Recent Posts</h1>
  @php
    $photocount=0;
  @endphp
@if(count($photo)>0)
      @php


      @endphp
@foreach ($photo as $pic)
  @php
    $check=false;

  @endphp
  @foreach ($pic->user->followers as $key)
        @if ($key->followers==Auth::user()->id)
        @php
          $check=true;

        @endphp
        @endif
  @endforeach
  @if ($check)
    @php
      $photocount=1;
    @endphp

  <div class="card photo md-my-4 my-4" >



    <div class="" style="max-height:430px;overflow:hidden;">
      <img class="card-img-top" src="storage/cover_image/{{$pic->path}}" alt="Card image cap" >
    </div>
    <div class="card-body">
      <h5 style="width:100%;"class="card-title"><span class="">{{$pic->title}}</span> <small class="lead float-right"> <a href="artists/{{$pic->user->id}}"> @_{{$pic->user->name}} </a></small> </h5>
      <p class="card-text">{{$pic->caption}}</p>
      @php
        $k=false;
        $url="like/add".$pic->id;
      @endphp
      @foreach ($pic->like as $like)
        @if ($like->user_id==Auth::user()->id)
          @php
            $k=true;
            $url="like/del/".$like->id;
          @endphp
        @endif

      @endforeach

      <small id="count" class="lead my-5">  {{$pic->like->count()}} Likes ♡</small> <br>
      <a href="storage/cover_image/{{$pic->path}}" class="btn btn-outline-success">View Bigger</a>
      <button id="likebut" onclick="getMessage({{$pic->id}},this)" class="btn btn-{{$k?'info':'outline-primary'}}">{{$k?'Liked':'Like'}}</button>
    </div>
   </div>

   @endif
@endforeach

@endif
@if ($photocount==0)

  <h1>You are not following anyone right now <br>Follow someone to see their pic </h1>
@endif

  </div>
@endsection
