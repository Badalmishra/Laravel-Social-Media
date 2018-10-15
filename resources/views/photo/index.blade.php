@extends('layouts.app')
  @section('content')
  @if (count($photo)>0)
    <h1>All Posts</h1>
    <ul class="list-group py-3 px-3 baap">
    @foreach ($photo as $pho)
      <li class="list-group-item mb-2 post-box">
        <div class="row postsec">
          @php
            $k="no";
          @endphp
          @foreach ($pho->like as $like)
            @if ($like->user_id=={{Auth::user()->id}})
              @php
                $k="yes";
              @endphp
            @endif

          @endforeach
          {{$k}}
          {{$pho->like->count()}}
      </div>
      </div>
      </li>
    @endforeach

  </ul>
  @else
    <p>No Posts Avaliable</p>
  @endif
  @endsection
