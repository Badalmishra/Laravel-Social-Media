@extends('out.index')

@section('content')
  <style media="screen">
    .dele{
      position: absolute;
    }
  </style>
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

<link rel="stylesheet" href="/css/home.css">
<div class="jumbotron me " id="me">

<div class="row main py-4" style="min-height:250px;">
  <div class="col-md-3 imagediv">
    @if (session('picsuc'))
      <div class="alert alert-success">
        {{session('picsuc')}}
      </div>
    @endif
    @if (Auth::user()->pic==null)
      <div class="" style="margin-top:10% padding:2%;box-shadow: inset 15px 15px 15px grey;">
        <h3>Please set a profile pic</h3>
      {!! Form::open(['action' => 'profile@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
      <div class="form-group">
        {{Form::file('cover_image')}}
      </div>
        </div>
      {{Form::submit('Submit',['class'=>'btn btn-dark '])}}
      {!! Form::close() !!}
      @else

        {!!Form::open(['action'=>['profile@destroy',Auth::user()->id],'method'=>'POST','class'=>'dele'])!!}
        {{Form::hidden('_method','DELETE')}}
        <button type="submit" name="button" class="btn btn-outline-info ml-auto"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
        {!!Form::close()!!}
        <style media="screen">
          .imagediv{
            background-image: url('storage/user/{{Auth::user()->pic}}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
          }
        </style>
    @endif

  </div>
  <div class="col-md-6 " style="color:white;background:rgba(0,0,0,0.4)">
    <h1>{{Auth::user()->name}}</h1>

    <p>
      @if (session('biosuc'))
        <div class="alert alert-success">
          {{session('biosuc')}}
        </div>
      @endif
        @if (Auth::user()->bio==null)
      {!! Form::open(['action' => 'profile@bio','method'=>'POST','enctype'=>'multipart/form-data']) !!}


      <div class="form-group">
        {{Form::label('YourBio','YourBio')}}
        {{Form::textarea('YourBio','',['class'=>'form-control','placeholder'=> 'YourBio','rows'=>'6'])}}
      </div>

      {{Form::submit('Submit',['class'=>'btn btn-dark btn-lg'])}}
      {!! Form::close() !!}
      @else


        {{Auth::user()->bio}}




      @endif
    </p>
    <div class="" style="position:absolute;bottom:5px;right:10px;">

    {!!Form::open(['action'=>['profile@delbio',Auth::user()->id],'method'=>'POST','class'=>''])!!}
    {{Form::hidden('_method','DELETE')}}
    <button type="submit" name="button" class="btn btn-outline-primary" ><i class="fa fa-trash" aria-hidden="true"></i> Remove Bio</button>
    {!!Form::close()!!}
  </div>

  </div>
  @if (Auth::user()->usercover==null)
    <div class="col-md-3 my-5" style="margin-top:10% padding:2%;box-shadow: inset 15px 15px 15px grey;">
      <h6 style="margin-top:35%;">No cover image, please set one</h6>
      {!! Form::open(['action' => 'profile@cover','method'=>'POST','enctype'=>'multipart/form-data']) !!}
      <div class="form-group">
        {{Form::file('cover_image')}}
      </div>
      {{Form::submit('Submit',['class'=>'btn btn-dark '])}}
      {!! Form::close() !!}
    </div>
    @else

      <div class="col-md-3" style="">
        <h5 class="text-success" style="position:absolute;right:10px;bottom:40px;"><i>Followed By {{auth()->user()->followers()->count()}}</i></h5>

        {!!Form::open(['action'=>['profile@delcover',Auth::user()->id],'method'=>'POST','class'=>'delecover'])!!}
        {{Form::hidden('_method','DELETE')}}
        <button type="submit" name="button" class="btn  btn-outline-primary " style="position: absolute;bottom:10px;right:0px;"><i class="fa fa-trash" aria-hidden="true"></i> Remove CoverImage</button>
        {!!Form::close()!!}
      </div>
      <style media="screen">
        .me{
          background-image: url('./storage/usercover/{{Auth::user()->usercover}}');
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center;
        }
      </style>
  @endif

</div>

</div>
    <div class="row px-5 " style="margin:0">
        <div class="col-md-3 ">
            <div class="card " style="margin-top:35%;">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('success'))
                      <div class="alert alert-success">
                        {{session('success')}}
                      </div>
                    @endif
                    {!! Form::open(['action' => 'photoscontroller@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                      {{Form::label('title','Title')}}
                      {{Form::text('title','',['class'=>'form-control','placeholder'=> 'Title'])}}

                    </div>

                    <div class="form-group">
                      {{Form::file('cover_image')}}
                    </div>
                    <div class="form-group">
                      {{Form::label('story','Story')}}
                      {{Form::textarea('story','',['class'=>'form-control','placeholder'=> 'Photo Story','rows'=>'4'])}}
                    </div>

                    {{Form::submit('Submit',['class'=>'btn btn-dark btn-lg'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-9 py-5 px-5 myimg"  onscroll="myfunc()"id="mydi" >
          <div class="patanahikese" style="width:70%; margin:auto; padding-top:15%;" >
            <div >

            </div>
          @if (count($photos)>0)
            @foreach ($photos as $photo)
              <div class="card photo"  >
                <div class="card-header">
                  <h5 class="card-title">{{$photo->title}}</h5>
                </div>
                <img class="card-img-top" src="storage/cover_image/{{$photo->path}}" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">{{$photo->caption}}</p>
                  {!!Form::open(['action'=>['photoscontroller@destroy',$photo->id],'method'=>'POST','class'=>'del'])!!}
                  {{Form::hidden('_method','DELETE')}}
                  <a style="display:inline-block;" href="storage/cover_image/{{$photo->path}}" class="btn btn-primary ">View Bigger</a>
                  {{Form::submit('Delete',['class'=>'btn btn-danger ml-auto'])}}
                  {!!Form::close()!!}
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
