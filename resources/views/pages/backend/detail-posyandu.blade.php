@extends('layouts.backend')
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
    .header-posyandu {
        text-align: center;

    }

    img.logo-img {
        max-width: 285px;
        margin-bottom: 20px;
    }

    .p-judul {
        font-size: 20px;
        font-weight: 800;
        color: #000;
    }
</style>
@endpush
@section('content')
<div class="col-lg-12">
    <div id="posyandu_alert"></div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">
                        <h4>Table posyandu</h4>
                        <a href="{{url('posyandu/cetak-pdf/')$pos->id}" class="btn btn-danger mb-2 mr-2" id="btnposyandu">
                            Print to pdf
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="header-posyandu">
                <div class="img-logo">
                    <img src="{{url('storage/website/indramayu.png')}}" alt="" class="logo-img">
                    </div>
                    <div class="p-judul">PENDATAAN POS PELAYANAN TERPADU (POSYANDU)
                        <br>
                        TINGKAT KABUPATEN INDRAMAYU
                        <br>
                        TAHUN ANGGARAN 2015
                    </div>
                </div>
            </div>
        </div>
    </div>






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

    @endpush