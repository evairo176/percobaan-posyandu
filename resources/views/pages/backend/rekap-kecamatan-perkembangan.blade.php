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

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="{{asset('backend')}}/plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="{{asset('backend')}}/plugins/table/datatable/dt-global_style.css">
<!-- END PAGE LEVEL STYLES -->
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
<!-- menambahkan komentar saja -->
@endpush
@section('content')

<div class="col-lg-12">
    <div id="perkembangan_alert"></div>
    <div class="statbox widget box box-shadow">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
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
                <table id="datatable" class="table table-hover text-secondary">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>kecamatan</th>
                            <th>petugas</th>
                            <th>nama posyandu</th>
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
                            <td>{{$per->tahun_rekap}}</td>
                            <td>{{$per->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    @if($per->status == null)
                                    <a class="btn btn-success" href="/kecamatan/perkembangan/status/diterima/{{$per->id_per}}">diterima</a>
                                    <a class="btn btn-danger" href="/kecamatan/perkembangan/status/ditolak/{{$per->id_per}}">ditolak</a>
                                    @elseif($per->status == 'dpmd ditolak' || $per->status == 'kecamatan ditolak')
                                    <a class="btn btn-danger" href="#">status ditolak</a>
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

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('backend')}}/plugins/table/datatable/datatables.js"></script>
<script>
    $('#datatable').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7
    });
</script>
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