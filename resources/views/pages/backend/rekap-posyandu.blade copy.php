@extends('layouts.backend')
@push('add-styles')
<style>
    ul.ul-geografi {
        padding: 0;
        list-style: none;
    }

    ul.ul-geografi-sub {
        list-style: none;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="" id="geografi_alert"></div>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <ul class="ul-geografi">
                <li>
                    <h5>Detail geografi</h5>
                    <ul class="ul-geografi-sub">
                        <li>
                            <form action="#" method="post" id="geografi_form">
                                @csrf
                                <div class="my-2">
                                    <label for="name_geografi">R</label>
                                    <input value="{{$geografiInfo->id}}" type="hidden" name="geografi_id" id="geografi_id" class="form-control">
                                    <input value="{{$geografiInfo->jml_rw}}" type="text" name="rt" id="rt" class="form-control" placeholder="Nama geografi">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="my-2">
                                    <label for="Blok">Blok</label>
                                    <input value="{{$geografiInfo->rw}}" type="text" name="rw" id="rw" class="form-control" placeholder="Blok">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="my-2">
                                            <label for="RT">RT</label>
                                            <input value="{{$geografiInfo->rt}}" type="number" name="rt" id="rt" class="form-control" placeholder="RT">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="my-2">
                                            <label for="RW">RW</label>
                                            <input value="{{$geografiInfo->rw}}" type="number" name="rw" id="rw" class="form-control" placeholder="RW">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="my-2">
                                    <label for="Kelurahan">Kelurahan</label>
                                    <input value="{{$geografiInfo->kelurahan}}" type="text" name="kelurahan" id="kelurahan" class="form-control" placeholder="Kelurahan">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="my-2">
                                    <label for="Kecamatan">Kecamatan</label>
                                    <input value="{{$geografiInfo->kecamatan}}" type="text" name="kecamatan" id="kecamatan" class="form-control" placeholder="Kecamatan">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="my-2">
                                    <label for="Kabupaten">Kabupaten</label>
                                    <input value="{{$geografiInfo->kabupaten}}" type="text" name="kabupaten" id="kabupaten" class="form-control" placeholder="Kabupaten">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="my-2">
                                    <input type="submit" id="geografi_btn" value="Simpan Data geografi" class="btn btn-primary">
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

@push('add-scripts')

<script>
    $(function() {

        $('#geografi_form').submit(function(e) {
            e.preventDefault();

            let id = $('#geografi_id').val();
            const fd = new FormData(this);
            $('#geografi_btn').val('Simpan...');
            $('#geografi_btn').attr('disabled', 'disabled');
            // alert('dwa');
            $.ajax({
                url: '/geografi-update',
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
                        showError('kelurahan', res.messages.kelurahan);
                        showError('kecamatan', res.messages.kecamatan);
                        showError('kabupaten', res.messages.kabupaten);
                        $('#geografi_btn').val('Simpan Data geografi');
                        $('#geografi_btn').removeAttr('disabled');
                    } else if (res.status == 200) {
                        // console.log('benar');
                        $('#geografi_alert').html(showMessage('success', res.messages));
                        removeValidationClasses('#geografi_form')
                        $('#geografi_btn').val('Simpan Data geografi');
                        $('#geografi_btn').removeAttr('disabled');
                    }
                }
            })
        })
    });
</script>
@endpush