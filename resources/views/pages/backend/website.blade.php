@extends('layouts.backend')
@section('title','website')

@push('add-styles')
<link rel="stylesheet" type="text/css" href="{{asset('backend')}}/plugins/dropify/dropify.min.css">
<link href="{{asset('backend')}}/assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
<style>
    .col-lg-4.col-md-4.col-sm-12.text-center.picture-website-s {
        border-right: 3px solid #f6f5f7;
    }
</style>
@endpush
@section('content')
<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    <div class="info">
        <h6 class="">General Information Website</h6>
        <div class="" id="website_alert"></div>
        <div class="row">
            <div class="col-lg-11 mx-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 text-center picture-website-s">
                        <img src="storage/website/{{($websiteInfo->picture) ? $websiteInfo->picture : 'website.webp'}}" alt="" id="image_preview" class="img-fluid img-thumbnail" width="400">
                        <div>
                            <label for="picture">Change website picture</label>
                            <input value="{{$websiteInfo->picture}}" type="hidden" name="website_picture" id="website_picture" class="form-control rounded-pill">
                            <input type="file" name="picture" id="picture" class="form-control rounded-pill">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <form action="#" method="post" id="website_form">
                            @csrf
                            <div class="my-2">
                                <label for="name">Judul</label>
                                <input value="{{$websiteInfo->judul}}" type="text" name="judul" id="judul" class="form-control rounded-0" placeholder="Nama full">
                                <input value="{{$websiteInfo->id}}" type="hidden" name="website_id" id="website_id" class="form-control rounded-pill">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="my-2">
                                <label for="email">Keterangan</label>
                                <input value="{{$websiteInfo->keterangan}}" type="text" name="keterangan" id="keterangan" class="form-control rounded-0" placeholder="Email">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="my-3">
                                <input type="submit" id="website_btn" value="Update Website" class="btn btn-primary rounded-0 float-right">
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
            fd.append('website_id', $('#website_id').val());
            // fd.append('website_picture', $('#website_picture').val());
            fd.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: '/website-image',
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
                        $('#website_alert').html(showMessage('success', res.messages));
                        $('#picture').val('');
                    }
                }
            })
        });
        $('#website_form').submit(function(e) {
            e.preventDefault();

            let id = $('#website_id').val();
            const fd = new FormData(this);
            $('#website_btn').val('Updating...');
            // alert('dwa');
            $.ajax({
                url: '/website-update',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('judul', res.messages.judul);
                        showError('keterangan', res.messages.keterangan);
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#website_alert').html(showMessage('success', res.messages));
                        $('#website_btn').val('Update');
                    }
                }
            })
        })
    });
</script>
@endpush