
        <script>
            var resizefunc = [];
        </script>

         
        <script src="{{url('js/waves.js')}}"></script>
        <script src="{{url('js/wow.min.js')}}"></script>
        <script src="{{url('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
        <script src="{{url('js/jquery.scrollTo.min.js')}}"></script>
        <script src="{{url('assets/chat/moment-2.2.1.js')}}"></script>
        <script src="{{url('assets/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        <script src="{{url('assets/jquery-detectmobile/detect.js')}}"></script>
        <script src="{{url('assets/fastclick/fastclick.js')}}"></script>
        <script src="{{url('assets/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
        <script src="{{url('assets/jquery-blockui/jquery.blockUI.js')}}"></script>

        <!-- sweet alerts -->
        <script src="{{url('assets/sweet-alert/sweet-alert.min.js')}}"></script>
        <script src="{{url('assets/sweet-alert/sweet-alert.init.js')}}"></script>

        <!-- flot Chart -->
        <script src="{{url('assets/flot-chart/jquery.flot.js')}}"></script>
        <script src="{{url('assets/flot-chart/jquery.flot.time.js')}}"></script>
        <script src="{{url('assets/flot-chart/jquery.flot.tooltip.min.js')}}"></script>
        <script src="{{url('assets/flot-chart/jquery.flot.resize.js')}}"></script>
        <script src="{{url('assets/flot-chart/jquery.flot.pie.js')}}"></script>
        <script src="{{url('assets/flot-chart/jquery.flot.selection.js')}}"></script>
        <script src="{{url('assets/flot-chart/jquery.flot.stack.js')}}"></script>
        <script src="{{url('assets/flot-chart/jquery.flot.crosshair.js')}}"></script>

        <!-- Counter-up -->
        <script src="{{url('assets/counterup/waypoints.min.js')}}" type="text/javascript"></script>
        <script src="{{url('assets/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

        <!-- CUSTOM JS -->
        <script src="{{url('js/jquery.app.js')}}"></script>

        <!-- Dashboard -->
        <script src="{{url('js/jquery.dashboard.js')}}"></script>

        <!-- Chat -->
        <script src="{{url('js/jquery.chat.js')}}"></script>

        <!-- Todo -->
        <script src="{{url('js/jquery.todo.js')}}"></script>




   

        <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').dataTable({
                lengthMenu: [
                    [ 10, 25, 50,100,500 ],
                    [ '10', '25', '50','100','500' ]
                ],
            });
        } );
            /* ==============================================
            Counter Up
            =============================================== */

            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
        </script>

    </body>
</html>
