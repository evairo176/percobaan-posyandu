<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Forgot Password</title>
    <link rel="icon" type="image/x-icon" href="{{asset('backend')}}/assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{asset('backend')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend')}}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend')}}/assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/assets/css/forms/switches.css">
</head>

<body class="form">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Forgot Password</h1>
                        <p>Enter your email address and we will send you a link to reset your password</p>
                        <form class="text-left" action="#" method="POST" id="forgot_form">
                            {{ csrf_field() }}
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">EMAIL</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <input id="forgot_btn" type="submit" value="Reset Password" class="btn btn-primary">
                                    </div>
                                </div>
                                <p class="signup-link">kembali ke <a href="{{ url('/login') }}">login</a></p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('backend')}}/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{asset('backend')}}/bootstrap/js/popper.min.js"></script>
    <script src="{{asset('backend')}}/bootstrap/js/bootstrap.min.js"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('backend')}}/assets/js/authentication/form-2.js"></script>

</body>

</html>