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
@if(auth()->user()->posyandu_id == null)
@if(auth()->user()->role == 'super-admin')
<div class="col-lg-4 col-md-4 col-sm-12 layout-spacing">
    <div class="widget widget-account-invoice-three">
        <div class="widget-heading" style="border-bottom-left-radius: 0px; margin-bottom: 0px;">
            <div class="w-numeric-value">
                <div class="w-icon">
                    <svg style="color: #ffff;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
            <div class="wallet-balance d-flex jutify-content-between align-items-center">
                <div style="color: #ffff; font-size: 15px;">Total Posyandu</div>
                <h5 class=""><span class="w-currency"></span>{{$total_posyandu}}</h5>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-12 layout-spacing">
    <div class="widget widget-account-invoice-three">
        <div class="widget-heading" style="border-bottom-left-radius: 0px; margin-bottom: 0px;">
            <div class="w-numeric-value">
                <div class="w-icon">
                    <svg style="color: #ffff;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
            <div class="wallet-balance d-flex jutify-content-between align-items-center">
                <div style="color: #ffff; font-size: 15px;">Total Petugas</div>
                <h5 class=""><span class="w-currency"></span>{{$total_petugas}}</h5>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-12 layout-spacing">
    <div class="widget widget-account-invoice-three">
        <div class="widget-heading" style="border-bottom-left-radius: 0px; margin-bottom: 0px;">
            <div class="w-numeric-value">
                <div class="w-icon">
                    <svg style="color: #ffff;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
            <div class="wallet-balance d-flex jutify-content-between align-items-center">
                <div style="color: #ffff; font-size: 15px;">Total Rekap Perkembangan</div>
                <h5 class=""><span class="w-currency"></span>{{$total_perkembangan}}</h5>
            </div>
        </div>
    </div>
</div>
<div class=" col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
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
<div class=" col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-chart-one">
        <div class="widget-heading">
            <h5 class="">Revenue</h5>
            <div class="task-action">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                        <a class="dropdown-item" href="javascript:void(0);">Weekly</a>
                        <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                        <a class="dropdown-item" href="javascript:void(0);">Yearly</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget-content" style="position: relative;">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>

    </div>
</div>

@else
<div class="col-lg-4 col-md-4 col-sm-12 layout-spacing">
    <div class="widget widget-account-invoice-three">
        <div class="widget-heading" style="border-bottom-left-radius: 0px; margin-bottom: 0px;">
            <div class="w-numeric-value">
                <div class="w-icon">
                    <svg style="color: #ffff;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
            <div class="wallet-balance d-flex jutify-content-between align-items-center">
                <div style="color: #ffff; font-size: 15px;">Total Posyandu</div>
                <h5 class=""><span class="w-currency"></span>{{$total_posyandu_kecamatan}}</h5>
            </div>
        </div>
    </div>
</div>
<!-- <div class="col-lg-4 col-md-4 col-sm-12 layout-spacing">
    <div class="widget widget-account-invoice-three">
        <div class="widget-heading" style="border-bottom-left-radius: 0px; margin-bottom: 0px;">
            <div class="w-numeric-value">
                <div class="w-icon">
                    <svg style="color: #ffff;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
            <div class="wallet-balance d-flex jutify-content-between align-items-center">
                <div style="color: #ffff; font-size: 15px;">Total Petugas</div>
                <h5 class=""><span class="w-currency"></span>{{$total_petugas_kecamatan}}</h5>
            </div>
        </div>
    </div>
</div> -->
@endif




@endif
@endif
@endsection
@push('add-scripts')
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('backend')}}/plugins/apex/apexcharts.min.js"></script>
<script src="{{asset('backend')}}/assets/js/dashboard/dash_1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

<!-- <script>
    const labels = [
        'Jumlah Kader',
        'Jumlah Kader Terlatih',
        'Jumlah Kader Tidak Terlatih',
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Kader',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45],
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {}
    };
</script>
<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script> -->
@endpush