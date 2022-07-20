@extends('layouts.backend')
@section('title','demografi')
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
    ul.ul-demografi {
        padding: 0;
        list-style: none;
    }

    ul.ul-demografi-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="demografi_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table demografi</h4>
                        @if(!auth()->user()->status_demografi)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btndemografi">
                            Add New demografi
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
                            <th>jumlah kepala keluarga</th>
                            <th>jumlah penduduk</th>
                            <th>jumlah penduduk laki laki</th>
                            <th>jumlah penduduk perempuan</th>
                            <th>jumlah ibu hamil</th>
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


<!-- -- demografi modal start -- -->

<div class="modal fade" id="demografiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="demografiModalTitle">Add New demografi</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="demografi_form">
                    @csrf
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_demografi">jumlah kepala keluarga (kk)</label>
                                <input type="hidden" name="demografi_id" id="demografi_id" class="form-control">
                                <input type="text" name="jml_kpl_klg" id="jml_kpl_klg" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_demografi">jumlah penduduk (orang)</label>
                                <input type="text" name="jml_pdd" id="jml_pdd" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_demografi">jumlah penduduk laki-laki (orang)</label>
                                <input type="text" name="jml_pdd_l" id="jml_pdd_l" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_demografi">jumlah penduduk perempuan (orang)</label>
                                <input type="text" name="jml_pdd_p" id="jml_pdd_p" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="name_demografi">jumlah PUS (PUS)</label>
                        <input type="text" name="jml_pus" id="jml_pus" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_demografi"> jumlah WUS (WUS)</label>
                                <input type="text" name="jml_wus" id="jml_wus" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_demografi">jumlah ibu hamil (orang)</label>
                                <input type="text" name="jml_ibu_hml" id="jml_ibu_hml" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_demografi">jumlah bayi (0 s/d 12 bln)</label>
                                <input type="text" name="jml_bayi_d" id="jml_bayi_d" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_demografi">jumlah balita (12 s/d 60 bln)</label>
                                <input type="text" name="jml_balita_d" id="jml_balita_d" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="demografi_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- demografi modal end -- -->



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
            ajax: "{{route('demografi.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'jml_kpl_klg',
                    name: 'jml_kpl_klg'
                },
                {
                    data: 'jml_pdd',
                    name: 'jml_pdd'
                },
                {
                    data: 'jml_pdd_l',
                    name: 'jml_pdd_l'
                },
                {
                    data: 'jml_pdd_p',
                    name: 'jml_pdd_p'
                },
                {
                    data: 'jml_ibu_hml',
                    name: 'jml_ibu_hml'
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
        $('#btndemografi').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#demografi_form')[0].reset();
            $('#demografiModalTitle').html('Add Data demografi');
            $('#demografi_btn').html('Save');
            $('#demografiModal').modal('show');
        });
        // edit demografi ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'demografi/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#demografiModalTitle').html('Edit Data demografi');
                    $('#demografi_btn').html('Update');
                    $('#demografiModal').modal('show');
                    $("#demografi_id").val(res.id);
                    $("#jml_kpl_klg").val(res.jml_kpl_klg);
                    $("#jml_pdd").val(res.jml_pdd);
                    $("#jml_pdd_l").val(res.jml_pdd_l);
                    $("#jml_pdd_p").val(res.jml_pdd_p);
                    $("#jml_pus").val(res.jml_pus);
                    $("#jml_wus").val(res.jml_wus);
                    $("#jml_ibu_hml").val(res.jml_ibu_hml);
                    $("#jml_bayi_d").val(res.jml_bayi_d);
                    $("#jml_balita_d").val(res.jml_balita_d);
                }
            });
        });
        $('#demografi_form').submit(function(e) {
            e.preventDefault();

            let id = $('#demografi_id').val();
            const fd = new FormData(this);
            $('#demografi_btn').val('Simpan...');
            $('#demografi_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/demografi/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('jml_kpl_klg', res.messages.jml_kpl_klg);
                        showError('jml_pdd', res.messages.jml_pdd);
                        showError('jml_pdd_l', res.messages.jml_pdd_l);
                        showError('jml_pdd_p', res.messages.jml_pdd_p);
                        showError('jml_pus', res.messages.jml_pus);
                        showError('jml_wus', res.messages.jml_wus);
                        showError('jml_ibu_hml', res.messages.jml_ibu_hml);
                        showError('jml_bayi_d', res.messages.jml_bayi_d);
                        showError('jml_balita_d', res.messages.jml_balita_d);
                        $('#demografi_btn').val('Simpan Data Demografi');
                        $('#demografi_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#demografi_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#demografi_form')
                        $('#demografi_btn').val('Simpan Data Demografi');
                        $('#demografi_btn').removeAttr('disabled');
                        $('#demografiModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                        $('#btndemografi').addClass('d-none');
                    }
                }
            })
        })


    });
</script>
@endpush