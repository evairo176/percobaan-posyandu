<!DOCTYPE html>
<html>

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
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
            margin-top: 500px;
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

        p {
            margin-top: 0;
            margin-bottom: 5px;
        }
    </style>
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
                        <img src="{{url('indramayu.png')}}" alt="" class="logo-img">
                    </div>
                    <div class="p-judul">PENDATAAN POS PELAYANAN TERPADU (POSYANDU)
                        <br>
                        TINGKAT KABUPATEN INDRAMAYU
                        <br>
                        TAHUN ANGGARAN {{date('Y')}}
                    </div>

                </div>
                <div class="row justify-content-center" style="margin-bottom: 280px;">
                    <div class="col-lg-8 col-md-8 col-sm-12 mt-k">
                        <table class="table table-t text-left" width="60%">
                            <tr>
                                <th width="50%" class="">Posyandu</th>
                                <td>:{{$pos->nama_posyandu}}</td>
                            </tr>
                            <tr>
                                <th width="50%">Blok</th>
                                <td>:{{$pos->blok}}</td>
                            </tr>
                            <tr>
                                <th width="50%">RT</th>
                                <td>:{{$pos->rt}}</td>
                            </tr>
                            <tr>
                                <th width="50%">RW</th>
                                <td>:{{$pos->rw}}</td>
                            </tr>
                            <tr>
                                <th width="50%">Kelurahan</th>
                                <td>:{{$pos->kel}}</td>
                            </tr>
                            <tr>
                                <th width="50%">Kecamtan</th>
                                <td>:{{$pos->kec}}</td>
                            </tr>
                            <tr>
                                <th width="50%">Kabupaten</th>
                                <td>:INDRAMAYU</td>
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

                <div class="header-posyandu mt-5">
                    <div class="p-judul">BAB I
                        <br>
                        DATA UMUM
                    </div>
                </div>
                <ul class="ul-1" style="margin-bottom: 0px;">
                    <li>
                        <p class="kat-1">A. Geografi</p>
                        <ul>
                            <li>
                                <p class="kat-2">1. Wilayah Pelayanan </p>
                                <ul>
                                    <li>
                                        <table class="table">
                                            <tr>
                                                <th>a. jumlah RW</th>
                                                <td>: {{$pos->jml_rw}} RW</td>
                                            </tr>
                                            <tr>
                                                <th>b. jumlah RT</th>
                                                <td>: {{$pos->jml_rt}} RT</td>
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
                                                <th>a. Jarak terdekat ke posyandu</th>
                                                <td>: {{$pos->jrk_terdekat}} M</td>
                                            </tr>
                                            <tr>
                                                <th>b. Jarak terjauh ke posyandu</th>
                                                <td>: {{$pos->jrk_terjauh}} M</td>
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
                                                <th>a. polindes / bidan desa</th>
                                                <td>: {{$pos->polindes}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>b. puskesmas pembantu</th>
                                                <td>: {{$pos->pks_pembantu}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>c. puskesmas</th>
                                                <td>: {{$pos->pks}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>d. praktek dokter</th>
                                                <td>: {{$pos->pkt_dokter}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>e. balai pengobatan / klinik</th>
                                                <td>: {{$pos->klinik}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>f. rumah sakit</th>
                                                <td>: {{$pos->rumah_sakit}} KM</td>
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
                                                <th>a. desa / kelurahan</th>
                                                <td>: {{$pos->kelurahan_g}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>b. kecamatan</th>
                                                <td>: {{$pos->kecamatan_g}} KM</td>
                                            </tr>
                                            <tr>
                                                <th>c. kabupaten</th>
                                                <td>: {{$pos->kabupaten_g}} KM</td>
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
                                                <th>a. jumlah kepala keluarga</th>
                                                <td>: {{$pos->jml_kpl_klg}} KK</td>
                                            </tr>
                                            <tr>
                                                <th>b. jumlah penduduk</th>
                                                <td>: {{$pos->jml_pdd}} orang</td>
                                            </tr>
                                            <tr>
                                                <th>c. jumlah penduduk laki-laki</th>
                                                <td>: {{$pos->jml_pdd_l}} orang</td>
                                            </tr>
                                            <tr>
                                                <th>d. jumlah penduduk perempuan</th>
                                                <td>: {{$pos->jml_pdd_p}} orang</td>
                                            </tr>
                                            <tr>
                                                <th>e. jumlah pus</th>
                                                <td>: {{$pos->jml_pus}} PUS</td>
                                            </tr>
                                            <tr>
                                                <th>f. jumlah WUS</th>
                                                <td>: {{$pos->jml_wus}} WUS</td>
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
                                                <th>a. jumlah ibu hamil </th>
                                                <td>: {{$pos->jml_ibu_hml}} orang</td>
                                            </tr>
                                            <tr>
                                                <th>b. jumlah bayi (0 s/d 12 bln)</th>
                                                <td>: {{$pos->jml_bayi_d}} orang</td>
                                            </tr>
                                            <tr>
                                                <th>c. jumlah balita (12 s/d 60 bln)</th>
                                                <td>: {{$pos->jml_balita_d}} orang</td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
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
                                                        <th>a. tanggal musyawarah </th>
                                                        <td>: {{$pos->tgl_musyawarah}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. peserta musyawarah</th>
                                                        <td>: {{$pos->psr_musyawarah}} orang</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. materi musyawarah</th>
                                                        <td>: {{$pos->mtr_musyawarah}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>d. kesepakatan musyawarah</th>
                                                        <td>: {{$pos->ksp_musyawarah}} </td>
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
                                                        <th>a. kepala desa / lurah </th>
                                                        <td>: {{$pos->lurah}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. nomor</th>
                                                        <td>: {{$pos->nomor}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. tanggal</th>
                                                        <td>: {{$pos->tgl}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>d. tentang</th>
                                                        <td>: {{$pos->tentang}} </td>
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
                                                        <th>a. Ketua </th>
                                                        <td>: {{$pos->ket_m}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Bendahara</th>
                                                        <td>: {{$pos->bend_m}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Seksi / Bidang</th>
                                                        <td>: {{$pos->ket_m}}</td>
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
                                                        <th>a. Ketua </th>
                                                        <td>: {{$pos->ket_kkp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Bendahara</th>
                                                        <td>: {{$pos->bend_kkp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Seksi / Bidang</th>
                                                        <td>: {{$pos->ket_kkp}}</td>
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
                                                        <th>a. Ketua </th>
                                                        <td>: {{$pos->ket_kkb}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Bendahara</th>
                                                        <td>: {{$pos->bend_kkb}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Seksi / Bidang</th>
                                                        <td>: {{$pos->ket_kkb}}</td>
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
                                                        <th>a. Ketua </th>
                                                        <td>: {{$pos->ket_kkbp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Bendahara</th>
                                                        <td>: {{$pos->bend_kkbp}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Seksi / Bidang</th>
                                                        <td>: {{$pos->ket_kkbp}}</td>
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
                                                        <th>a. Ketua </th>
                                                        <td>: {{$pos->ket_kkbe}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>b. Bendahara</th>
                                                        <td>: {{$pos->bend_kkbe}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>c. Seksi / Bidang</th>
                                                        <td>: {{$pos->ket_kkbe}}</td>
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
    <script>
        window.print();
    </script>
</body>

</html>