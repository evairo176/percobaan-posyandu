@extends('layouts.landing-page')

@section('content')
<style>
    .manfaat .card-manfaat {
        min-height: 700px;
        margin-bottom: 20px;
    }

    .p-content {
        text-align: justify;
    }
</style>
<!-- konten  -->
<section class="manfaat">
    <div class="container">
        <div class="title-header">
            <h2>Manfaat Posyandu <span>Rutin</span></h2>
            <p>Melalui posyandu, pemerintah berupaya untuk menyediakan layanan yang dibutuhkan masyarakat, seperti perbaikan gizi dan kesehatan, pendidikan dan perkembangan anak, peningkatan ekonomi keluarga, hingga ketahanan pangan dan kesejahteraan sosial..</p>
            <img src="{{asset('landing-page')}}/images/header_divider.png" alt="">
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-manfaat">
                    <div class="text-center">
                        <div class="bg-manfaat">
                            <ion-icon name="medkit-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="content">
                        <h2>Program kesehatan ibu hamil dan menyusui</h2>
                        <p class="p-content">Pelayanan yang diberikan posyandu kepada ibu hamil mencakup pemeriksaan kehamilan dan pemantauan gizi. Tak hanya pemeriksaan, ibu hamil juga dapat melakukan konsultasi terkait persiapan persalinan dan pemberian ASI.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-manfaat">
                    <div class="bg-manfaat2">
                        <ion-icon name="medkit-outline"></ion-icon>
                    </div>
                    <div class="content">
                        <h2>Program kesehatan bayi dan anak balita</h2>
                        <p class="p-content">Salah satu program utama posyandu adalah menyelenggarakan pemeriksaan bayi dan balita secara rutin. Hal ini penting dilakukan untuk memantau tumbuh kembang anak dan mendeteksi gangguan tumbuh kembang anak sejak dini.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-manfaat">
                    <div class="bg-manfaat3">
                        <ion-icon name="medkit-outline"></ion-icon>
                    </div>
                    <div class="content">
                        <h2>Keluarga Berencana (KB)</h2>
                        <p class="p-content">Pelayanan KB di posyandu umumnya diberikan oleh kader dalam bentuk pemberian kondom dan pil KB. Sedangkan, suntik KB hanya dapat diberikan oleh tenaga medis puskesmas. Apabila tersedia ruangan dan peralatan yang menunjang serta tenaga yang terlatih, di posyandu juga dapat dilakukan pemasangan IUD dan implan..</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-manfaat">
                    <div class="bg-manfaat4">
                        <ion-icon name="medkit-outline"></ion-icon>
                    </div>
                    <div class="content">
                        <h2>Imunisasi</h2>
                        <p class="p-content">Imunisasi wajib merupakan salah satu program pemerintah yang mengharuskan setiap anak usia di bawah 1 tahun melakukan vaksinasi. Kementerian Kesehatan Republik Indonesia telah menetapkan ada 5 jenis imunisasi yang wajib diberikan, yaitu imunisasi hepatitis B, polio, BCG, campak, dan DPT-HB-HiB.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-manfaat">
                    <div class="bg-manfaat4" style="background: #000;">
                        <ion-icon name="medkit-outline"></ion-icon>
                    </div>
                    <div class="content">
                        <h2>Pemantauan status gizi</h2>
                        <p class="p-content">Melalui kegiatan pemantauan gizi, posyandu berperan penting dalam mencegah risiko stunting pada anak. Pelayanan gizi di posyandu meliputi penimbangan berat dan pengukuran tinggi badan, deteksi dini gangguan pertumbuhan, penyuluhan gizi, dan pemberian suplemen.

                            Apabila ditemukan ibu hamil dengan kondisi kurang energi kronis (KEK) atau balita yang pertumbuhannya tidak sesuai usia, kader posyandu dapat merujuk pasien ke puskesmas.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-manfaat">
                    <div class="bg-manfaat4" style="background: #2c05dd;">
                        <ion-icon name="medkit-outline"></ion-icon>
                    </div>
                    <div class="content">
                        <h2> diare</h2>
                        <p class="p-content">Pencegahan diare dilakukan melalui penyuluhan Perilaku Hidup Bersih dan Sehat (PHBS). Sedangkan, penanganan diare dilakukan melalui pemberian oralit. Apabila diperlukan penanganan lebih lanjut, petugas kesehatan dapat memberikan suplemen zinc.
                            Apabila ditemukan ibu hamil dengan kondisi kurang energi kronis (KEK) atau balita yang pertumbuhannya tidak sesuai usia, kader posyandu dapat merujuk pasien ke puskesmas.</p>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-manfaat">
                    <div class="bg-manfaat4" style="background: #2c05dd;">
                        <ion-icon name="medkit-outline"></ion-icon>
                    </div>
                    <div class="content">
                        <h2>penanggulangan diare</h2>
                        <p>Pencegahan diare dilakukan melalui penyuluhan Perilaku Hidup Bersih dan Sehat (PHBS). Sedangkan, penanganan diare dilakukan melalui pemberian oralit. Apabila diperlukan penanganan lebih lanjut, petugas kesehatan dapat memberikan suplemen zinc.
                            <br>
                            Selain itu, posyandu memiliki kegiatan pengembangan atau pilihan yang mencakup Bina Keluarga Balita (BKB), Tanaman Obat Keluarga (TOGA), Bina Keluarga Lansia (BKL), dan Pendidikan Anak Usia Dini (PAUD).
                        </p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
