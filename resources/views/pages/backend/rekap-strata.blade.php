@extends('layouts.backend')
@section('title','strata')
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
    ul.ul-strata {
        padding: 0;
        list-style: none;
    }

    ul.ul-strata-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="strata_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table strata</h4>
                        @if(!auth()->user()->status_strata)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btnstrata">
                            Add New strata
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
                            <th>pra</th>
                            <th>mad</th>
                            <th>pur</th>
                            <th>man</th>
                            <th>jumlah bangunan</th>
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


<!-- -- strata modal start -- -->

<div class="modal fade" id="strataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="strataModalTitle">Add New strata</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="strata_form">
                    @csrf
                    <div class="my-2">
                        <label for="name_strata">pra</label>
                        <input type="hidden" name="strata_id" id="strata_id" class="form-control">
                        <input type="text" name="pra" id="pra" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_strata">mad</label>
                        <input type="text" name="mad" id="mad" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_strata">pur</label>
                        <input type="text" name="pur" id="pur" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_strata">man</label>
                        <input type="text" name="man" id="man" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_strata">jumlah bangunan</label>
                        <input type="text" name="jml_bgn_s" id="jml_bgn_s" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="strata_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- strata modal end -- -->



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
            ajax: "{{route('strata.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'pra',
                    name: 'pra'
                },
                {
                    data: 'mad',
                    name: 'mad'
                },
                {
                    data: 'pur',
                    name: 'pur'
                },
                {
                    data: 'man',
                    name: 'man'
                },
                {
                    data: 'jml_bgn_s',
                    name: 'jml_bgn_s'
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
        $('#btnstrata').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#strata_form')[0].reset();
            $('#strataModalTitle').html('Add Data strata');
            $('#strata_btn').html('Save');
            $('#strataModal').modal('show');
        });
        // edit strata ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'strata/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#strataModalTitle').html('Edit Data strata');
                    $('#strata_btn').html('Update');
                    $('#strataModal').modal('show');
                    $("#strata_id").val(res.id);
                    $("#pra").val(res.pra);
                    $("#mad").val(res.mad);
                    $("#pur").val(res.pur);
                    $("#man").val(res.man);
                    $("#jml_bgn_s").val(res.jml_bgn_s);
                }
            });
        });
        $('#strata_form').submit(function(e) {
            e.preventDefault();

            let id = $('#strata_id').val();
            const fd = new FormData(this);
            $('#strata_btn').val('Simpan...');
            $('#strata_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/strata/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('pra', res.messages.pra);
                        showError('mad', res.messages.mad);
                        showError('pur', res.messages.pur);
                        showError('man', res.messages.man);
                        showError('jml_bgn_s', res.messages.jml_bgn_s);
                        $('#strata_btn').val('Simpan Data Strata');
                        $('#strata_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#strata_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#strata_form')
                        $('#strata_btn').val('Simpan Data Strata');
                        $('#strata_btn').removeAttr('disabled');
                        $('#strataModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                        $('#btnstrata').addClass('d-none');
                    }
                }
            })
        })

        // edit strata ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'strata/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#strataModalTitle').html('Edit Data strata');
                    $('#strata_btn').html('Update');
                    $('#strataModal').modal('show');
                    $("#strata_id").val(res.id);
                    $("#nama_strata").val(res.nama_strata);
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