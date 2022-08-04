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
                            <th>petugas</th>
                            <th>nama posyandu</th>
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
                    <tbody>
                        @foreach($perkembangan as $per)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$per->kec}}</td>
                            <td>{{$per->name_petugas}}</td>
                            <td>{{$per->nama_posyandu}}</td>
                            <td>{{$per->pra}}</td>
                            <td>{{$per->mad}}</td>
                            <td>{{$per->pur}}</td>
                            <td>{{$per->man}}</td>
                            <td>{{$per->jml_bgn}}</td>
                            <td>{{$per->jml_kader}}</td>
                            <td>{{$per->tahun_rekap}}</td>
                            <td>{{$per->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    @if($per->status == null)
                                    <a class="btn btn-success" href="/kecamatan/perkembangan/status/diterima/{{$per->id_per}}">diterima</a>
                                    <a class="btn btn-danger" href="/kecamatan/perkembangan/status/ditolak/{{$per->id_per}}">ditolak</a>
                                    @endif
                                    <a class="btn btn-warning" href="/kecamatan/perkembangan/status/detail/{{$per->id_per}}">lihat detail</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
    });
</script>
@endpush