@extends('layouts.backend')
@section('title','geografi')
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
    ul.ul-geografi {
        padding: 0;
        list-style: none;
    }

    ul.ul-geografi-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="geografi_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table geografi</h4>
                        @if(!auth()->user()->status_geografi)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btngeografi">
                            Add New geografi
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
                            <th>jumlah rt</th>
                            <th>jumlah rw</th>
                            <th>puskesmas</th>
                            <th>kelurahan</th>
                            <th>kecamatan</th>
                            <th>kabupaten</th>
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


<!-- -- geografi modal start -- -->

<div class="modal fade" id="geografiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="geografiModalTitle">Add New geografi</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="geografi_form">
                    @csrf
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">jumlah rt (rt)</label>
                                <input type="hidden" name="geografi_id" id="geografi_id" class="form-control">
                                <input type="text" name="jml_rt" id="jml_rt" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">jumlah rw (rw)</label>
                                <input type="text" name="jml_rw" id="jml_rw" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">jarak terdekat posyandu (satuan = meter)</label>
                                <input type="text" name="jrk_terdekat" id="jrk_terdekat" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">jarak terjauh posyandu (satuan = meter)</label>
                                <input type="text" name="jrk_terjauh" id="jrk_terjauh" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="name_geografi">Polindes (satuan = meter)</label>
                        <input type="text" name="polindes" id="polindes" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">puskesmas pembantu (satuan = kilometer)</label>
                                <input type="text" name="pks_pembantu" id="pks_pembantu" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">puskemasmas (satuan = kilometer)</label>
                                <input type="text" name="pks" id="pks" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">praktek dokter (satuan = kilometer)</label>
                                <input type="text" name="pkt_dokter" id="pkt_dokter" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">klinik (satuan = kilometer)</label>
                                <input type="text" name="klinik" id="klinik" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">rumah sakit (satuan = kilometer)</label>
                                <input type="text" name="rumah_sakit" id="rumah_sakit" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">kelurahan (satuan = kilometer)</label>
                                <input type="text" name="kelurahan_g" id="kelurahan_g" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">kecamatan (satuan = kilometer)</label>
                                <input type="text" name="kecamatan_g" id="kecamatan_g" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_geografi">kabupaten (satuan = kilometer)</label>
                                <input type="text" name="kabupaten_g" id="kabupaten_g" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="geografi_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- geografi modal end -- -->



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
            ajax: "{{route('geografi.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'jml_rt',
                    name: 'jml_rt'
                },
                {
                    data: 'jml_rw',
                    name: 'jml_rw'
                },
                {
                    data: 'pks',
                    name: 'pks'
                },
                {
                    data: 'kelurahan_g',
                    name: 'kelurahan_g'
                },
                {
                    data: 'kecamatan_g',
                    name: 'kecamatan_g'
                },
                {
                    data: 'kabupaten_g',
                    name: 'kabupaten_g'
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
        $('#btngeografi').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#geografi_form')[0].reset();
            $('#geografiModalTitle').html('Add Data geografi');
            $('#geografi_btn').html('Save');
            $('#geografiModal').modal('show');
        });
        // edit geografi ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'geografi/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#geografiModalTitle').html('Edit Data geografi');
                    $('#geografi_btn').html('Update');
                    $('#geografiModal').modal('show');
                    $("#geografi_id").val(res.id);
                    $("#jml_rt").val(res.jml_rt);
                    $("#jml_rw").val(res.jml_rw);
                    $("#jrk_terdekat").val(res.jrk_terdekat);
                    $("#jrk_terjauh").val(res.jrk_terjauh);
                    $("#polindes").val(res.polindes);
                    $("#pks_pembantu").val(res.pks_pembantu);
                    $("#pks").val(res.pks);
                    $("#pkt_dokter").val(res.pkt_dokter);
                    $("#klinik").val(res.klinik);
                    $("#rumah_sakit").val(res.rumah_sakit);
                    $("#kelurahan_g").val(res.kelurahan_g);
                    $("#kecamatan_g").val(res.kecamatan_g);
                    $("#kabupaten_g").val(res.kabupaten_g);
                }
            });
        });
        $('#geografi_form').submit(function(e) {
            e.preventDefault();

            let id = $('#geografi_id').val();
            const fd = new FormData(this);
            $('#geografi_btn').val('Simpan...');
            $('#geografi_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/geografi/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('jml_rt', res.messages.jml_rt);
                        showError('jml_rw', res.messages.jml_rw);
                        showError('jrk_terdekat', res.messages.jrk_terdekat);
                        showError('jrk_terjauh', res.messages.jrk_terjauh);
                        showError('polindes', res.messages.polindes);
                        showError('pks_pembantu', res.messages.pks_pembantu);
                        showError('pks', res.messages.pks);
                        showError('pkt_dokter', res.messages.pkt_dokter);
                        showError('klinik', res.messages.klinik);
                        showError('rumah_sakit', res.messages.rumah_sakit);
                        showError('kelurahan_g', res.messages.kelurahan_g);
                        showError('kecamatan_g', res.messages.kecamatan_g);
                        showError('kabupaten_g', res.messages.kabupaten_g);
                        $('#geografi_btn').val('Simpan Data Geografi');
                        $('#geografi_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#geografi_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#geografi_form')
                        $('#geografi_btn').val('Simpan Data Geografi');
                        $('#geografi_btn').removeAttr('disabled');
                        $('#geografiModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                        $('#btngeografi').addClass('d-none');
                    }
                }
            })
        })

        // edit geografi ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'geografi/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#geografiModalTitle').html('Edit Data geografi');
                    $('#geografi_btn').html('Update');
                    $('#geografiModal').modal('show');
                    $("#geografi_id").val(res.id);
                    $("#nama_geografi").val(res.nama_geografi);
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