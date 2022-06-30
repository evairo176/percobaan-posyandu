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
<div class="col-lg-12">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table User</h4>
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btnUser">
                            Add New User
                        </button>
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
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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
                            <option value="petugas">Petugas</option>
                            <option value="super-admin">Super Admin</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="picture">Select Avatar</label>
                        <input type="file" name="picture" id="picture" class="form-control">
                        <div class="invalid-feedback"></div>
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
                    data: 'name',
                    name: 'name'
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
                    data: 'created_at',
                    name: 'created_at'
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
            $('#userModalTitle').html('Add Data User');
            $('#user_btn').html('Save');
            $('#userModal').modal('show');
        });
        // edit user ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'user/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#userModalTitle').html('Edit Data User');
                    $('#user_btn').html('Update');
                    $('#userModal').modal('show');
                    $("#user_id").val(res.id);
                    $("#user_picture").val(res.picture);
                    $("#name").val(res.name);
                    $("#email").val(res.email);
                    $("#role").val(res.role);
                    $("#picture").val(res.picture);
                }
            });
        });
        // edit user ajax request
        $(document).on('click', '.detailIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'user/detail';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    // console.log(res.picture);
                    var img = '<img src="storage/picture/' + res.picture + '" border="0" width="40" class="img-rounded" align="center" />';
                    $('#userDetailModalTitle').html('Detail Data User');
                    $('#userDetailModal').modal('show');
                    $("#dpicture").html(img);
                    $("#dname").text(res.name);
                    $("#demail").text(res.email);
                    $("#dgender").text(res.gender);
                    $("#dphone").text(res.phone);
                    $("#drole").text(res.role);
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

                    } else if (res.status == 200) {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'Success',
                            text: res.messages,
                            footer: '<a href="#">Do you have question?</a>',
                            timer: 1500,
                        })
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
    });
</script>
@endpush