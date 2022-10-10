@include('layouts.includes.header')


    <body data-sidebar="dark" style="scroll-behavior: smooth">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <!-- Top bar -->
            @include('layouts.includes.topbar')

            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.includes.sidebar')
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            @include('layouts.includes.maincontent')
            <!-- end main content-->

            <!-- Right Sidebar -->
            @yield('rightsidebar')
            <!-- ============================================================== -->
            <!-- End right Sidebar Here -->
        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
        <!-- Footer -->
        @include('sweetalert::alert')
@include('layouts.includes.footer')
