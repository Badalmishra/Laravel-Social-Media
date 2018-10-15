@extends('out.index')

@section('content')
  <style media="screen">
    .dele{
      position: absolute;
    }
    .card{
      box-shadow:10px 10px 20px grey;
    }
    .card{
      box-shadow:10px 10px 20px grey;
    }
    .fol{
      position: absolute;
      bottom: 0px;
      right: 100px;
    }
  </style>
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

<link rel="stylesheet" href="/css/home.css">
<div class="jumbotron me  " id="me">
<div class="row  main py-4" style="min-height:250px;">
  <div class="col-md-3 imagediv">
    <style media="screen">

    .imagediv{
      background-image: url('../storage/user/{{$user->pic}}');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
    </style>


  </div>
  <div class="col-md-5" style="color:white;background:rgba(0,0,0,0.4)">
    <h1>{{$user->name}}</h1>
    <p>


        {{$user->bio}}

    </p>
  </div>
  <div class="col-md-4 mt-auto px-3 py-3">
  @if (Auth::user()->id!=$user->id)
    @php
      $k=false;
    @endphp
    @foreach ($user->followers as $follower)
      @if ( $follower->followers==Auth::user()->id )
        @php
          $k=true;
        @endphp
      @endif



    @endforeach
    <script type="text/javascript">
    function getFollow(id,elm){
      var id = {{$user->id}}
      var design = "btn-outline-danger";
      var design1 = "btn-danger";
     $.ajax({
        type:'GET',
        url:'/api/follow/'+id+"?api_token={{Auth::user()->api_token}}",
        success:function(data){
          if (data.res=='Inserted') {
            $('#fol').html('Following :: '+data.count);
            $('#fol').removeClass(design);
            $('#fol').addClass(design1);
          }
          else {
            $('#fol').html('Follow :: '+data.count);
            $('#fol').removeClass(design1);
            $('#fol').addClass(design);
          }
        }
     });
    }
    </script>
    <button id="fol" type="button" onclick="getFollow()" class="btn btn{{$k?'':'-outline'}}-danger ml-md-5 w-75 " name="button" >{{$k?'Following':'Follow'}} ::{{$user->followers()->count()}}</button>
  @endif
    @if ($user->usercover==null)

      @else
        <style media="screen">
          .me{
            background-image: url('../storage/usercover/{{$user->usercover}}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
          }
        </style>
    @endif
  </div>
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
    <div class="row  " style="margin:0">

        <div class="col-md-12  px-5 "  onscroll="myfunc()"id="mydi" >
          <div class="kyube" style="width:50%; margin:auto;" >

          @if (count($user->photo)>0)
            @foreach ($user->photo as $photo)
              <div class="card photo my-4 "  >
                <div class="card-header">
                  <h5 class="card-title">{{$photo->title}}</h5>
                </div>
                <img class="card-img-top" src="../storage/cover_image/{{$photo->path}}" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">{{$photo->caption}}</p>
                  @php
                    $k=false;
                    $url="like/add".$photo->id;
                  @endphp
                  @foreach ($photo->like as $like)
                    @if ($like->user_id==Auth::user()->id)
                      @php
                        $k=true;
                        $url="like/del/".$like->id;
                      @endphp
                    @endif

                  @endforeach

                  <small id="count" class="lead my-5">  {{$photo->like->count()}} Likes ♡</small> <br>
                  <a href="storage/cover_image/{{$photo->path}}" class="btn btn-outline-success">View Bigger</a>
                  <button id="likebut" onclick="getMessage({{$photo->id}},this)" class="btn btn-{{$k?'info':'outline-primary'}}">{{$k?'Liked':'Like'}}</button>
                </div>
              </div>
            @endforeach
          @endif
        </div>
        </div>
<script type="text/javascript">

</script>
</div>
@endsection
