<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="{{asset('landing-page')}}/libraries/jquery/jquery-3.4.1.min.js"></script>
<script src="{{asset('landing-page')}}/libraries/bootstrap/js/bootstrap.js"></script>
<script src="{{asset('landing-page')}}/libraries/owl-corousel/dist/owl.carousel.js"></script>


<!-- librari iconic -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- chart  -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
<!-- script khusus  -->
<script>
    $(document).ready(function() {
        // function imgSlider(anything){
        //     document.querySelector('.starbucks').src = anything;
        // }
        window.addEventListener('scroll', function() {
            var header = document.querySelector('header');
            // var top_header = document.querySelector('.top-header');
            header.classList.toggle("sticky", window.scrollY > 0)
            // top_header.classList.toggle("sticky", window.scrollY > 0)
        })


        var menuToggle = document.querySelector('.toggle');
        var menuNavigation = document.querySelector('.navigation');
        // var tanyaToggle = document.querySelector('.ask1');
        // var tanyaArrow = document.querySelector('.arrow-content');

        // tanyaToggle.onclick = function() {
        //     tanyaArrow.classList.toggle('active');
        //     // menuNavigation.classList.toggle('active');
        // }
        // $('.toggle').on('click',function(){
        //     menuToggle.classList.toggle('active');
        // })
        menuToggle.onclick = function() {
            menuToggle.classList.toggle('active');
            menuNavigation.classList.toggle('active');
        }

        // add hovered class in select list item 
        let list = document.querySelectorAll('.navigation ul li a');

        function activeLink() {
            list.forEach((item) => {
                item.classList.remove('active');
                this.classList.add('active');
            });
        }
        list.forEach((item) => {
            item.addEventListener('mouseover', activeLink);
        });


        //klik 
        $('.btn-overview').click(function(e) {
            var dataid = $(this).data('id');
            $('.n-content').addClass('hide');
            $('.n-content[data-id="' + dataid + '"]').removeClass('hide');
            $('.btn-overview').addClass('active');
            $('.btn-mission').removeClass('active');
            $('.btn-post').removeClass('active');
        });
        $('.btn-mission').click(function(e) {
            var dataid = $(this).data('id');
            $('.n-content').addClass('hide');
            $('.n-content[data-id="' + dataid + '"]').removeClass('hide');
            $('.btn-mission').addClass('active');
            $('.btn-overview').removeClass('active');
            $('.btn-post').removeClass('active');
        });
        $('.btn-post').click(function(e) {
            var dataid = $(this).data('id');
            $('.n-content').addClass('hide');
            $('.n-content[data-id="' + dataid + '"]').removeClass('hide');
            $('.btn-post').addClass('active');
            $('.btn-overview').removeClass('active');
            $('.btn-mission').removeClass('active');
        });
        $('.ask1').click(function(e) {
            var dataid = $(this).data('id');
            // console.log(dataid);
            $('.arrow-content[data-id="' + dataid + '"]').toggleClass('active');
            // $('.arrow-content').removeClass('active');
        });

        //owl corousel 
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            center: true,
            autoWidth: false,
            // autoplay: true,
            // autoplayTimeout: 5000,
            navText: ["<i class=\"fas fa-arrow-circle-left\"></i>", "<i class=\"fas fa-arrow-circle-right\"></i>", ],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1,
                    nav: true
                }
            }
        })
    });
</script>