<section class="post">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="text-box">
                    <ul>
                        <li>
                            <a href="javascript:void(0)" class="btn-overview active" data-id="overview">Berita</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="btn-mission" data-id="mission">Tujuan</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="btn-post" data-id="post">Kegiatan</a>
                        </li>
                    </ul>
                    <div class="n-content" data-id="overview">
                        <h2>informasi yang menyampaikan peristiwa yang sedang terjadi atau terkini.</h2>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="post-content">
                                    <div class="bg-post">
                                        <ion-icon name="newspaper-outline"></ion-icon>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="text-box">
                                    <h2>Berita Pertama</h2>
                                    <p>Gelar Posyandu Lansia di Pasar Rebo, Kemensos Ingin Tingkatkan Kualitas Hidup Lansia.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="post-content">
                                    <div class="bg-post">
                                        <ion-icon name="newspaper-outline"></ion-icon>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="text-box">
                                    <h2>Berita Kedua</h2>
                                    <p>Membangkitkan Posyandu Setelah Badai Covid-19 Berlalu.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="n-content hide" data-id="mission">
                        <h2>Berfungsi sebagai wahana gerakan reproduksi keluarga sejahtera, gerakan ketahanan keluarga dan gerakan ekonomi keluarga sejahtera.</h2>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="post-content">
                                    <div class="bg-post">
                                        <ion-icon name="basketball-outline"></ion-icon>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="text-box">
                                    <h2>Jenis Pelayanan Minimal Kepada Anak</h2>
                                    <p>Penimbangan untuk memantau pertumbuhan anak, perhatian harus diberikan khusus terhadap anak yang selama ini 3 kali tidak melakukan penimbangan.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="post-content">
                                    <div class="bg-post">
                                        <ion-icon name="basketball-outline"></ion-icon>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="text-box">
                                    <h2>Pelayanan Tambahan yang Diberikan </h2>
                                    <p>Program Pengembangan Anak Dini Usia (PADU) yang diintegenerasikan dengan program Bina Keluarga Balita (BKB) dan kelompok bermain lainnya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="n-content hide" data-id="post">
                        <h2>Posyandu adalah jenis pelayanan kepada anak berupa penimbangan untuk memantau pertumbuhan anak. Manfaat Posyandu ialah memberikan layanan kesehatan ibu dan anak, KB, imunisasi, gizi, dan penanggulangan diare.</h2>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="post-content">
                                    <div class="bg-post">
                                        <ion-icon name="barbell-outline"></ion-icon>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="text-box">
                                    <h2>Penimbangan Balita</h2>
                                    <p>Penimbangan balita dilakukan tiap bulan di posyandu. Penimbangan secara rutin di posyandu untuk pemantauan pertumbuhan .</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="post-content">
                                    <div class="bg-post">
                                        <ion-icon name="basketball-outline"></ion-icon>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="text-box">
                                    <h2>Peningkatan Gizi</h2>
                                    <p>Dengan adanya posyandu yang sasaran utamanya bayi dan balita, sangat tepat untuk meningkatkan gizi balita.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="slide-box">
                    <div class="owl-carousel owl-theme">
                        <div class="item"><img src="{{asset('landing-page')}}/images/gambar1.jpg" alt=""></div>
                        <div class="item"><img src="{{asset('landing-page')}}/images/gambar2.jpg" alt=""></div>
                        <div class="item"><img src="{{asset('landing-page')}}/images/gambar3.jpg" alt=""></div>
                        <div class="item"><img src="{{asset('landing-page')}}/images/gambar4.jpg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="content-detail">
                    <ion-icon name="flower-outline"></ion-icon>
                    <h3>{{$total_posyandu}}</h3>
                    <p>Jumlah Posyandu</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="content-detail">
                    <ion-icon name="people-outline"></ion-icon>
                    <h3>{{$total_penduduk}}</h3>
                    <p>Jumlah Penduduk</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="content-detail">
                    <ion-icon name="contrast-outline"></ion-icon>
                    <h3>{{$total_kecamatan}}</h3>
                    <p>Jumlah Kecamatan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="content-detail">
                    <ion-icon name="code-outline"></ion-icon>
                    <h3>{{$total_desa}}</h3>
                    <p>Jumlah Desa</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tanya">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="img-box">
                    <img src="{{asset('landing-page')}}/images/tanya.png" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="text-box">
                    <h2>Pertanyaan Tentang <span>Posyandu</span></h2>
                    <p>Ketahui dan pahami berbagai istilah posyandu. Apabila masih ada yang ingin anda konsultasikan berkaitan dengan posyandu jangan sungkan untuk menghubungi tim support kami.</p>
                    <img src="{{asset('landing-page')}}/images/header_divider.png" alt="">
                    <ul>
                        <li>
                            <a href="#ask1" class="ask1" data-id="ask1" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">Apa peran kader posyandu ?
                                <ion-icon class="arrow-content" name="chevron-up-outline" data-id="ask1"></ion-icon>
                            </a>
                            <div class="collapse" id="ask1">
                                <div class="content-according">
                                    <p>Tugas-tugas kader posyandu diantaranya menyiapkan alat dan bahan atau materi penyuluhan yang dibutuhkan, mengundang dan menggerakkan masyarakat, melaksanakan pembagian tugas, yaitu menentukan pembagian tugas di antara kader posyandu, baik untuk persiapan maupun pelaksanaan kegiatan.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#ask2" class="ask1" data-id="ask2" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">Posyandu melayani apa saja ?
                                <ion-icon class="arrow-content" name="chevron-up-outline" data-id="ask2"></ion-icon>
                            </a>
                            <div class="collapse" id="ask2">
                                <div class="content-according">
                                    <p><b>Posyandu</b> memberikan layanan kesehatan ibu dan anak, KB, imunisasi, gizi, penanggulangan diare. Ibu: Pemeliharaan kesehatan ibu di posyandu, Pemeriksaan kehamilandan nifas, Pelayanan peningkatan gizi melalui pemberian vitamin dan pil penambah darah, Imunisasi TT untuk ibu hamil.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#ask3" class="ask1" data-id="ask3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">Apa arti Skdn dalam posyandu ?
                                <ion-icon class="arrow-content" name="chevron-up-outline" data-id="ask3"></ion-icon>
                            </a>
                            <div class="collapse" id="ask3">
                                <div class="content-according">
                                    <p><b>SKDN</b> adalah status gizi balita yang digambarkan dalam suatu balok SKDN, dimana balok tersebut memuat tentang sasaran balita di suatu wilayah (S), balita yang memiliki KMS (K), balita yang ditimbang berat badannya (D), balita yang ditimbang dan naik berat badannya (N)</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#ask4" class="ask1" data-id="ask4" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">Berapa macam posyandu ?
                                <ion-icon class="arrow-content" name="chevron-up-outline" data-id="ask4"></ion-icon>
                            </a>
                            <div class="collapse" id="ask4">
                                <div class="content-according">
                                    <p>Strata Posyandu
                                        <br>
                                        1. Posyandu Pratama.
                                        <br>
                                        2. Posyandu Madya.
                                        <br>
                                        3. Posyandu Purnama.
                                        <br>
                                        4. Posyandu Mandiri.
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection