@extends('layouts.backend')
@section('title','perkembangan')
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
    ul.ul-perkembangan {
        padding: 0;
        list-style: none;
    }

    ul.ul-perkembangan-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }
</style>
@endpush
@section('content')

<div class="col-lg-12">
    <div id="perkembangan_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table perkembangan</h4>
                        @if(!auth()->user()->status_perkembangan)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btnperkembangan">
                            Add New perkembangan
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
                            <th>kecamatan</th>
                            <th>pra</th>
                            <th>mad</th>
                            <th>pur</th>
                            <th>man</th>
                            <th>jml_bgn</th>
                            <th>jml_kader</th>
                            <th>tahun rekap</th>
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


<!-- -- perkembangan modal start -- -->

<div class="modal fade" id="perkembanganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="perkembanganModalTitle">Add New perkembangan</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="perkembangan_form">
                    @csrf
                    <div class="my-2">
                        <label for="name_kader">tahun rekap</label>
                        <select name="tahun_rekap" id="tahun_rekap" class="form-control">
                            <option value="">--pilih tahun--</option>
                            <?php for ($i = date('Y'); $i >= date('Y') - 70; $i -= 1) { ?>
                                <option value="{{$i}}">{{$i}}</option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_strata">pra</label>
                                <input type="hidden" name="perkembangan_id" id="perkembangan_id" class="form-control">
                                <input type="hidden" name="kelurahan_id" id="kelurahan_id" value="{{$pos->kelurahan_id}}" class="form-control">
                                <input type="hidden" name="kecamatan_id" id="kelurahan_id" value="{{$pos->kecamatan_id}}" class="form-control">
                                <div class="form-control">
                                    <input type="radio" name="cek" value="pra" id="pra">
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="my-2">
                                <label for="name_strata">mad</label>
                                <div class="form-control">
                                    <input type="radio" name="cek" id="mad" value="mad" checked>
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_strata">pur</label>
                                <div class="form-control">
                                    <input type="radio" name="cek" id="pur" value="pur">
                                </div>

                            </div>
                            <div class="my-2">
                                <label for="name_strata">man</label>
                                <div class="form-control">
                                    <input type="radio" name="cek" id="man" value="man">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="name_perkembangan">jumlah bangunan</label>
                        <input type="text" name="jml_bgn" id="jml_bgn" value="" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">Jumlah kader</label>
                                <input type="text" name="jml_kader" id="jml_kader" value="{{$kaderTotal}}" class="form-control" readonly>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">jumlah kader jml_terlatih</label>
                                <input type="text" name="jml_terlatih" id="jml_terlatih" value="{{$kaderTerlatih}}" class="form-control" readonly>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">bayi dan balita sasaran posyandu / S</label>
                                <input type="text" name="s" id="s" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">balita yang memiliki KMS / K</label>
                                <input type="text" name="k" id="k" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">bayi dan balita datang ditimbang / D</label>
                                <input type="text" name="d" id="d" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">balita dan balita naik timbangan / N</label>
                                <input type="text" name="n" id="n" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">vitamin A</label>
                                <input type="text" name="vit_a" id="vit_a" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">peserta kb aktif</label>
                                <input type="text" name="kb_aktif" id="kb_aktif" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">pemeriksaan ibu hamil k-4</label>
                                <input type="text" name="k4" id="k4" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">pemberian table Fe</label>
                                <input type="text" name="fe3" id="fe3" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">campak</label>
                                <input type="text" name="campak" id="campak" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">BCG</label>
                                <input type="text" name="bcg" id="bcg" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">DPT</label>
                                <input type="text" name="dpt" id="dpt" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">HBO</label>
                                <input type="text" name="hbo" id="hbo" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">Polio</label>
                                <input type="text" name="polio" id="polio" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">gizi</label>
                                <input type="text" name="gizi" id="gizi" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="name_perkembangan">diare</label>
                        <input type="text" name="diare" id="diare" value="" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_strata">paud</label>
                                <div class="form-control">
                                    <input type="checkbox" name="paud" id="paud" value="1">
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_strata">bkb</label>
                                <div class="form-control">
                                    <input type="checkbox" name="bkb" id="bkb" value="1">
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_strata">bkr</label>
                                <div class="form-control">
                                    <input type="checkbox" name="bkr" id="bkr" value="1">
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_strata">bkl</label>
                                <div class="form-control">
                                    <input type="checkbox" name="bkl" id="bkl" value="1">
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_strata">up2k</label>
                                <div class="form-control">
                                    <input type="checkbox" name="up2k" id="up2k" value="1">
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">Angka Stunting</label>
                                <input type="text" name="as" id="as" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_strata">in</label>
                                <div class="form-control">
                                    <input type="checkbox" name="in" id="in" value="1">
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_perkembangan">Dana Sehat</label>
                                <input type="text" name="ds" id="ds" value="" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <button type="submit" id="perkembangan_btn" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- -- perkembangan modal end -- -->



@endsection

@push('add-scripts')
<script src="{{asset('backend')}}/assets/js/scrollspyNav.js"></script>
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
            ajax: "{{route('perkembangan.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'kec',
                    name: 'kec'
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
                    data: 'jml_bgn',
                    name: 'jml_bgn'
                },
                {
                    data: 'jml_kader',
                    name: 'jml_kader'
                },
                {
                    data: 'tahun_rekap',
                    name: 'tahun_rekap'
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
        $('#btnperkembangan').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#perkembangan_form')[0].reset();
            $('#perkembanganModalTitle').html('Add Data perkembangan');
            $('#perkembangan_btn').html('Save');
            $('#perkembanganModal').modal('show');
        });
        // edit perkembangan ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'perkembangan/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#perkembanganModalTitle').html('Edit Data perkembangan');
                    $('#perkembangan_btn').html('Update');
                    $('#perkembanganModal').modal('show');
                    $("#perkembangan_id").val(res.id);
                    $("#kelurahan_id").val(res.kelurahan_id);
                    $("#kecamatan_Id").val(res.kecamatan_Id);
                    $("#tahun_rekap").val(res.tahun_rekap);
                    $("#jml_bgn").val(res.jml_bgn);
                    // $("#jml_kader").val(res.jml_kader);
                    // $("#jml_terlatih").val(res.jml_terlatih);
                    $("#s").val(res.s);
                    $("#k").val(res.k);
                    $("#d").val(res.d);
                    $("#n").val(res.n);
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
                    // $("#paud").val(res.paud);
                    // $("#bkb").val(res.bkb);
                    // $("#bkr").val(res.bkr);
                    // $("#bkl").val(res.bkl);
                    // $("#up2k").val(res.up2k);
                    $("#as").val(res.as);
                    // $("#in").val(res.in);
                    $("#ds").val(res.ds);
                    if (res.pra != 0) {
                        //man
                        $("#pra").prop('checked', true);

                    } else if (res.mad != 0) {
                        $("#mad").prop('checked', true);
                    } else if (res.pur != 0) {
                        $("#pur").prop('checked', true);
                    } else {
                        $("#man").prop('checked', true);
                    }
                    // alert(res.bkb);
                    if (res.paud != 0) {
                        $("#paud").prop('checked', true);
                    }
                    if (res.bkb != 0) {
                        $("#bkb").prop('checked', true);
                    }
                    if (res.bkr != 0) {
                        $("#bkr").prop('checked', true);
                    }
                    if (res.bkl != 0) {
                        $("#bkl").prop('checked', true);
                    }
                    if (res.up2k != 0) {
                        $("#up2k").prop('checked', true);
                    }
                    if (res.in != 0) {
                        $("#in").prop('checked', true);
                    }
                    // if(res.up2k != null){
                    //     $("#up2k").prop('checked', true);
                    // }
                }
            });
        });
        $('#perkembangan_form').submit(function(e) {
            e.preventDefault();

            let id = $('#perkembangan_id').val();
            const fd = new FormData(this);
            $('#perkembangan_btn').val('Simpan...');
            $('#perkembangan_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/perkembangan/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('tahun_rekap', res.messages.tahun_rekap);
                        showError('pra', res.messages.pra);
                        showError('mad', res.messages.mad);
                        showError('pur', res.messages.pur);
                        showError('man', res.messages.man);
                        showError('jml_bgn', res.messages.jml_bgn);
                        showError('jml_kader', res.messages.jml_kader);
                        showError('jml_terlatih', res.messages.jml_terlatih);
                        showError('s', res.messages.s);
                        showError('k', res.messages.k);
                        showError('d', res.messages.d);
                        showError('n', res.messages.n);
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
                        showError('paud', res.messages.paud);
                        showError('bkb', res.messages.bkb);
                        showError('bkr', res.messages.bkr);
                        showError('bkl', res.messages.bkl);
                        showError('up2k', res.messages.up2k);
                        showError('as', res.messages.as);
                        showError('in', res.messages.in);
                        showError('ds', res.messages.ds);
                        $('#perkembangan_btn').val('Simpan Data Perkembangan');
                        $('#perkembangan_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#perkembangan_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#perkembangan_form')
                        $('#perkembangan_btn').val('Simpan Data Perkembangan');
                        $('#perkembangan_btn').removeAttr('disabled');
                        $('#perkembanganModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                    }
                }
            })
        })

        // edit perkembangan ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'perkembangan/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res.picture);
                    $('#perkembanganModalTitle').html('Edit Data perkembangan');
                    $('#perkembangan_btn').html('Update');
                    $('#perkembanganModal').modal('show');
                    $("#perkembangan_id").val(res.id);
                    $("#nama_perkembangan").val(res.nama_perkembangan);
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