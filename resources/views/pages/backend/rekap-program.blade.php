@extends('layouts.backend')
@section('title','program')
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
    ul.ul-program {
        padding: 0;
        list-style: none;
    }

    ul.ul-program-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="program_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table program</h4>
                        @if(!auth()->user()->status_program)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btnprogram">
                            Add New program
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
                            <th>PAUD</th>
                            <th>BKB</th>
                            <th>BKR</th>
                            <th>BKL</th>
                            <th>UP2K</th>
                            <th>angka stunting</th>
                            <th>inklusi</th>
                            <th>Dana Sehat %</th>
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


<!-- -- program modal start -- -->

<div class="modal fade" id="programModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="programModalTitle">Add New program</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="program_form">
                    @csrf
                    <div class="my-2">
                        <label for="name_program">PAUD</label>
                        <input type="hidden" name="program_id" id="program_id" class="form-control">
                        <input type="text" name="paud" id="paud" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_program">bina keluarga balita (BKB)</label>
                        <input type="text" name="bkb" id="bkb" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_program">bina keluarga remaja (BKR)</label>
                        <input type="text" name="bkr" id="bkr" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_program">bina keluarga lansia(BKL)</label>
                        <input type="text" name="bkl" id="bkl" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_program">UP2K</label>
                        <input type="text" name="up2k" id="up2k" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_program">angka stunting</label>
                        <input type="text" name="as" id="as" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_program">inklusi</label>
                        <input type="text" name="in" id="in" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_program">dana sehat %</label>
                        <input type="text" name="ds" id="ds" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="program_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- program modal end -- -->



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
            ajax: "{{route('program.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'paud',
                    name: 'paud'
                },
                {
                    data: 'bkb',
                    name: 'bkb'
                },
                {
                    data: 'bkr',
                    name: 'bkr'
                },
                {
                    data: 'bkl',
                    name: 'bkl'
                },
                {
                    data: 'up2k',
                    name: 'up2k'
                },
                {
                    data: 'as',
                    name: 'as'
                },
                {
                    data: 'in',
                    name: 'in'
                },
                {
                    data: 'ds',
                    name: 'ds'
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
        $('#btnprogram').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#program_form')[0].reset();
            $('#programModalTitle').html('Add Data program');
            $('#program_btn').html('Save');
            $('#programModal').modal('show');
        });
        // edit program ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'program/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#programModalTitle').html('Edit Data program');
                    $('#program_btn').html('Update');
                    $('#programModal').modal('show');
                    $("#program_id").val(res.id);
                    $("#paud").val(res.paud);
                    $("#bkb").val(res.bkb);
                    $("#bkr").val(res.bkr);
                    $("#bkl").val(res.bkl);
                    $("#up2k").val(res.up2k);
                    $("#as").val(res.as);
                    $("#in").val(res.in);
                    $("#ds").val(res.ds);
                }
            });
        });
        $('#program_form').submit(function(e) {
            e.preventDefault();

            let id = $('#program_id').val();
            const fd = new FormData(this);
            $('#program_btn').val('Simpan...');
            $('#program_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/program/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('paud', res.messages.paud);
                        showError('bkb', res.messages.bkb);
                        showError('bkr', res.messages.bkr);
                        showError('bkl', res.messages.bkl);
                        showError('up2k', res.messages.up2k);
                        showError('as', res.messages.as);
                        showError('in', res.messages.in);
                        showError('ds', res.messages.ds);
                        $('#program_btn').val('Simpan Data Program');
                        $('#program_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#program_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#program_form')
                        $('#program_btn').val('Simpan Data Program');
                        $('#program_btn').removeAttr('disabled');
                        $('#programModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                        $('#btnprogram').addClass('d-none');
                    }
                }
            })
        })

        // edit program ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'program/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#programModalTitle').html('Edit Data program');
                    $('#program_btn').html('Update');
                    $('#programModal').modal('show');
                    $("#program_id").val(res.id);
                    $("#nama_program").val(res.nama_program);
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