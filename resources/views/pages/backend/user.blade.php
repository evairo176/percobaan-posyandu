@extends('layouts.backend')
@section('title','Table user')
@push('add-styles')
<link href="{{asset('backend')}}/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('backend')}}/assets/css/forms/theme-checkbox-radio.css">
<link href="{{asset('backend')}}/assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('datatable')}}/datatables.min.css" />
<script src="{{asset('backend')}}/plugins/sweetalerts/promise-polyfill.js"></script>
<link href="{{asset('backend')}}/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
<link href="{{asset('backend')}}/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div id="posyandu_alert"></div>
<div class="col-lg-12">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table User</h4>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary mb-2 mr-2" id="btnUser">
                                Add New User
                            </button>
                            <button id="genUsPos" type="button" class="btn btn-success mb-2 mr-2">
                                Generate Pos
                            </button>
                            <button id="genUsKec" type="button" class="btn btn-success mb-2 mr-2">
                                Generate Kec
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-hover text-secondary">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Role</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="btn-group">
                <button id="deletegenUsPos" type="button" class="btn btn-danger mb-2 mr-2">
                    Generate delete User Pos
                </button>
                <button id="deletegenUsKec" type="button" class="btn btn-danger mb-2 mr-2">
                    Generate delete User Kec
                </button>
                <!-- <button id="cetakExcel" type="button" class="btn btn-success mb-2 mr-2">
                    Cetak Excel
                </button> -->
                <form action="/user/cetak" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success mb-2 mr-2">
                        Cetak Excel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- -- user modal start -- -->

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalTitle">Add New User</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="user_form" enctype="multipart/form-data">
                    @csrf
                    <div class="my-2">
                        <label for="name">name</label>
                        <input type="hidden" name="user_id" id="user_id" class="form-control">
                        <input type="hidden" name="user_picture" id="user_picture" class="form-control">
                        <input type="name" name="name" id="name" class="form-control" placeholder="Name">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="E-mail">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="password">password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="cpassword">password</label>
                        <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Password confirm">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="petugas">Petugas posyandu</option>
                            <option value="petugas_kecamatan">Petugas kecamatan</option>
                            <option value="super-admin">Super Admin</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2" id="pilihP">
                        <label for="role">Pilih Posyandu</label>
                        <select name="posyandu_id" id="posyandu_id" class="form-control">
                            <option value="">--pilih posyandu ,kelurahan ,kecamatan--</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="my-2">
                        <label for="picture">Select Avatar</label>
                        <input type="file" name="picture" id="picture" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="inputState">Kecamatan</label>
                        <select id="kecamatan_id" class="form-control" name="kecamatan_id">
                            <option value="" selected>Choose...</option>
                            @foreach($kecamatan as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="inputState">Desa</label>
                        <select id="kelurahan_id" class="form-control" name="kelurahan_id">
                            <option selected disabled>Choose...</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="user_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- user modal end -- -->
<!-- -- user detail modal start -- -->

<div class="modal fade" id="userDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailModalTitle">Add New User</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="user_form" enctype="multipart/form-data">
                    @csrf
                    <table>
                        <thead>
                            <tr>
                                <th>Picture :</th>
                                <td id="dpicture"></td>
                            </tr>
                            <tr>
                                <th>Nama :</th>
                                <td id="dname"></td>
                            </tr>
                            <tr>
                                <th>Email :</th>
                                <td id="demail"></td>
                            </tr>
                            <tr>
                                <th>password :</th>
                                <td id="password_asli"></td>
                            </tr>
                            <tr>
                                <th>Gender :</th>
                                <td id="dgender"></td>
                            </tr>
                            <tr>
                                <th>Phone :</th>
                                <td id="dphone"></td>
                            </tr>
                            <tr>
                                <th>Role :</th>
                                <td id="drole"></td>
                            </tr>
                            <tr>
                                <th>Kecamatan :</th>
                                <td id="kecamatan"></td>
                            </tr>
                            <tr>
                                <th>Kelurahan :</th>
                                <td id="kelurahan"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- user modal end -- -->
@endsection
@push('add-scripts')
<script src="{{asset('backend')}}/assets/js/scrollspyNav.js"></script>
<script>
    checkall('todoAll', 'todochkbox');
    $('[data-toggle="tooltip"]').tooltip()
</script>
<script type="text/javascript" src="{{asset('datatable')}}/datatables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/scrollspyNav.js"></script>
<script src="{{asset('backend')}}/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="{{asset('backend')}}/plugins/sweetalerts/custom-sweetalert.js"></script>
<script>
    $(document).ready(function() {

        getPosyandu();
        // console.log(getPosyandu());
        $('#role').change(function() {
            if (this.value == 'petugas_kecamatan' || this.value == 'super-admin') {
                $('#pilihP').addClass('d-none');
            } else {
                $('#pilihP').removeClass('d-none');
            }
        });

        function getPosyandu() {
            var url = '/get-data/posyandu';
            $.ajax({
                url: url,
                method: 'get',
                success: function(res) {
                    $("#posyandu_id").empty();
                    $("#posyandu_id").append('<option selected disabled>pilih...</option>');
                    $.each(res, function(index, item) {
                        $("#posyandu_id").append('<option value="' + item.id_posyandu + '">' + item.nama_posyandu + " " + item.kelurahan + " " + item.kecamatan + '</option>');
                    });
                    console.log('1');
                }
            });
        }
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{route('user.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'picture',
                    name: 'picture'
                },
                {
                    data: 'name_user',
                    name: 'name_user'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'kecamatan',
                    name: 'kecamatan'
                },
                {
                    data: 'kelurahan',
                    name: 'kelurahan'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $('#btnUser').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#user_form')[0].reset();
            $('#user_id').val('');
            $('#userModalTitle').html('Add Data User');
            $('#pilihP').removeClass('d-none');
            $('#user_btn').html('Save');
            $('#userModal').modal('show');
        });
        // edit user ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = '/user/edit';
            $('#pilihP').addClass('d-none');
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.posyandu_id);
                    $('#userModalTitle').html('Edit Data User');
                    $('#user_btn').html('Update');
                    $('#userModal').modal('show');
                    $("#user_id").val(res.id);
                    $("#posyandu_id").val(res.posyandu_id);
                    $("#user_picture").val(res.picture);
                    $("#name").val(res.name);
                    $("#email").val(res.email);
                    $("#role").val(res.role);
                    $("#picture").val(res.picture);
                    $("#kelurahan_id").val(res.kelurahan_id);
                    $("#kecamatan_id").val(res.kecamatan_id);
                }
            });
        });
        // edit user ajax request
        $(document).on('click', '.detailIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'user/detail';
            $("#dpicture").html('');
            $("#dname").text('');
            $("#demail").text('');
            $("#dgender").text('');
            $("#dphone").text('');
            $("#drole").text('');
            $("#password_asli").text('');
            $("#kecamatan").text('');
            $("#kelurahan").text('');
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    // console.log(res.picture);
                    var linkimage = (res.picture) ? 'storage/picture/' + res.picture + '' : 'boy.png';
                    var img = `<img src="` + linkimage + `" border="0" width="40" class="img-rounded" align="center" />`;
                    $('#userDetailModalTitle').html('Detail Data User');
                    $('#userDetailModal').modal('show');
                    $("#dpicture").html(img);
                    $("#dname").text(res.name_user);
                    $("#demail").text(res.email);
                    $("#dgender").text(res.gender);
                    $("#dphone").text(res.phone);
                    $("#drole").text(res.role);
                    $("#kelurahan").text(res.kelurahan);
                    $("#kecamatan").text(res.kecamatan);
                    if (res.role != 'super-admin') {
                        $("#password_asli").text(res.password_asli);
                    }
                }
            });
        });

        $('#user_form').submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $('#user_btn').text('adding...');
            $.ajax({
                url: '/user/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 400) {
                        // alert(res.messages.name);
                        $('#user_btn').text('save');
                        showError('name', res.messages.name);
                        showError('email', res.messages.email);
                        showError('password', res.messages.password);
                        showError('cpassword', res.messages.cpassword);
                        showError('role', res.messages.role);
                        showError('picture', res.messages.picture);
                        showError('posyandu_id', res.messages.posyandu_id);
                    } else if (res.status == 200) {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'Success',
                            text: res.messages,
                            footer: '<a href="#">Do you have question?</a>',
                            timer: 1500,
                        })
                        getPosyandu();
                        $('#userModal').modal('hide');
                        $('#user_form')[0].reset();
                        removeValidationClasses('#user_form')
                        $('#user_btn').text('save');
                        $('.table').DataTable().ajax.reload();
                    }
                }
            })
        });

        // delete employee ajax request
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            var url = '{{url("user/delete")}}';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true,
                padding: '2em'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                Swal.fire({
                                    position: 'bottom-end',
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.messages,
                                    footer: '<a href="#">Do you have question?</a>',
                                    timer: 1500,
                                })
                                $('.table').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        });
        $(document).on('click', '#cetakExcel', function(e) {
            e.preventDefault();
            let csrf = '{{ csrf_token() }}';
            var url = '{{url("user/cetak")}}';
            Swal.fire({
                title: 'Apakah Anda Yakin ?',
                text: "Anda akan membuat akun user petugas posyandu secara otomatis!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, buat sekarang!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: true,
                padding: '2em'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            _token: csrf
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                Swal.fire({
                                    position: 'bottom-end',
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.messages,
                                    footer: '<a href="#">Do you have question?</a>',
                                    timer: 1500,
                                })
                                $('.table').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        });
        $(document).on('click', '#genUsPos', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            var url = '{{url("user/generate")}}';
            Swal.fire({
                title: 'Apakah Anda Yakin ?',
                text: "Anda akan membuat akun user petugas posyandu secara otomatis!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, buat sekarang!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: true,
                padding: '2em'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            _token: csrf
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                Swal.fire({
                                    position: 'bottom-end',
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.messages,
                                    footer: '<a href="#">Do you have question?</a>',
                                    timer: 1500,
                                })
                                $('.table').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        });
        $(document).on('click', '#genUsKec', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            var url = '{{url("kecamatan/generate")}}';
            Swal.fire({
                title: 'Apakah Anda Yakin ?',
                text: "Anda akan membuat akun user petugas kecamatan secara otomatis!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, buat sekarang!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: true,
                padding: '2em'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            _token: csrf
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                Swal.fire({
                                    position: 'bottom-end',
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.messages,
                                    footer: '<a href="#">Do you have question?</a>',
                                    timer: 1500,
                                })
                                $('.table').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '#deletegenUsPos', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            var url = '{{url("user/generate/delete")}}';
            Swal.fire({
                title: 'Apakah Anda Yakin ?',
                text: "Anda akan menghapus semua akun user petugas posyandu secara otomatis!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus sekarang!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: true,
                padding: '2em'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            _token: csrf
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                Swal.fire({
                                    position: 'bottom-end',
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.messages,
                                    footer: '<a href="#">Do you have question?</a>',
                                    timer: 1500,
                                })
                                $('.table').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '#deletegenUsKec', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            var url = '{{url("kecamatan/generate/delete")}}';
            Swal.fire({
                title: 'Apakah Anda Yakin ?',
                text: "Anda akan menghapus semua akun user petugas kecamatan secara otomatis!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus sekarang!',
                cancelButtonText: 'Tidak, Batalkan!',
                reverseButtons: true,
                padding: '2em'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: {
                            _token: csrf
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                Swal.fire({
                                    position: 'bottom-end',
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.messages,
                                    footer: '<a href="#">Do you have question?</a>',
                                    timer: 1500,
                                })
                                $('.table').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        });

        $('#kecamatan_id').change(function() {
            var kecID = $(this).val();
            if (kecID) {
                $.ajax({
                    type: "GET",
                    url: "/posyandu/getdesa?kecID=" + kecID,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            $("#kelurahan_id").empty();
                            $("#kelurahan_id").append('<option selected disabled>pilih...</option>');
                            $.each(res, function(nama, kode) {
                                $("#kelurahan_id").append('<option value="' + kode + '">' + nama + '</option>');
                            });
                        } else {
                            $("#kelurahan_id").empty();
                        }
                    }
                });
            } else {
                $("#kelurahan_id").empty();
            }
        });
    });
</script>
@endpush