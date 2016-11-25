<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">

        <title>Airbnb đăng nhập - Hệ thống quản lý cho thuê phòng</title>
        <style>
            body {
                background: url('http://i.imgur.com/Eor57Ae.jpg') no-repeat fixed center center;
                background-size: cover;
                font-family: arial;
            }

            .logo {
                width: 375px;
                height: 36px;
                font-size: 20px;
                /* background: url('http://i.imgur.com/fd8Lcso.png') no-repeat; */
                margin: 30px auto;
                text-transform: uppercase;
                color: #FFF;
                font-weight: bold;
            }

            .logo:before {
                content: "Quản lý cho thuê phòng - Airbnb";
            }

            .login-block {
                width: 320px;
                padding: 20px;
                background: #fff;
                border-radius: 5px;
                border-top: 5px solid #ff656c;
                margin: 0 auto;
            }

            .login-block h1 {
                text-align: center;
                color: #000;
                font-size: 18px;
                text-transform: uppercase;
                margin-top: 0;
                margin-bottom: 20px;
            }

            .login-block input {
                width: 100%;
                height: 42px;
                box-sizing: border-box;
                border-radius: 5px;
                border: 1px solid #ccc;
                margin-top: 15px;
                margin-bottom: 10px;
                font-size: 14px;
                padding: 0 20px 0 50px;
                outline: none;
            }

            .login-block input#email {
                background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
                background-size: 16px 80px;
            }

            .login-block input#email:focus {
                background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
                background-size: 16px 80px;
            }

            .login-block input#password {
                background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
                background-size: 16px 80px;
            }

            .login-block input#password:focus {
                background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
                background-size: 16px 80px;
            }

            .login-block input:active, .login-block input:focus {
                border: 1px solid #ff656c;
            }

            .login-block button {
                width: 100%;
                height: 40px;
                background: #ff656c;
                box-sizing: border-box;
                border-radius: 5px;
                border: 1px solid #e15960;
                color: #fff;
                font-weight: bold;
                text-transform: uppercase;
                font-size: 14px;
                outline: none;
                cursor: pointer;
                margin-top: 10px;
            }

            .login-block button:hover {
                background: #ff7b81;
            }

            .help-block {
                color: red;
                font-size: 14px;
            }

            .login-block .has-error {
                border: 1px solid red;
            }
        </style>
    </head>

    <body>
        <div class="logo"></div>
        <form action="{{ route('post.login') }}" method="POST">
            {{ csrf_field() }}
            <div class="login-block">
                <h1>Logo</h1>
                <div class="member">
                    <img src="" alt="">
                </div>

                @if ($errors->has('error'))
                    <span class="help-block">
                        {{ trans($errors->first('error')) }}
                    </span>
                @endif

                <input type="text" placeholder="Địa chỉ E-mail" name="email" id="email" value="{{ old('email') }}" autocomplete="off" class="{{ $errors->has('email') ? 'has-error' : '' }}" />
                
                @if ($errors->has('email'))
                    <span class="help-block">
                        {{ trans($errors->first('email')) }}
                    </span>
                @endif

                <input type="password" placeholder="Mật khẩu" name="password" id="password" class="{{ $errors->has('password') ? 'has-error' : '' }}"/>

                @if ($errors->has('password'))
                    <span class="help-block">
                        {{ $errors->first('password') }}
                    </span>
                @endif
                <button>Đăng nhập</button>
            </div>
        </form>
    </body>
</html>