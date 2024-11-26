<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/login/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/login/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/login/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">
    
    <title>Login</title>
  </head>
  <body>
  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="{{ asset('assets/login/images/undraw_remotely_2j6y.svg')}}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In</h3>
              <p class="mb-4">Please sign in to access your account and manage your tasks seamlessly.</p>
            </div>

            <form action="{{ route('login') }}" method="POST">
              @csrf
              
              <!-- Display All Errors -->
              @if ($errors->any())
                <div class="alert alert-warning">
                  <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            
              <!-- Username Input -->
              <div class="form-group first m-1">
                <label for="login">Login</label>
                <input type="text" name="username" style="font-size: 15px" class="form-control @error('username') is-invalid @enderror" id="login" >
              </div>
            
              <!-- Password Input -->
              <div class="form-group last mb-4 m-1">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
              </div>
            
              <!-- Remember Me Checkbox -->
              <div class="d-flex mb-4 align-items-center">
                <label class="control control--checkbox mb-0">
                  <span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked" />
                  <div class="control__indicator"></div>
                </label>
              </div>
            
              <!-- Submit Button -->
              <input type="submit" value="Log In" class="btn btn-block btn-primary">
            </form>
            
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script src="{{asset('assets/login/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/login/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/login/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/login/js/main.js')}}"></script>
  </body>
</html>