@extends('layouts.backend')
@section('title','pembentukan')
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
    ul.ul-pembentukan {
        padding: 0;
        list-style: none;
    }

    ul.ul-pembentukan-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="pembentukan_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table pembentukan</h4>
                        @if(!auth()->user()->status_pembentukan)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btnpembentukan">
                            Add New pembentukan
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
                            <th>keputusan lurah</th>
                            <th>nomor</th>
                            <th>tanggal</th>
                            <th>tentang</th>
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


<!-- -- pembentukan modal start -- -->

<div class="modal fade" id="pembentukanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pembentukanModalTitle">Add New pembentukan</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="pembentukan_form">
                    @csrf
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_pembentukan">tanggal musyawarah</label>
                                <input type="hidden" name="pembentukan_id" id="pembentukan_id" class="form-control">
                                <input type="date" name="tgl_musyawarah" id="tgl_musyawarah" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_pembentukan">peserta (orang)</label>
                                <input type="text" name="psr_musyawarah" id="psr_musyawarah" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="name_pembentukan">materi musyawarah</label>
                        <input type="text" name="mtr_musyawarah" id="mtr_musyawarah" id="mtr_musyawarah" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_pembentukan">kesepakatan</label>
                        <textarea name="ksp_musyawarah" id="ksp_musyawarah" class="form-control" id="" cols="10" rows="4"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_pembentukan">keputusan lurah</label>
                        <input type="text" name="lurah" id="lurah" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_pembentukan">nomor</label>
                        <input type="text" name="nomor" id="nomor" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_pembentukan">tanggal</label>
                        <input type="date" name="tgl" id="tgl" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_pembentukan">tentang</label>
                        <input type="text" name="tentang" id="tentang" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="pembentukan_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- pembentukan modal end -- -->



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
            ajax: "{{route('pembentukan.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'lurah',
                    name: 'lurah'
                },
                {
                    data: 'nomor',
                    name: 'nomor'
                },
                {
                    data: 'tgl',
                    name: 'tgl'
                },
                {
                    data: 'tentang',
                    name: 'tentang'
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
        $('#btnpembentukan').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#pembentukan_form')[0].reset();
            $('#pembentukanModalTitle').html('Add Data pembentukan');
            $('#pembentukan_btn').html('Save');
            $('#pembentukanModal').modal('show');
        });
        // edit pembentukan ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'pembentukan/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#pembentukanModalTitle').html('Edit Data pembentukan');
                    $('#pembentukan_btn').html('Update');
                    $('#pembentukanModal').modal('show');
                    $("#pembentukan_id").val(res.id);
                    $("#tgl_musyawarah").val(res.tgl_musyawarah);
                    $("#psr_musyawarah").val(res.psr_musyawarah);
                    $("#mtr_musyawarah").val(res.mtr_musyawarah);
                    $("#ksp_musyawarah").val(res.ksp_musyawarah);
                    $("#lurah").val(res.lurah);
                    $("#nomor").val(res.nomor);
                    $("#tgl").val(res.tgl);
                    $("#tentang").val(res.tentang);
                }
            });
        });
        $('#pembentukan_form').submit(function(e) {
            e.preventDefault();

            let id = $('#pembentukan_id').val();
            const fd = new FormData(this);
            $('#pembentukan_btn').val('Simpan...');
            $('#pembentukan_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/pembentukan/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('tgl_musyawarah', res.messages.tgl_musyawarah);
                        showError('psr_musyawarah', res.messages.psr_musyawarah);
                        showError('mtr_musyawarah', res.messages.mtr_musyawarah);
                        showError('ksp_musyawarah', res.messages.ksp_musyawarah);
                        showError('lurah', res.messages.lurah);
                        showError('nomor', res.messages.nomor);
                        showError('tgl', res.messages.tgl);
                        showError('tentang', res.messages.tentang);
                        $('#pembentukan_btn').val('Simpan Data Pembentukan');
                        $('#pembentukan_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#pembentukan_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#pembentukan_form')
                        $('#pembentukan_btn').val('Simpan Data Pembentukan');
                        $('#pembentukan_btn').removeAttr('disabled');
                        $('#pembentukanModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                        $('#btnpembentukan').addClass('d-none');
                    }
                }
            })
        })

    });
</script>
@endpush