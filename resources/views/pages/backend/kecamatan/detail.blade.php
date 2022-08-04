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
        <div class="card">
            <div class="card-body">
                <form action="#" method="post" id="perkembangan_form">
                    @csrf
                    <div class="my-2">
                        <label for="name_kader">tahun rekap</label>
                        <select name="tahun_rekap" id="tahun_rekap" class="form-control">
                            <option value="">--pilih tahun--</option>
                            <?php for ($i = date('Y'); $i >= date('Y') - 70; $i -= 1) { ?>
                                <option value="{{$i}}" {{($perkembangan->tahun_rekap == $i) ? 'selected' : ''}}>{{$i}}</option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="my-2">
                                <label for="name_strata">pra</label>
                                <input type="hidden" name="perkembangan_id" id="perkembangan_id" class="form-control">
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
                        <a href="/kecamatan-perkembangan" id="perkembangan_btn" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






@endsection

@push('add-scripts')
<script src="{{asset('backend')}}/assets/js/scrollspyNav.js"></script>
<script type="text/javascript" src="{{asset('datatable')}}/datatables.min.js"></script>
<script src="{{asset('backend')}}/assets/js/scrollspyNav.js"></script>
<script src="{{asset('backend')}}/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="{{asset('backend')}}/plugins/sweetalerts/custom-sweetalert.js"></script>
<script>
    $(function() {

    });
</script>
@endpush