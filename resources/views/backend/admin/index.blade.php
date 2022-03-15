<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>

        * {
            box-sizing: border-box;
        }

        body {
            background-color: #b3e8ca;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            margin-top: 50px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 5px;
        }

        .container {
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25),
            0 10px 10px rgba(0,0,0,0.22);
            position: relative;
            overflow: hidden;
            width: 368px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-container {
            background-color: #1d68a7;
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }
        .sign-in-container {
            background-color: #1d68a7;
            left: 0;
            width: 100%;
            z-index: 2;
        }
    </style>

</head>
<body >
<!-- partial:index.partial.html -->
<div class="container" id="container">

    <div class="form-container sign-in-container">
        <form role="form" action="{{route('admin.postLogin')}}" method="post">
            @csrf
            <h2>Đăng nhập</h2>
            <input name="email" type="email" placeholder="Email" required />
            @if($errors->has('email'))
                <span class="invalid-feedback" role="alert" style="color: red;">{{$errors->first('email')}}</span>
            @endif
            <input name="password" type="password" placeholder="Password" required />
            @if($errors->has('password'))
                <span class="invalid-feedback" role="alert" style="color: red;">{{$errors->first('password')}}</span>
            @endif

            @if(session('msg'))
                <div class="form-group has-feedback"><p style="color: red;">{{session('msg')}}</p> </div>
            @endif
            <div style="width: 100%;    margin-bottom: 20px;">
                <input type="checkbox" name="remember" id="remember" style="width: 10%">
                <label for="remember" class="checkbox">Nhớ mật khẩu</label>

            </div>
{{--            {{ session('msg') }}--}}
            <button style="" type="submit">Đăng nhập</button>
        </form>
    </div>
</div>
<style>

</style>
</body>
</html>

