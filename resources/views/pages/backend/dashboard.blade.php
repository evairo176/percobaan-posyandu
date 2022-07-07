@extends('layouts.backend')
@section('title','dashboard')
@push('add-styles')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{asset('backend')}}/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
<link href="{{asset('backend')}}/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endpush
@section('content')
@if(auth()->user()->role == 'petugas')
@if(auth()->user()->posyandu_id)
<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">

    <div class="widget widget-account-invoice-three">

        <div class="widget-heading">
            <div class="wallet-usr-info">
                <div class="usr-name">
                    <span><img src="storage/picture/{{(auth()->user()->picture) ? auth()->user()->picture : 'profile.png'}}" alt="admin-profile" class="img-fluid"> {{auth()->user()->name}}</span>
                </div>
                <div class="add">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                </div>
            </div>
            <div class="wallet-balance">
                <p>Jumlah penduduk</p>
                <h5 class=""><span class="w-currency"></span>{{$pos->jml_pdd}}</h5>
            </div>
        </div>

        <div class="widget-amount">

            <div class="w-a-info {{($pos->jml_pdd_l < $pos->jml_pdd_p) ? 'funds-spent' : 'funds-received'}} ">
                <span>Laki-laki
                    @if($pos->jml_pdd_l < $pos->jml_pdd_p)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>

                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up">
                            <polyline points="18 15 12 9 6 15"></polyline>
                        </svg>
                        @endif
                </span>
                <p>{{$pos->jml_pdd_l}}</p>
            </div>

            <div class="w-a-info {{($pos->jml_pdd_l < $pos->jml_pdd_p) ? 'funds-received' : 'funds-spent'}} "">
                <span>Perempuan
                    @if($pos->jml_pdd_l < $pos->jml_pdd_p)
                        <svg xmlns=" http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up">
                <polyline points="18 15 12 9 6 15"></polyline>
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
                @endif
                </span>
                <p>{{$pos->jml_pdd_p}}</p>
            </div>
        </div>

        <div class="widget-content">

            <div class="bills-stats">
                <span>{{$pos->nama_posyandu}}</span>
            </div>

            <div class="invoice-list">

                <div class="inv-detail">
                    <div class="info-detail-1">
                        <p> <span class="bill-amount">Desa</span></p>
                        <p>{{$pos->kelurahan}}</p>
                    </div>
                    <div class="info-detail-2">
                        <p> <span class="bill-amount">Kecamatan</span></p>
                        <p>{{$pos->kecamatan}}</p>
                    </div>
                </div>

                <div class="inv-action">
                    <a href="/posyandu/cetak-pdf/{{auth()->user()->posyandu_id}}" class="btn btn-outline-primary view-details">View Details</a>
                </div>
            </div>
        </div>

    </div>
</div>
@else
<div class="col-lg">
    <div class="alert alert-danger" role="alert">
        Data Kosong
    </div>
</div>
@endif
@else
@if(auth()->user()->posyandu_id)
<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-account-invoice-three">

        <div class="widget-heading">
            <div class="wallet-usr-info">
                <div class="usr-name">
                    <span><img src="storage/picture/{{auth()->user()->picture}}" alt="admin-profile" class="img-fluid"> {{auth()->user()->name}}</span>
                </div>
                <div class="add">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg></span>
                </div>
            </div>
            <div class="wallet-balance">
                <p>Jumlah penduduk</p>
                <h5 class=""><span class="w-currency"></span>{{$tp->jmlh}}</h5>
            </div>
        </div>

        <div class="widget-amount">

            <div class="w-a-info {{($tpl->jmlh_l < $tpp->jmlh_p) ? 'funds-spent' : 'funds-received'}} ">
                <span>Laki-laki
                    @if($tpl->jmlh_l < $tpp->jmlh_p)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>

                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up">
                            <polyline points="18 15 12 9 6 15"></polyline>
                        </svg>
                        @endif
                </span>
                <p>{{$tpl->jmlh_l}}</p>
            </div>

            <div class="w-a-info {{($tpl->jmlh_l < $tpp->jmlh_p) ? 'funds-received' : 'funds-spent'}} "">
                <span>Perempuan
                    @if($tpl->jmlh_l < $tpp->jmlh_p)
                        <svg xmlns=" http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up">
                <polyline points="18 15 12 9 6 15"></polyline>
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
                @endif
                </span>
                <p>{{$tpp->jmlh_p}}</p>
            </div>
        </div>

        <div class="widget-content">

            <div class="bills-stats">
                <span>Dinas Pemberdayaan Masyarakat
                    <br>
                    Kabupaten Indramayu
                </span>
            </div>

            <div class="invoice-list">

                <div class="inv-detail">
                    <div class="info-detail-1">
                        <p> <span class="bill-amount">Desa</span></p>
                        <p>Sindang</p>
                    </div>
                    <div class="info-detail-2">
                        <p> <span class="bill-amount">Kecamatan</span></p>
                        <p>Sindang </p>
                    </div>
                </div>

                <div class="inv-action">
                    <a href="/posyandu" class="btn btn-outline-primary view-details">View Details</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endif
@endif
@endsection
@push('add-scripts')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('backend')}}/plugins/apex/apexcharts.min.js"></script>
<script src="{{asset('backend')}}/assets/js/dashboard/dash_1.js"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush