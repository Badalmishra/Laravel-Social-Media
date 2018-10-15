@extends('out.index')

@section('content')
<link rel="stylesheet" href="/css/out.css">
    <div class="row   test ">
      <div class="col-md-8  left">
        <h1 class="">Welcome to <span class="name">SomePhotography</span></h1>
        <hr>
        <div id="carouselExampleSlidesOnly" class="  carousel slide myslide" data-ride="carousel">
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

          </div>
        </div>
        <h1 class="dai"><small>Show us what you got</small></h1>
      </div>
        <div class="col-md-4  right py-5 ">
          <h1>Join us here</h1>
          <hr>
            <div class="card  formout">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-info btn-sm">
                                    {{ __('Login') }}
                                </button>
                                <a href="{{url('/redirect')}}" class="btn btn-danger btn-sm my-2">Login with Google</a>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>

@endsection
