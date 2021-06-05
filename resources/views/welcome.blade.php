@include('fileInclude.headerArea')

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            @include('fileInclude.topbarArea')
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            @include('fileInclude.leftsidebarArea')
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                  @yield('content')
               <!-- content -->

               

            </div>

            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->

            <!-- /Right-bar -->

        </div>
      <!--        <footer class="footer text-right">
                    2021 © Copy Right By Digital Shikkhok.
            </footer> -->
        <!-- END wrapper -->
        @include('fileInclude.footerArea')
