@extends('layouts.backend')
@section('title','kegiatan')
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
    ul.ul-kegiatan {
        padding: 0;
        list-style: none;
    }

    ul.ul-kegiatan-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="kegiatan_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table kegiatan</h4>
                        @if(!auth()->user()->status_kegiatan)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btnkegiatan">
                            Add New kegiatan
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
                            <th>vit. a</th>
                            <th>kb-aktif</th>
                            <th>k4</th>
                            <th>fe3</th>
                            <th>campak</th>
                            <th>bcg</th>
                            <th>dpt</th>
                            <th>hbo</th>
                            <th>polio</th>
                            <th>gizi</th>
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


<!-- -- kegiatan modal start -- -->

<div class="modal fade" id="kegiatanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kegiatanModalTitle">Add New kegiatan</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="kegiatan_form">
                    @csrf
                    <div class="my-2">
                        <label for="name_kegiatan">Vitamin A (jumlah)</label>
                        <input type="hidden" name="kegiatan_id" id="kegiatan_id" class="form-control">
                        <input type="text" name="vit_a" id="vit_a" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kegiatan">Peserta Kb aktiv (jumlah)</label>
                        <input type="text" name="kb_aktif" id="kb_aktif" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kegiatan">pemeriksaan ibu hamil K4 (jumlah)</label>
                        <input type="text" name="k4" id="k4" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kegiatan">pemberian tablet Fe (jumlah)</label>
                        <input type="text" name="fe3" id="fe3" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kegiatan">campak (jumlah)</label>
                        <input type="text" name="campak" id="campak" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kegiatan">BCG (jumlah)</label>
                        <input type="text" name="bcg" id="bcg" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kegiatan">DPT (jumlah)</label>
                        <input type="text" name="dpt" id="dpt" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kegiatan">HBO (jumlah)</label>
                        <input type="text" name="hbo" id="hbo" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kegiatan">polio (jumlah)</label>
                        <input type="text" name="polio" id="polio" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kegiatan">gizi (jumlah)</label>
                        <input type="text" name="gizi" id="gizi" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="my-2">
                        <label for="name_kegiatan">diare (jumlah)</label>
                        <input type="text" name="diare" id="diare" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="kegiatan_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- kegiatan modal end -- -->



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
            ajax: "{{route('kegiatan.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'vit_a',
                    name: 'vit_a'
                },
                {
                    data: 'kb_aktif',
                    name: 'kb_aktif'
                },
                {
                    data: 'k4',
                    name: 'k4'
                },
                {
                    data: 'fe3',
                    name: 'fe3'
                },
                {
                    data: 'campak',
                    name: 'campak'
                },
                {
                    data: 'bcg',
                    name: 'bcg'
                },
                {
                    data: 'dpt',
                    name: 'dpt'
                },
                {
                    data: 'hbo',
                    name: 'hbo'
                },
                {
                    data: 'polio',
                    name: 'polio'
                },
                {
                    data: 'gizi',
                    name: 'gizi'
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
        $('#btnkegiatan').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#kegiatan_form')[0].reset();
            $('#kegiatanModalTitle').html('Add Data kegiatan');
            $('#kegiatan_btn').html('Save');
            $('#kegiatanModal').modal('show');
        });
        // edit kegiatan ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'kegiatan/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#kegiatanModalTitle').html('Edit Data kegiatan');
                    $('#kegiatan_btn').html('Update');
                    $('#kegiatanModal').modal('show');
                    $("#kegiatan_id").val(res.id);
                    $("#vit_a").val(res.vit_a);
                    $("#kb_aktif").val(res.kb_aktif);
                    $("#k4").val(res.k4);
                    $("#fe3").val(res.fe3);
                    $("#campak").val(res.campak);
                    $("#bcg").val(res.bcg);
                    $("#dpt").val(res.dpt);
                    $("#hbo").val(res.hbo);
                    $("#polio").val(res.polio);
                    $("#gizi").val(res.gizi);
                    $("#diare").val(res.diare);
                }
            });
        });
        $('#kegiatan_form').submit(function(e) {
            e.preventDefault();

            let id = $('#kegiatan_id').val();
            const fd = new FormData(this);
            $('#kegiatan_btn').val('Simpan...');
            $('#kegiatan_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/kegiatan/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('vit_a', res.messages.vit_a);
                        showError('kb_aktif', res.messages.kb_aktif);
                        showError('k4', res.messages.k4);
                        showError('fe3', res.messages.fe3);
                        showError('campak', res.messages.campak);
                        showError('bcg', res.messages.bcg);
                        showError('dpt', res.messages.dpt);
                        showError('hbo', res.messages.hbo);
                        showError('polio', res.messages.polio);
                        showError('gizi', res.messages.gizi);
                        showError('diare', res.messages.diare);
                        $('#kegiatan_btn').val('Simpan Data Kegiatan');
                        $('#kegiatan_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#kegiatan_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#kegiatan_form')
                        $('#kegiatan_btn').val('Simpan Data Kegiatan');
                        $('#kegiatan_btn').removeAttr('disabled');
                        $('#kegiatanModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                        $('#btnkegiatan').addClass('d-none');
                    }
                }
            })
        })

        // edit kegiatan ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'kegiatan/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#kegiatanModalTitle').html('Edit Data kegiatan');
                    $('#kegiatan_btn').html('Update');
                    $('#kegiatanModal').modal('show');
                    $("#kegiatan_id").val(res.id);
                    $("#nama_kegiatan").val(res.nama_kegiatan);
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