@extends('layouts.landing-page')

@section('content')

<!-- konten  -->
<section class="manfaat">
    <div class="container">
        <div class="title-header">
            <h2>Manfaat Posyandu <span>Rutin</span></h2>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id temporibus voluptatem quisquam, suscipit optio distinctio tenetur dolore enim impedit quo eligendi veniam esse repellat ipsam.</p>
            <img src="{{asset('landing-page')}}/images/header_divider.png" alt="">
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-manfaat">
                    <div class="text-center">
                        <div class="bg-manfaat">
                            <ion-icon name="basketball-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="content">
                        <h2>Morbi Etos</h2>
                        <p>Praesent interdum est gravida vehicula est node maecenas loareet morbi a dosis luctus novum est praesent.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-manfaat">
                    <div class="bg-manfaat2">
                        <ion-icon name="basketball-outline"></ion-icon>
                    </div>
                    <div class="content">
                        <h2>Morbi Etos</h2>
                        <p>Praesent interdum est gravida vehicula est node maecenas loareet morbi a dosis luctus novum est praesent.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-manfaat">
                    <div class="bg-manfaat3">
                        <ion-icon name="basketball-outline"></ion-icon>
                    </div>
                    <div class="content">
                        <h2>Morbi Etos</h2>
                        <p>Praesent interdum est gravida vehicula est node maecenas loareet morbi a dosis luctus novum est praesent.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card-manfaat">
                    <div class="bg-manfaat4">
                        <ion-icon name="basketball-outline"></ion-icon>
                    </div>
                    <div class="content">
                        <h2>Morbi Etos</h2>
                        <p>Praesent interdum est gravida vehicula est node maecenas loareet morbi a dosis luctus novum est praesent.</p>
                    </div>
                </div>
            </div>
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
                            <a href="javascript:void(0)" class="btn-overview active" data-id="overview">Overview</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="btn-mission" data-id="mission">Mission</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="btn-post" data-id="post">post</a>
                        </li>
                    </ul>
                    <div class="n-content" data-id="overview">
                        <h2>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi a obcaecati ex dolore labore quisquam accusantium dolores tempore consequatur dicta in necessitatibus ullam architecto fugiat, maxime amet mollitia quidem explicabo!</h2>
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
                                    <h2>Full Day Sessions</h2>
                                    <p>The cushion is a meter around the world maecenas copper pregnant. Maecenas node estibulum.</p>
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
                                    <h2>Full Day Sessions</h2>
                                    <p>The cushion is a meter around the world maecenas copper pregnant. Maecenas node estibulum.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="n-content hide" data-id="mission">
                        <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus sunt, illum tempora deleniti quas voluptates laborum ut nihil soluta exercitationem velit consequuntur possimus, natus itaque, id dolore ex odio modi?</h2>
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
                                    <h2>Full Day Sessions</h2>
                                    <p>The cushion is a meter around the world maecenas copper pregnant. Maecenas node estibulum.</p>
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
                                    <h2>Full Day Sessions</h2>
                                    <p>The cushion is a meter around the world maecenas copper pregnant. Maecenas node estibulum.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="n-content hide" data-id="post">
                        <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto non labore reprehenderit atque! Nostrum, harum fugit! Cumque voluptatem, maiores maxime aut asperiores, quidem dicta dolorum ut molestias excepturi voluptas est.</h2>
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
                                    <h2>Full Day Sessions</h2>
                                    <p>The cushion is a meter around the world maecenas copper pregnant. Maecenas node estibulum.</p>
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
                                    <h2>Full Day Sessions</h2>
                                    <p>The cushion is a meter around the world maecenas copper pregnant. Maecenas node estibulum.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="slide-box">
                    <div class="owl-carousel owl-theme">
                        <div class="item"><img src="{{asset('landing-page')}}/images/no_image.jpg" alt=""></div>
                        <div class="item"><img src="{{asset('landing-page')}}/images/no_image.jpg" alt=""></div>
                        <div class="item"><img src="{{asset('landing-page')}}/images/no_image.jpg" alt=""></div>
                        <div class="item"><img src="{{asset('landing-page')}}/images/no_image.jpg" alt=""></div>
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
                    <ion-icon name="diamond-outline"></ion-icon>
                    <h3>18+</h3>
                    <p>Years Experience</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="content-detail">
                    <ion-icon name="diamond-outline"></ion-icon>
                    <h3>18+</h3>
                    <p>Years Experience</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="content-detail">
                    <ion-icon name="diamond-outline"></ion-icon>
                    <h3>18+</h3>
                    <p>Years Experience</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="content-detail">
                    <ion-icon name="diamond-outline"></ion-icon>
                    <h3>18+</h3>
                    <p>Years Experience</p>
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
                    <h2>We Are Top Ranked & Dedicated <span>SEO Company</span></h2>
                    <p>As opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text.</p>
                    <img src="{{asset('landing-page')}}/images/header_divider.png" alt="">
                    <ul>
                        <li>
                            <a href="#ask1" class="ask1" data-id="ask1" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">Pertanyaan pertama apa saja ?
                                <ion-icon class="arrow-content" name="chevron-up-outline" data-id="ask1"></ion-icon>
                            </a>
                            <div class="collapse" id="ask1">
                                <div class="content-according">
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo iste, facere voluptatibus architecto placeat blanditiis culpa nulla deleniti tempore aliquam corrupti cum doloremque magni vitae beatae ratione numquam assumenda corporis perferendis? Facere illo obcaecati hic nostrum. Consequatur temporibus autem debitis unde dignissimos fugiat mollitia. Consectetur.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#ask2" class="ask1" data-id="ask2" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">Pertanyaan pertama apa saja ?
                                <ion-icon class="arrow-content" name="chevron-up-outline" data-id="ask2"></ion-icon>
                            </a>
                            <div class="collapse" id="ask2">
                                <div class="content-according">
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo iste, facere voluptatibus architecto placeat blanditiis culpa nulla deleniti tempore aliquam corrupti cum doloremque magni vitae beatae ratione numquam assumenda corporis perferendis? Facere illo obcaecati hic nostrum. Consequatur temporibus autem debitis unde dignissimos fugiat mollitia. Consectetur.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#ask3" class="ask1" data-id="ask3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">Pertanyaan pertama apa saja ?
                                <ion-icon class="arrow-content" name="chevron-up-outline" data-id="ask3"></ion-icon>
                            </a>
                            <div class="collapse" id="ask3">
                                <div class="content-according">
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo iste, facere voluptatibus architecto placeat blanditiis culpa nulla deleniti tempore aliquam corrupti cum doloremque magni vitae beatae ratione numquam assumenda corporis perferendis? Facere illo obcaecati hic nostrum. Consequatur temporibus autem debitis unde dignissimos fugiat mollitia. Consectetur.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#ask4" class="ask1" data-id="ask4" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">Pertanyaan pertama apa saja ?
                                <ion-icon class="arrow-content" name="chevron-up-outline" data-id="ask4"></ion-icon>
                            </a>
                            <div class="collapse" id="ask4">
                                <div class="content-according">
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo iste, facere voluptatibus architecto placeat blanditiis culpa nulla deleniti tempore aliquam corrupti cum doloremque magni vitae beatae ratione numquam assumenda corporis perferendis? Facere illo obcaecati hic nostrum. Consequatur temporibus autem debitis unde dignissimos fugiat mollitia. Consectetur.</p>
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