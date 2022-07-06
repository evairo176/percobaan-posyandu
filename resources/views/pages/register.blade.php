<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Register</title>
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
                        <div class="" id="show_success_alert"></div>
                        <h1 class="">Register</h1>
                        <form class="text-left" action="#" method="POST" id="register_form">
                            {{ csrf_field() }}
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">NAME</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Full Name">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">EMAIL</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">Posyandu</label>
                                    <select name="posyandu_id" id="posyandu_id" class="form-control">
                                        <option value="">--pilih posyandu--</option>
                                        @foreach($pos as $po)
                                        <option value="{{$po->id}}">{{$po->nama_posyandu}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div id="password-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input name="password" id="password" type="password" class="form-control" placeholder="Password">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div id="cpassword-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD CONFIRM</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input name="cpassword" id="cpassword" type="password" class="form-control" placeholder="Password Confirm">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <input id="register_btn" type="submit" value="Register" class="btn btn-primary">
                                    </div>
                                </div>
                                <p class="signup-link">sudah punya akun ? <a href="{{ url('/login') }}">klik disini</a></p>
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
    <script src="{{asset('js')}}/function.js"></script>
    <script>
        $(function() {
            $('#register_form').submit(function(e) {
                e.preventDefault();
                $('#register_btn').val('please wait...');
                $('#register_btn').attr('disabled', 'disabled');
                $.ajax({
                    url: '/register',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 400) {
                            // alert(res.messages.name);
                            showError('name', res.messages.name);
                            showError('email', res.messages.email);
                            showError('password', res.messages.password);
                            showError('cpassword', res.messages.cpassword);
                            showError('posyandu_id', res.messages.posyandu_id);
                            $('#register_btn').removeAttr('disabled');
                            $('#register_btn').val('register');
                        } else if (res.status == 200) {
                            $('#show_success_alert').html(showMessage('success', res.messages));
                            $('#register_form')[0].reset();
                            removeValidationClasses('#register_form')
                            $('#register_btn').removeAttr('disabled');
                            $('#register_btn').val('register');
                        }

                    }
                })
            });
        });
    </script>

</body>

</html>