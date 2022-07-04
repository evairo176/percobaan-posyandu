@extends('layouts.backend')
@section('title','sarana')
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
    ul.ul-sarana {
        padding: 0;
        list-style: none;
    }

    ul.ul-sarana-sub {
        list-style: none;
    }

    th.mb-2 {
        width: 50%;
    }

    li {
        list-style: none;
    }

    p.kat-1 {
        font-weight: 800;
    }

    p.kat-2 {
        font-weight: 700;
    }

    p.kat-3 {
        font-weight: 500;
    }

    .ul-1 {
        padding: 0;
        margin-bottom: 30px;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="sarana_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table sarana</h4>
                        @if(!auth()->user()->status_sarana)
                        <button type="button" class="btn btn-primary mb-2 mr-2" id="btnsarana">
                            Add New sarana
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
                            <th>status</th>
                            <th>tahun dibangun</th>
                            <th>keadaan</th>
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


<!-- -- sarana modal start -- -->

<div class="modal fade" id="saranaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saranaModalTitle">Add New sarana</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="sarana_form">
                    @csrf
                    <ul class="ul-1 ">
                        <li>
                            <p class="kat-3">1. Gedung</p>
                            <ul>
                                <li id="kotak">
                                    <div class="my-2">
                                        <label for="name_sarana">status</label>
                                        <input type="hidden" name="sarana_id" id="sarana_id" class="form-control">
                                        <select name="status_g" id="status_g" class="form-control">
                                            <option value="">--pilih status--</option>
                                            <option value="milik sendiri">milik sendiri</option>
                                            <option value="pinjam">pinjam</option>
                                            <option value="lainya">lainya</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">tahun dibangun</label>
                                        <input type="text" name="th_bgn_g" id="th_bgn_g" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">keadaan</label>
                                        <select name="keadaan_g" id="keadaan_g" class="form-control">
                                            <option value="">--pilih keadaan--</option>
                                            <option value="baik">baik</option>
                                            <option value="cukup">cukup</option>
                                            <option value="rusak">rusak</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">luas</label>
                                        <input type="text" name="luas_g" id="luas_g" class="form-control">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">konstruksi</label>
                                        <select name="konstruksi_g" id="konstruksi_g" class="form-control">
                                            <option value="">--pilih konstruksi--</option>
                                            <option value="permanen">permanen</option>
                                            <option value="semi_permanen">semi_permanen</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">sumber dana pembangunan</label>
                                        <select name="sdp_g" id="sdp_g" class="form-control">
                                            <option value="">--pilih konstruksi--</option>
                                            <option value="swadaya">swadaya</option>
                                            <option value="kab / kota">kab / kota</option>
                                            <option value="provinsi">provinsi</option>
                                            <option value="swasta">swasta</option>
                                            <option value="PNPM">PNPM</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="ul-1 ">
                        <li>
                            <p class="kat-3">2. alat kelengkapan</p>
                            <ul>
                                <li id="kotak">
                                    <div class="my-2">
                                        <label for="name_sarana">dacin</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select name="dacin_k[]" id="dacin_k" class="form-control">
                                                    <option value="">--pilih ada / tidak ada--</option>
                                                    <option value="ada">ada</option>
                                                    <option value="tidak ada">tidak ada</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="dacin_k[]" id="dacin_k" class="form-control">
                                                    <option value="">--pilih keadaan--</option>
                                                    <option value="baik">baik</option>
                                                    <option value="cukup">cukup</option>
                                                    <option value="rusak">rusak</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">timbangan bayi</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select name="tb_k[]" id="tb_k" class="form-control">
                                                    <option value="">--pilih ada / tidak ada--</option>
                                                    <option value="ada">ada</option>
                                                    <option value="tidak ada">tidak ada</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="tb_k[]" id="tb_k" class="form-control">
                                                    <option value="">--pilih keadaan--</option>
                                                    <option value="baik">baik</option>
                                                    <option value="cukup">cukup</option>
                                                    <option value="rusak">rusak</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">timbangan injak</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select name="ti_k[]" id="ti_k" class="form-control">
                                                    <option value="">--pilih ada / tidak ada--</option>
                                                    <option value="ada">ada</option>
                                                    <option value="tidak ada">tidak ada</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="ti_k[]" id="ti_k" class="form-control">
                                                    <option value="">--pilih keadaan--</option>
                                                    <option value="baik">baik</option>
                                                    <option value="cukup">cukup</option>
                                                    <option value="rusak">rusak</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">pita LILA</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select name="pl_k[]" id="pl_k" class="form-control">
                                                    <option value="">--pilih ada / tidak ada--</option>
                                                    <option value="ada">ada</option>
                                                    <option value="tidak ada">tidak ada</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="pl_k[]" id="pl_k" class="form-control">
                                                    <option value="">--pilih keadaan--</option>
                                                    <option value="baik">baik</option>
                                                    <option value="cukup">cukup</option>
                                                    <option value="rusak">rusak</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">alat ukur tinggi badan</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select name="autb_k[]" id="autb_k" class="form-control">
                                                    <option value="">--pilih ada / tidak ada--</option>
                                                    <option value="ada">ada</option>
                                                    <option value="tidak ada">tidak ada</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="autb_k[]" id="autb_k" class="form-control">
                                                    <option value="">--pilih keadaan--</option>
                                                    <option value="baik">baik</option>
                                                    <option value="cukup">cukup</option>
                                                    <option value="rusak">rusak</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">alat ukur panjang badan</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select name="aupb_k[]" id="aupb_k" class="form-control">
                                                    <option value="">--pilih ada / tidak ada--</option>
                                                    <option value="ada">ada</option>
                                                    <option value="tidak ada">tidak ada</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="aupb_k[]" id="aupb_k" class="form-control">
                                                    <option value="">--pilih keadaan--</option>
                                                    <option value="baik">baik</option>
                                                    <option value="cukup">cukup</option>
                                                    <option value="rusak">rusak</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">sarana penyuluhan</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select name="sp_k[]" id="sp_k" class="form-control">
                                                    <option value="">--pilih ada / tidak ada--</option>
                                                    <option value="ada">ada</option>
                                                    <option value="tidak ada">tidak ada</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="sp_k[]" id="sp_k" class="form-control">
                                                    <option value="">--pilih keadaan--</option>
                                                    <option value="baik">baik</option>
                                                    <option value="cukup">cukup</option>
                                                    <option value="rusak">rusak</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">alat permainan edukatig</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select name="ape_k[]" id="ape_k" class="form-control">
                                                    <option value="">--pilih ada / tidak ada--</option>
                                                    <option value="ada">ada</option>
                                                    <option value="tidak ada">tidak ada</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="ape_k[]" id="ape_k" class="form-control">
                                                    <option value="">--pilih keadaan--</option>
                                                    <option value="baik">baik</option>
                                                    <option value="cukup">cukup</option>
                                                    <option value="rusak">rusak</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">food model</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select name="fm_k[]" id="fm_k" class="form-control">
                                                    <option value="">--pilih ada / tidak ada--</option>
                                                    <option value="ada">ada</option>
                                                    <option value="tidak ada">tidak ada</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="fm_k[]" id="fm_k" class="form-control">
                                                    <option value="">--pilih keadaan--</option>
                                                    <option value="baik">baik</option>
                                                    <option value="cukup">cukup</option>
                                                    <option value="rusak">rusak</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">mebelair</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select name="m_k[]" id="m_k" class="form-control">
                                                    <option value="">--pilih ada / tidak ada--</option>
                                                    <option value="ada">ada</option>
                                                    <option value="tidak ada">tidak ada</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="m_k[]" id="m_k" class="form-control">
                                                    <option value="">--pilih keadaan--</option>
                                                    <option value="baik">baik</option>
                                                    <option value="cukup">cukup</option>
                                                    <option value="rusak">rusak</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-2">
                                        <label for="name_sarana">papan nama</label>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <select name="pn_k[]" id="pn_k" class="form-control">
                                                    <option value="">--pilih ada / tidak ada--</option>
                                                    <option value="ada">ada</option>
                                                    <option value="tidak ada">tidak ada</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-lg-6">
                                                <select name="pn_k[]" id="pn_k" class="form-control">
                                                    <option value="">--pilih keadaan--</option>
                                                    <option value="baik">baik</option>
                                                    <option value="cukup">cukup</option>
                                                    <option value="rusak">rusak</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" id="sarana_btn" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- -- sarana modal end -- -->



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
            ajax: "{{route('sarana.fetch')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'status_g',
                    name: 'status_g'
                },
                {
                    data: 'th_bgn_g',
                    name: 'th_bgn_g'
                },
                {
                    data: 'keadaan_g',
                    name: 'keadaan_g'
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
        $('#btnsarana').on('click', function() {
            // $("#formadddesa")[0].reset();
            $('#sarana_form')[0].reset();
            $('#saranaModalTitle').html('Add Data sarana');
            $('#sarana_btn').html('Save');
            $('#saranaModal').modal('show');
        });
        // edit sarana ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            var url = 'sarana/edit';

            $.ajax({
                url: url,
                method: 'post',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    $('#saranaModalTitle').html('Edit Data sarana');
                    $('#sarana_btn').html('Update');
                    $('#saranaModal').modal('show');
                    $("#sarana_id").val(res.id);
                    $("#status_g").val(res.status_g);
                    $("#th_bgn_g").val(res.th_bgn_g);
                    $("#keadaan_g").val(res.keadaan_g);
                    $("#luas_g").val(res.luas_g);
                    $("#konstruksi_g").val(res.konstruksi_g);
                    $("#sdp_g").val(res.sdp_g);
                    // $("#dacin_k").val(res.bend_kkp);
                    // $("#tb_k").val(res.sek_kkp);
                    // $("#ti_k").val(res.ket_kkb);
                    // $("#pl_k").val(res.bend_kkb);
                    // $("#autb_k").val(res.sek_kkb);
                    // $("#aupb_k").val(res.ket_kkbp);
                    // $("#ape_k").val(res.bend_kkbp);
                    // $("#sp_k").val(res.sek_kkbp);
                    // $("#fm_k").val(res.ket_kkbe);
                    // $("#m_k").val(res.bend_kkbe);
                    // $("#pn_k").val(res.sek_kkbe);
                }
            });
        });
        $('#sarana_form').submit(function(e) {
            e.preventDefault();

            let id = $('#sarana_id').val();
            const fd = new FormData(this);
            $('#sarana_btn').val('Simpan...');
            $('#sarana_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/sarana/store',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status == 400) {
                        // console.log('salah');
                        showError('status_g', res.messages.status_g);
                        showError('th_bgn_g', res.messages.th_bgn_g);
                        showError('keadaan_g', res.messages.keadaan_g);
                        showError('luas_g', res.messages.luas_g);
                        showError('konstruksi_g', res.messages.konstruksi_g);
                        showError('sdp_g', res.messages.sdp_g);
                        showError('dacin_k', res.messages.dacin_k);
                        showError('tb_k', res.messages.tb_k);
                        showError('ti_k', res.messages.ti_k);
                        showError('pl_k', res.messages.pl_k);
                        showError('autb_k', res.messages.autb_k);
                        showError('aupb_k', res.messages.aupb_k);
                        showError('ape_k', res.messages.ape_k);
                        showError('sp_k', res.messages.sp_k);
                        showError('fm_k', res.messages.fm_k);
                        showError('m_k', res.messages.m_k);
                        showError('pn_k', res.messages.pn_k);
                        $('#sarana_btn').val('Simpan Data Sarana');
                        $('#sarana_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#sarana_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#sarana_form')
                        $('#sarana_btn').val('Simpan Data Sarana');
                        $('#sarana_btn').removeAttr('disabled');
                        $('#saranaModal').modal('hide');
                        $('.table').DataTable().ajax.reload();
                        $('#btnsarana').addClass('d-none');
                    }
                }
            })
        })

    });
</script>
@endpush