<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan Posyandu</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('public/landing-page')}}/libraries/bootstrap/css/bootstrap.min.css" /> -->
</head>

<body>
    <style>
        th {
            text-align: left;
        }
    </style>
    <style type="text/css">
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

        .mt-k {
            margin-top: 150px;
            margin-bottom: 300px;
            padding-left: 150px;
            padding-right: 150px;
        }

        .table {
            width: 100%;
        }

        td {
            text-align: right;
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

        th {
            width: 50%;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
    @foreach($pos as $pos)
    <div class="col-lg-12">
        <div id="posyandu_alert"></div>
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <div class="betwen" style="justify-content: space-between;
                        display: flex;
                        align-items: center;">

                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="header-posyandu">
                    <div class="img-logo">
                        <img src="{{public_path('indramayu.png')}}" alt="" class="logo-img">
                    </div>
                    <div class="p-judul">PENDATAAN POS PELAYANAN TERPADU (POSYANDU)
                        <br>
                        TINGKAT KABUPATEN INDRAMAYU
                        <br>
                        TAHUN ANGGARAN {{date('Y')}}
                    </div>

                </div>
                <div class="row justify-content-center" style="margin-bottom: 80px">
                    <div class="col-lg-8 col-md-8 col-sm-12 mt-k">
                        <table class="table table-t text-left" width="100%">
                            <tr>
                                <th width="50%" class="">Posyandu <span style="float: right;">:</span></th>
                                <td>{{$pos->nama_posyandu}}</td>
                            </tr>
                            <tr>
                                <th width="50%">Blok<span style="float: right;">:</span></th>
                                <td>{{$pos->blok}}</td>
                            </tr>
                            <tr>
                                <th width="50%">RT<span style="float: right;">:</span></th>
                                <td>{{$pos->rt}}</td>
                            </tr>
                            <tr>
                                <th width="50%">RW<span style="float: right;">:</span></th>
                                <td>{{$pos->rw}}</td>
                            </tr>
                            <tr>
                                <th width="50%">Kelurahan<span style="float: right;">:</span></th>
                                <td>{{$pos->kel}}</td>
                            </tr>
                            <tr>
                                <th width="50%">Kecamtan<span style="float: right;">:</span></th>
                                <td>{{$pos->kec}}</td>
                            </tr>
                            <tr>
                                <th width="50%">Kabupaten<span style="float: right;">:</span></th>
                                <td>INDRAMAYU</td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="header-posyandu mt-5">
                    <div class="p-judul">BADAN PEMBERDAYAAN MASYARAKAT DAN DESA
                        <br>
                        KABUPATEN INDRAMAYU
                        <br>
                        TAHUN {{date('Y')}}
                    </div>

                </div>
                <div class="page-break"></div>
                <div class="header-posyandu mt-5">
                    <div class="p-judul">BAB I
                        <br>
                        DATA UMUM
                    </div>
                </div>
                <ul class="ul-1" style="margin-bottom: 70px;">
                    <li>
                        <p class="kat-1">A. Geografi</p>
                        <ul>
                            <li>
                                <p class="kat-2">1. Wilayah Pelayanan </p>
                                <ul>
                                    <li>
                                        <table class="table">
                                            <tr>
                                                <th>a. jumlah RW<span style="float: right;">:</span></th>
                                                <td> {{$pos->jml_rw}} RW</td>
                                            </tr>
                                            <tr>
                                                <th>b. jumlah RT<span style="float: right;">:</span></th>
                                                <td> {{$pos->jml_rt}} RT</td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <p class="kat-2">2. Orbitasi sasaran posyandu </p>
                                <ul>
                                    <li>
                                        <table class="table">
                                            <tr>
                                                <th>a. Jarak terdekat ke posyandu<span style="float: right;">:</span></th>
                                                <td> {{$pos->jrk_terdekat}} M</td>
                                            </tr>
                                            <tr>
                                                <th>b. Jarak terjauh ke posyandu<span style="float: right;">:</span></th>
                                                <td> {{$pos->jrk_terjauh}} M</td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <p class="kat-2">3. Orbitasi ke fasilitas kesehatan </p>
                                <ul>
                                    <li>
                                        <table class="table">
                                            <tr>
                                                <th>a. polindes / bidan desa<span style="float: right;">:</span></th>
                                                <td> {{$pos->polindes}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>b. puskesmas pembantu<span style="float: right;">:</span></th>
                                                <td> {{$pos->pks_pembantu}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>c. puskesmas<span style="float: right;">:</span></th>
                                                <td> {{$pos->pks}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>d. praktek dokter<span style="float: right;">:</span></th>
                                                <td> {{$pos->pkt_dokter}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>e. balai pengobatan / klinik<span style="float: right;">:</span></th>
                                                <td> {{$pos->klinik}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>f. rumah sakit<span style="float: right;">:</span></th>
                                                <td> {{$pos->rumah_sakit}} KM</td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <p class="kat-2">3. Orbitasi ke fasilitas kesehatan </p>
                                <ul>
                                    <li>
                                        <table class="table">
                                            <tr>
                                                <th>a. desa / kelurahan<span style="float: right;">:</span></th>
                                                <td> {{$pos->kelurahan_g}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>b. kecamatan<span style="float: right;">:</span></th>
                                                <td> {{$pos->kecamatan_g}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>c. kabupaten<span style="float: right;">:</span></th>
                                                <td> {{$pos->kabupaten_g}} KM</td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="ul-1">
                    <li>
                        <p class="kat-1">B. Demografi</p>
                        <ul>
                            <li>
                                <p class="kat-2">1. Data Umum penduduk </p>
                                <ul>
                                    <li>
                                        <table class="table">
                                            <tr>
                                                <th>a. jumlah kepala keluarga<span style="float: right;">:</span></th>
                                                <td> {{$pos->jml_kpl_klg}} KK</td>
                                            </tr>
                                            <tr>
                                                <th>b. jumlah penduduk<span style="float: right;">:</span></th>
                                                <td> {{$pos->jml_pdd}} orang</td>
                                            </tr>
                                            <tr>
                                                <th>c. jumlah penduduk laki-laki<span style="float: right;">:</span></th>
                                                <td> {{$pos->jml_pdd_l}} orang</td>
                                            </tr>
                                            <tr>
                                                <th>d. jumlah penduduk perempuan<span style="float: right;">:</span></th>
                                                <td> {{$pos->jml_pdd_p}} orang</td>
                                            </tr>
                                            <tr>
                                                <th>e. jumlah pus<span style="float: right;">:</span></th>
                                                <td> {{$pos->jml_pus}} PUS</td>
                                            </tr>
                                            <tr>
                                                <th>f. jumlah WUS<span style="float: right;">:</span></th>
                                                <td> {{$pos->jml_wus}} WUS</td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <p class="kat-2">1. Data Umum penduduk </p>
                                <ul>
                                    <li>
                                        <table class="table">
                                            <tr>
                                                <th>a. jumlah ibu hamil <span style="float: right;">:</span></th>
                                                <td> {{$pos->jml_ibu_hml}} orang</td>
                                            </tr>
                                            <tr>
                                                <th>b. jumlah bayi (0 s/d 12 bln)<span style="float: right;">:</span></th>
                                                <td> {{$pos->jml_bayi_d}} orang</td>
                                            </tr>
                                            <tr>
                                                <th>c. jumlah balita (12 s/d 60 bln)<span style="float: right;">:</span></th>
                                                <td> {{$pos->jml_balita_d}} orang</td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="page-break"></div>
                <div class="header-posyandu ">
                    <div class="p-judul">BAB II
                        <br>
                        DATA POSYANDU
                    </div>
                </div>
                <ul class="ul-1">
                    <li>
                        <p class="kat-1">1. Kelembagaan Posyandu</p>
                        <ul>
                            <li>
                                <p class="kat-2">A. Pembentukan</p>
                                <ul>
                                    <li>
                                        <p class="kat-3">1. Musyawarah pembentukan</p>
                                        <ul>
                                            <li>
                                                <table class="table">
                                                    <tr>
                                                        <th>a. tanggal musyawarah <span style="float: right;">:</span></th>
                                                        <td> {{$pos->tgl_musyawarah}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. peserta musyawarah<span style="float: right;">:</span></th>
                                                        <td> {{$pos->psr_musyawarah}} orang</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. materi musyawarah<span style="float: right;">:</span></th>
                                                        <td> {{$pos->mtr_musyawarah}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>d. kesepakatan musyawarah<span style="float: right;">:</span></th>
                                                        <td> {{$pos->ksp_musyawarah}} </td>
                                                    </tr>
                                                </table>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <p class="kat-3">2. keputusan kepala desa / lurah</p>
                                        <ul>
                                            <li>
                                                <table class="table">
                                                    <tr>
                                                        <th>a. kepala desa / lurah <span style="float: right;">:</span></th>
                                                        <td> {{$pos->lurah}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. nomor<span style="float: right;">:</span></th>
                                                        <td> {{$pos->nomor}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. tanggal<span style="float: right;">:</span></th>
                                                        <td> {{$pos->tgl}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>d. tentang<span style="float: right;">:</span></th>
                                                        <td> {{$pos->tentang}} </td>
                                                    </tr>
                                                </table>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <p class="kat-2">B. Kepengurusan Posyandu</p>
                                <ul>
                                    <li>
                                        <p class="kat-3">1. Posyandu Multifungsi</p>
                                        <ul>
                                            <li>
                                                <table class="table">
                                                    <tr>
                                                        <th>a. Ketua <span style="float: right;">:</span></th>
                                                        <td> {{$pos->ket_m}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Bendahara<span style="float: right;">:</span></th>
                                                        <td> {{$pos->bend_m}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Seksi / Bidang<span style="float: right;">:</span></th>
                                                        <td> {{$pos->ket_m}}</td>
                                                    </tr>
                                                </table>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <p class="kat-3">2. Kelompok Kegiatan Pokok</p>
                                        <ul>
                                            <li>
                                                <table class="table">
                                                    <tr>
                                                        <th>a. Ketua <span style="float: right;">:</span></th>
                                                        <td> {{$pos->ket_kkp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Bendahara<span style="float: right;">:</span></th>
                                                        <td> {{$pos->bend_kkp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Seksi / Bidang<span style="float: right;">:</span></th>
                                                        <td> {{$pos->ket_kkp}}</td>
                                                    </tr>
                                                </table>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <p class="kat-3">3. Kelompok Kegiatan BKB</p>
                                        <ul>
                                            <li>
                                                <table class="table">
                                                    <tr>
                                                        <th>a. Ketua <span style="float: right;">:</span></th>
                                                        <td> {{$pos->ket_kkb}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Bendahara<span style="float: right;">:</span></th>
                                                        <td> {{$pos->bend_kkb}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Seksi / Bidang<span style="float: right;">:</span></th>
                                                        <td> {{$pos->ket_kkb}}</td>
                                                    </tr>
                                                </table>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <p class="kat-3">4. Kelompok Kegiatan Bidang Pendidikan / PAUD</p>
                                        <ul>
                                            <li>
                                                <table class="table">
                                                    <tr>
                                                        <th>a. Ketua <span style="float: right;">:</span></th>
                                                        <td> {{$pos->ket_kkbp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Bendahara<span style="float: right;">:</span></th>
                                                        <td> {{$pos->bend_kkbp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Seksi / Bidang<span style="float: right;">:</span></th>
                                                        <td> {{$pos->ket_kkbp}}</td>
                                                    </tr>
                                                </table>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <p class="kat-3">5. Kelompok Kegiatan Bidang Ekonomi / UP2K / UPPKS</p>
                                        <ul>
                                            <li>
                                                <table class="table">
                                                    <tr>
                                                        <th>a. Ketua <span style="float: right;">:</span></th>
                                                        <td> {{$pos->ket_kkbe}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Bendahara<span style="float: right;">:</span></th>
                                                        <td> {{$pos->bend_kkbe}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Seksi / Bidang<span style="float: right;">:</span></th>
                                                        <td> {{$pos->ket_kkbe}}</td>
                                                    </tr>
                                                </table>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <p class="kat-2">C. Sarana dan Prasarana</p>
                                <ul>
                                    <li>
                                        <p class="kat-3">1. Gedung</p>
                                        <ul>
                                            <li>
                                                <table class="table">
                                                    <tr>
                                                        <th>a. Status <span style="float: right;">:</span></th>
                                                        <td> {{$pos->status_g}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Tahun dibangun<span style="float: right;">:</span></th>
                                                        <td> {{$pos->th_bgn_g}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Keadaan<span style="float: right;">:</span></th>
                                                        <td> {{$pos->keadaan_g}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>d. Luas<span style="float: right;">:</span></th>
                                                        <td> {{$pos->luas_g}} <sub>2</sub>m</td>
                                                    </tr>
                                                    <tr>
                                                        <th>e. Konstruksi<span style="float: right;">:</span></th>
                                                        <td> {{$pos->konstruksi_g}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>e. Sumber Dana pembangunan<span style="float: right;">:</span></th>
                                                        <td> {{$pos->sdp_g}}</td>
                                                    </tr>
                                                </table>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <p class="kat-3">2. Alat Kelengkapan</p>
                                        <ul>
                                            <li>
                                                <table class="table">
                                                    <tr>
                                                        <th>a. Dacin <span style="float: right;">:</span></th>
                                                        <td>
                                                            @if($pos->dacin_k == null)
                                                            data kosong
                                                            @else
                                                            @foreach(unserialize($pos->dacin_k) as $item)
                                                            {{$item}} <br>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Timbangan Bayi<span style="float: right;">:</span></th>
                                                        <td>
                                                            @if($pos->tb_k == null)
                                                            data kosong
                                                            @else
                                                            @foreach(unserialize($pos->tb_k) as $item)
                                                            {{$item}} <br>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Timbangan Injak<span style="float: right;">:</span></th>
                                                        <td>
                                                            @if($pos->ti_k == null)
                                                            data kosong
                                                            @else
                                                            @foreach(unserialize($pos->ti_k) as $item)
                                                            {{$item}} <br>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>d. Pita LILA<span style="float: right;">:</span></th>
                                                        <td>
                                                            @if($pos->pl_k == null)
                                                            data kosong
                                                            @else
                                                            @foreach(unserialize($pos->pl_k) as $item)
                                                            {{$item}} <br>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>e. Alat Ukur Tinggi Badan<span style="float: right;">:</span></th>
                                                        <td>
                                                            @if($pos->autb_k == null)
                                                            data kosong
                                                            @else
                                                            @foreach(unserialize($pos->autb_k) as $item)
                                                            {{$item}} <br>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>f. Alat Ukur Panjang Badan<span style="float: right;">:</span></th>
                                                        <td>
                                                            @if($pos->aupb_k == null)
                                                            data kosong
                                                            @else
                                                            @foreach(unserialize($pos->aupb_k) as $item)
                                                            {{$item}} <br>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>g. Alat Permainan Edukatif (APE)<span style="float: right;">:</span></th>
                                                        <td>
                                                            @if($pos->ape_k == null)
                                                            data kosong
                                                            @else
                                                            @foreach(unserialize($pos->ape_k) as $item)
                                                            {{$item}} <br>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>h. Sarana Penyuluhan<span style="float: right;">:</span></th>
                                                        <td>
                                                            @if($pos->sp_k == null)
                                                            data kosong
                                                            @else
                                                            @foreach(unserialize($pos->sp_k) as $item)
                                                            {{$item}} <br>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>i. Food Model<span style="float: right;">:</span></th>
                                                        <td>
                                                            @if($pos->fm_k == null)
                                                            data kosong
                                                            @else
                                                            @foreach(unserialize($pos->fm_k) as $item)
                                                            {{$item}} <br>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>j. Mebelair<span style="float: right;">:</span></th>
                                                        <td>
                                                            @if($pos->m_k == null)
                                                            data kosong
                                                            @else
                                                            @foreach(unserialize($pos->m_k) as $item)
                                                            {{$item}} <br>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>k. Papan Nama / plang posyandu<span style="float: right;">:</span></th>
                                                        <td>
                                                            @if($pos->pn_k == null)
                                                            data kosong
                                                            @else
                                                            @foreach(unserialize($pos->pn_k) as $item)
                                                            {{$item}} <br>
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-break"></div>
    @endforeach

</body>

</html>