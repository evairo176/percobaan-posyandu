@extends('layouts.backend')
@section('title','perkembangan')
@push('add-styles')
<link href="{{asset('backend')}}/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
<style>
    @media print {
        .noPrint {
            display: none;
        }

        .highcharts-credits {
            display: none;
        }

        .title-grafik {
            text-align: center;
        }

        .widget-chart-one .widget-heading {
            display: block;
            justify-content: none;
        }


    }

    .highcharts-credits {
        display: none;
    }

    .page-break {
        page-break-after: always;
    }
</style>
<!-- menambahkan komentar saja -->
@endpush
@section('content')

<div class=" col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
    <div class="widget widget-chart-one">
        <div class="widget-heading">
            <h5 class="title-grafik">Laporan Grafik Perkembangan Posyandu Dinas <br> Pemberdayaan Masyarakat Dan Desa <br> Kabupaten Indrmayu</h5>
            <div class="task-action">
                <div class="dropdown noPrint">
                    <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                        <a class="dropdown-item" onclick="window.print();" href="javascript:void(0);">Print</a>
                        <!-- <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                        <a class="dropdown-item" href="javascript:void(0);">Yearly</a> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="widget-content" style="position: relative;">

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="pratama"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="madya"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="purnama"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="mandiri"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="jml_bgn"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="jml_kader"></div>
                    </div>
                </div>
            </div>
            <div class="page-break"></div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="jml_terlatih"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="s"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="k"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="d"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="n"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="kb_aktif"></div>
                    </div>
                </div>
            </div>
            <div class="page-break"></div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="k4"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="fe3"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="campak"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="bcg"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="dpt"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="hbo"></div>
                    </div>
                </div>
            </div>
            <div class="page-break"></div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="polio"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="gizi"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div>
                        <div id="diare"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>






@endsection

@push('add-scripts')
<script src="{{asset('backend')}}/assets/js/dashboard/dash_1.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
    var tahun = <?php echo json_encode($tahun) ?>;
    var data_pra = <?php echo json_encode($data_pra) ?>;

    Highcharts.chart('pratama', {
        title: {
            text: 'Posyandu Pratama (pra)'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Posyandu Pratama (pra)'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Posyandu Pratama',
            data: data_pra
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },


    });

    var data_mad = <?php echo json_encode($data_mad) ?>;
    Highcharts.chart('madya', {
        title: {
            text: 'Posyandu madya (mad)'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Posyandu madya (mad)'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Posyandu madya',
            data: data_mad
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });

    var data_man = <?php echo json_encode($data_man) ?>;
    Highcharts.chart('mandiri', {
        title: {
            text: 'Posyandu mandiri (man)'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Posyandu mandiri (man)'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Posyandu mandiri',
            data: data_man
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_pur = <?php echo json_encode($data_pur) ?>;
    Highcharts.chart('purnama', {
        title: {
            text: 'Posyandu purnama (pur)'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Posyandu purnama (pur)'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Posyandu purnama',
            data: data_pur
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_jml_bgn = <?php echo json_encode($data_jml_bgn) ?>;
    Highcharts.chart('jml_bgn', {
        title: {
            text: 'Jumlah Bangunan '
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Bangunan '
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Bangunan',
            data: data_jml_bgn
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_jml_kader = <?php echo json_encode($data_jml_kader) ?>;
    Highcharts.chart('jml_kader', {
        title: {
            text: 'Jumlah Kader '
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Kader '
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Kader',
            data: data_jml_kader
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_jml_terlatih = <?php echo json_encode($data_jml_terlatih) ?>;
    Highcharts.chart('jml_terlatih', {
        title: {
            text: 'Jumlah Kader Terlatih'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Kader Terlatih'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Kader Terlatih',
            data: data_jml_terlatih
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_s = <?php echo json_encode($data_s) ?>;
    Highcharts.chart('s', {
        title: {
            text: 'Jumlah Bayi dan Balita Sasaran Posyandu (S)'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Bayi dan Balita Sasaran Posyandu'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Bayi dan Balita Sasaran Posyandu',
            data: data_s
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_k = <?php echo json_encode($data_k) ?>;
    Highcharts.chart('k', {
        title: {
            text: 'Jumlah Balita Yang Memiliki KMS (K)'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Balita Yang Memiliki KMS'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Balita Yang Memiliki KMS',
            data: data_k
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_d = <?php echo json_encode($data_d) ?>;
    Highcharts.chart('d', {
        title: {
            text: 'Jumlah Bayi dan Balita datang ditimbang (D)'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Bayi dan Balita datang ditimbang'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Bayi dan Balita datang ditimbang',
            data: data_d
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_n = <?php echo json_encode($data_n) ?>;
    Highcharts.chart('n', {
        title: {
            text: 'Jumlah Bayi dan Balita naik timbangan (N)'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Bayi dan Balita naik timbangan'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Bayi dan Balita naik timbangan',
            data: data_n
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_kb_aktif = <?php echo json_encode($data_kb_aktif) ?>;
    Highcharts.chart('kb_aktif', {
        title: {
            text: 'Jumlah KB Aktif'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah KB Aktif'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah KB Aktif',
            data: data_kb_aktif
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_k4 = <?php echo json_encode($data_k4) ?>;
    Highcharts.chart('k4', {
        title: {
            text: 'Jumlah Pemeriksaan Ibu Hamil (K-4)'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Pemeriksaan Ibu Hamil'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Pemeriksaan Ibu Hamil',
            data: data_k4
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_fe3 = <?php echo json_encode($data_fe3) ?>;
    Highcharts.chart('fe3', {
        title: {
            text: 'Jumlah Pemberian Tablet Fe'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Pemberian Tablet Fe'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Pemberian Tablet Fe',
            data: data_fe3
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_campak = <?php echo json_encode($data_campak) ?>;
    Highcharts.chart('campak', {
        title: {
            text: 'Jumlah Campak'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Campak'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Campak',
            data: data_campak
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_bcg = <?php echo json_encode($data_bcg) ?>;
    Highcharts.chart('bcg', {
        title: {
            text: 'Jumlah BCG'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah BCG'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah BCG',
            data: data_bcg
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_dpt = <?php echo json_encode($data_dpt) ?>;
    Highcharts.chart('dpt', {
        title: {
            text: 'Jumlah DPT'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah DPT'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah DPT',
            data: data_dpt
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_hbo = <?php echo json_encode($data_hbo) ?>;
    Highcharts.chart('hbo', {
        title: {
            text: 'Jumlah HBO'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah HBO'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah HBO',
            data: data_hbo
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_polio = <?php echo json_encode($data_polio) ?>;
    Highcharts.chart('polio', {
        title: {
            text: 'Jumlah Polio'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Polio'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Polio',
            data: data_polio
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_gizi = <?php echo json_encode($data_gizi) ?>;
    Highcharts.chart('gizi', {
        title: {
            text: 'Jumlah Gizi'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Gizi'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Gizi',
            data: data_gizi
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    var data_diare = <?php echo json_encode($data_diare) ?>;
    Highcharts.chart('diare', {
        title: {
            text: 'Jumlah Diare'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: tahun
        },
        yAxis: {
            title: {
                text: 'Jumlah Diare'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Jumlah Diare',
            data: data_diare
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>

</html>
@endpush