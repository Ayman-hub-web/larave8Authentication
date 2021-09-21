<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top:45px;">
                <div class="col-md-4 offset-md-4">
                    @if(Session::has('error'))
                        <p class="text-danger">{{Session::get('error')}}</p>
                    @endif
                    <h3> Login | Custom Auth </h3>
                    <form action="{{route('auth.makeLogin')}}" method="post">
                        @csrf 
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter your Email">
                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-primary">Sign in</button>
                            <br>
                            <a href="{{route('auth.register')}}">don't have account, sign up</a>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</body>
</html>