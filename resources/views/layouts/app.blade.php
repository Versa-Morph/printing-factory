<!doctype html>
<html lang="en">

    <head>
        @include('layouts.partials.head')
    </head>

    <body data-topbar="dark" data-sidebar-size="lg" data-bs-theme="dark" data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">
        
        {{-- headeer  --}}
        @include('layouts.partials.header')

        <!-- ========== Left Sidebar Start ========== -->
       
        <!-- Left Sidebar End -->
        @include('layouts.partials.sidebar')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @include('layouts.alert')
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            {{-- FOOTER  --}}
            @include('layouts.partials.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.partials.right-sidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

   
    {{-- FOOT  --}}
    @include('layouts.partials.foot')
    </body>

</html>