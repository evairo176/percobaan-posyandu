<!DOCTYPE html>
<html lang="en">

<head>

    @include('includes.backend.style')

    @stack('add-styles')
</head>

<body class="sidebar-noneoverflow">
    <!--  BEGIN NAVBAR  -->
    @include('includes.backend.navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <!--  BEGIN SIDEBAR  -->
        @if(Auth::user()->role=='super-admin')
        @include('includes.backend.sidebar')
        @else
        @include('includes.backend.sidebarpetugas') 
        @endif
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    @yield('content')
                </div>
            </div>
            @include('includes.backend.footer')
        </div>
        <!--  END CONTENT AREA  -->


    </div>
    <!-- END MAIN CONTAINER -->

    @include('includes.backend.scripts')
    @stack('add-scripts')


</body>

</html>