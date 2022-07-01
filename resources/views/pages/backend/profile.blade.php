@extends('layouts.backend')
@section('title','profil')
@push('add-styles')
<link rel="stylesheet" type="text/css" href="{{asset('backend')}}/plugins/dropify/dropify.min.css">
<link href="{{asset('backend')}}/assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
<style>
    .col-lg-4.col-md-4.col-sm-12.text-center.picture-profile-s {
        border-right: 3px solid #f6f5f7;
    }
</style>
@endpush
@section('content')
<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    <div class="info">
        <h6 class="">General Information</h6>
        <div class="" id="profile_alert"></div>
        <div class="row">
            <div class="col-lg-11 mx-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 text-center picture-profile-s">
                        <img src="storage/picture/{{($userInfo->picture) ? $userInfo->picture : 'profile.png'}}" alt="" id="image_preview" class="img-fluid rounded-circle img-thumbnail" width="200">
                        <div>
                            <label for="picture">Change profile picture</label>
                            <input value="{{$userInfo->picture}}" type="hidden" name="user_picture" id="user_picture" class="form-control rounded-pill">
                            <input type="file" name="picture" id="picture" class="form-control rounded-pill">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <form action="#" method="post" id="profile_form">
                            @csrf
                            <div class="my-2">
                                <label for="name">Full name</label>
                                <input value="{{$userInfo->name}}" type="text" name="name" id="name" class="form-control rounded-0" placeholder="Nama full">
                                <input value="{{$userInfo->id}}" type="hidden" name="user_id" id="user_id" class="form-control rounded-pill">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="my-2">
                                <label for="email">E-mail</label>
                                <input value="{{$userInfo->email}}" type="text" name="email" id="email" class="form-control rounded-0" placeholder="Email">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control rounded-0">
                                        <option value="" selected disabled>--Select--</option>
                                        <option value="Male" {{ ($userInfo->gender == 'Male') ? 'selected' : ''}}>Male</option>
                                        <option value="Female" {{ ($userInfo->gender == 'Female') ? 'selected' : ''}}>Female</option>
                                    </select>
                                </div>
                                <div class="col-lg">
                                    <label for="dob">Date Of Birth</label>
                                    <input value="{{$userInfo->dob}}" type="date" name="dob" id="dob" class="form-control rounded-0">
                                </div>
                            </div>
                            <div class="my-2">
                                <label for="phone">Phone</label>
                                <input value="{{$userInfo->phone}}" type="tel" name="phone" id="phone" class="form-control rounded-0" placeholder="Phone">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="my-3">
                                <input type="submit" id="profile_btn" value="Update Profile" class="btn btn-primary rounded-0 float-right">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('add-scripts')

<script src="{{asset('backend')}}/plugins/dropify/dropify.min.js"></script>
<script src="{{asset('backend')}}/plugins/blockui/jquery.blockUI.min.js"></script>
<!-- <script src="plugins/tagInput/tags-input.js"></script> -->
<script src="{{asset('backend')}}/assets/js/users/account-settings.js"></script>
<script src="{{asset('backend')}}/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="{{asset('backend')}}/plugins/sweetalerts/custom-sweetalert.js"></script>

<script>
    $(function() {
        $('#picture').change(function(e) {
            const file = e.target.files[0];
            let url = window.URL.createObjectURL(file);
            // console.log(url);
            $('#image_preview').attr('src', url);
            $('#picture_navbar').attr('src', url);
            let fd = new FormData();
            fd.append('picture', file);
            fd.append('user_id', $('#user_id').val());
            // fd.append('user_picture', $('#user_picture').val());
            fd.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: '/profile-image',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        showError('picture', res.messages.name);
                    } else if (res.status == 200) {
                        $('#profile_alert').html(showMessage('success', res.messages));
                        $('#picture').val('');
                    }
                }
            })
        });
        $('#profile_form').submit(function(e) {
            e.preventDefault();

            let id = $('#user_id').val();
            const fd = new FormData(this);
            $('#profile_btn').val('Updating...');
            // alert('dwa');
            $.ajax({
                url: '/profile-update',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('name', res.messages.name);
                        showError('email', res.messages.email);
                        showError('gender', res.messages.gender);
                        showError('phone', res.messages.phone);
                        showError('dob', res.messages.dob);
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#profile_alert').html(showMessage('success', res.messages));
                        $('#profile_btn').val('Update');
                    }
                }
            })
        })
    });
</script>
@endpush