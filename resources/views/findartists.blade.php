@extends('out.index')
@section('content')

<div class="px-5 py-5 my-5 text-center">
    <h3 class="">Search artists here</h3>
  <form class="my-2" action="../find/search" method="post">
  <div class="input-group w-50 mx-auto my-4">
    <input type="text" class="form-control" name="search" placeholder="  eg: Badal Mishra" aria-label="Recipient's username" aria-describedby="basic-addon2">
    <div class="input-group-append">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" class=" btn btn-primary" id="basic-addon2" value="Searh"/>
    </div>
  </div>
</form>

@foreach ($user as $usr)
  @if ($usr->id!=Auth::user()->id)
    @php
    $display=false;
    @endphp
        @foreach ($usr->followers as $follower)
            @if ($follower->followers==Auth::user()->id)
              @php
                $display=true;
              @endphp
            @endif
        @endforeach
        @if ($display==false)
          <div class="card mx-1" style="width: 18rem;display:inline-block;">
            <div class="card-header">
              {{$usr->name}}
            </div>
            <img class="card-img-top" style="max-height:150px"src="/storage/user/{{$usr->pic}}" alt="Card image cap">
            <div class="card-body">
              <p class="card-text">{{$usr->bio}}</p>
            </div>
            <div class="card-footer" style="">
              <a class="btn btn-outline-primary w-100" href="/artists/{{$usr->id}}"> See Profile</a>
              <small class="ml-auto" style="color:green;margin-left:50px;">  Followed by {{$usr->followers()->count()}}</small>
            </div>
          </div>

        @endif
      @endif
@endforeach
</div>
@endsection
