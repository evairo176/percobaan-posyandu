@extends('layouts.backend')
@section('title','posyandu')
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
<style>
    ul.ul-posyandu {
        padding: 0;
        list-style: none;
    }

    ul.ul-posyandu-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="posyandu_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table posyandu</h4>
                        @if(!auth()->user()->status_posyandu)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btnposyandu">
                            Add New posyandu
                        </button>
                        @endif

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
                            <th>Posyandu</th>
                            <th>blok</th>
                            <th>rt</th>
                            <th>rw</th>
                            <th>kelurahan</th>
                            <th>Kecamatan</th>
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


<!-- -- posyandu modal start -- -->

<div class="modal fade" id="posyanduModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="posyanduModalTitle">Add New posyandu</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="posyandu_form">
                    @csrf
                    <div class="my-2">
                        <label for="name_posyandu">Nama Posyandu</label>
                        <input type="hidden" name="posyandu_id" id="posyandu_id" class="form-control">
                        <input type="text" name="nama_posyandu" id="nama_posyandu" class="form-control" placeholder="Nama Posyandu">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="Blok">Blok</label>
                        <input type="text" name="blok" id="blok" class="form-control" placeholder="Blok">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="RT">RT</label>
                                <input type="text" name="rt" id="rt" class="form-control" placeholder="RT">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="RW">RW</label>
                                <input type="text" name="rw" id="rw" class="form-control" placeholder="RW">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="my-2">
                        <label for="Kelurahan">Kelurahan</label>
                        <input type="text" name="kelurahan" id="kelurahan" class="form-control" placeholder="Kelurahan">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="Kecamatan">Kecamatan</label>
                        <input type="text" name="kecamatan" id="kecamatan" class="form-control" placeholder="Kecamatan">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="Kabupaten">Kabupaten</label>
                        <input type="text" name="kabupaten" id="kabupaten" class="form-control" placeholder="Kabupaten">
                        <div class="invalid-feedback"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="posyandu_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- posyandu modal end -- -->



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
    $(function() {
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{route('posyandu.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_posyandu',
                    name: 'nama_posyandu'
                },
                {
                    data: 'blok',
                    name: 'blok'
                },
                {
                    data: 'rt',
                    name: 'rt'
                },
                {
                    data: 'rw',
                    name: 'rw'
                },
                {
                    data: 'kelurahan',
                    name: 'kelurahan'
                },
                {
                    data: 'kecamatan',
                    name: 'kecamatan'
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
        $('#btnposyandu').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#posyandu_form')[0].reset();
            $('#posyanduModalTitle').html('Add Data posyandu');
            $('#posyandu_btn').html('Save');
            $('#posyanduModal').modal('show');
        });
        // edit posyandu ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'posyandu/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#posyanduModalTitle').html('Edit Data posyandu');
                    $('#posyandu_btn').html('Update');
                    $('#posyanduModal').modal('show');
                    $("#posyandu_id").val(res.id);
                    $("#posyandu_picture").val(res.picture);
                    $("#name").val(res.name);
                    $("#email").val(res.email);
                    $("#role").val(res.role);
                    $("#picture").val(res.picture);
                }
            });
        });
        $('#posyandu_form').submit(function(e) {
            e.preventDefault();

            let id = $('#posyandu_id').val();
            const fd = new FormData(this);
            $('#posyandu_btn').val('Simpan...');
            $('#posyandu_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/posyandu/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('nama_posyandu', res.messages.nama_posyandu);
                        showError('blok', res.messages.blok);
                        showError('rt', res.messages.rt);
                        showError('rw', res.messages.rw);
                        showError('kelurahan', res.messages.kelurahan);
                        showError('kecamatan', res.messages.kecamatan);
                        showError('kabupaten', res.messages.kabupaten);
                        $('#posyandu_btn').val('Simpan Data Posyandu');
                        $('#posyandu_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#posyandu_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#posyandu_form')
                        $('#posyandu_btn').val('Simpan Data Posyandu');
                        $('#posyandu_btn').removeAttr('disabled');
                        $('#posyanduModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                        $('#btnposyandu').addClass('d-none');

                    }
                }
            })
        })

        // edit posyandu ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'posyandu/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#posyanduModalTitle').html('Edit Data posyandu');
                    $('#posyandu_btn').html('Update');
                    $('#posyanduModal').modal('show');
                    $("#posyandu_id").val(res.id);
                    $("#nama_posyandu").val(res.nama_posyandu);
                    $("#blok").val(res.blok);
                    $("#rt").val(res.rt);
                    $("#rw").val(res.rw);
                    $("#kelurahan").val(res.kelurahan);
                    $("#kecamatan").val(res.kecamatan);
                    $("#kabupaten").val(res.kabupaten);
                }
            });
        });
    });
</script>
@endpush