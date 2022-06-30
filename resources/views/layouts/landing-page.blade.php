<?php

use Illuminate\Support\Facades\DB;

$website = DB::table('tb_website')->where('id', 1)->first();

// dd($website);
?>
<!doctype html>
<html lang="en">

<head>
    @include('includes.landing-page.style')

</head>
<style>
    .hide {
        display: none;
    }

    .show {
        display: block;
    }

    .active {
        background: #ffff;
    }
</style>

<body>
    <div class="bg-header">
        @include('includes.landing-page.navbar')
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="text-box">
                            <h2 id="name_website_d">{{$website->judul}}</h2>
                            <p id="keterangan_d">{{$website->keterangan}}</p>
                            <a href="#" class="btn">Detail Posyandu</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="img-box" id="baner_d">
                            <img src="storage/website/baner.webp" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="sci">
            <li><a href="#"><img src="{{asset('landing-page')}}/images/facebook.png" alt=""></a></li>
            <li><a href="#"><img src="{{asset('landing-page')}}/images/instagram.png" alt=""></a></li>
            <li><a href="#"><img src="{{asset('landing-page')}}/images/twitter.png" alt=""></a></li>
        </ul>
    </div>

    @yield('content')

    @include('includes.landing-page.scripts')
</body>

</html>