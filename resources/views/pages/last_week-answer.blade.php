@extends('welcome')

@section('content')
<div class="content">
<div class="container">
<!-- /****START BASIC DATE SETUP***/ -->
   <?php
	date_default_timezone_set("Asia/Dhaka");
	$todaydate = date("Y-m-d");
	?>
	<form  method="POST">
	@csrf
	<div class="row">
	  <div class="col-md-2">
	  <p class="date"></p>
	  <button class="btn btn-primary" type="button" id="decrement"><i class="fa fa-arrow-left"></i></button>
	  <button class="btn btn-primary" type="button" id="increment"><i class="fa fa-arrow-right"></i></button>
	 </div>
	</div>
	</form>
<!-- /****END BASIC DATE SETUP***/ -->
<!-- /****START TEACHER TABLE DESIGN SETUP***/ -->
  <div class="row">
  <div class="col-md-12">
  <div class="panel panel-default">
	  <div class="panel-heading">
		  <h3 class="panel-title">Last Week Answer</h3>
		  </div>
	      <div class="panel-heading">
      <h3 class="panel-title"> <p class=""></p></h3>
      </div>
               
	<div class="panel-body">
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
			 <table id="my_table" class="table table-striped table-bordered">
			   <thead>
				    <tr>
              <th>SL</th>
				      <th>Name</th>
				      <th>Mobile</th>
              <th>Designation</th>
				      <th>Institute Name</th>
				      <th>Answer Count</th>
				    </tr>
			   </thead>
			   <tbody>
                  
			   </tbody>
			 </table>
		  </div>
		  </div>
		  </div>
    </div>
	</div>
	</div>





</div>
</div>



<!--Start Datatables-->
<script type="text/javascript">
  var table;
  jQuery(document).ready(function ($) {
    table = $('#my_table').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo route('ajax_data'); ?>",
        "type": "POST",
        "data": function(data) {
          data._token = "{{ csrf_token() }}";
          data.dates = $('.date').text();
        }
      },

      //Set column definition initialisation properties.
      "columnDefs": [
        {
          "targets": [0, -1], //first, second and last column
          "orderable": false, //set not orderable
        },
      ],

    });
    
    $('#search').on( 'click change', function (event) {
      event.preventDefault();
      table.draw();
      serach = 'SEARCH';
    });

  });

  function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
  }
</script>
<!--End Datatables-->



<script type="text/javascript">
	 $(document).ready(function (){
             var x = "{{$todaydate}}";
             $('.date').text(x);
         })
$(document).on('click','#decrement',function (){

             var val =  $('.date').text();

             $.ajax({
                 url: "{{route('weekly-decrement')}}",
                 type: "post",
                 data: {
                     "_token": "{{ csrf_token() }}",
                     "id": val
                 },
                 success: function (data) {
                   $('.date').text(data);

                      reload_table();

                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                     console.log(textStatus, errorThrown);
                 }
             });

         })
$(document).on('click','#increment',function (){

             var val =  $('.date').text();

             $.ajax({
                 url: "{{route('weekly-increment')}}",
                 type: "post",
                 data: {
                     "_token": "{{ csrf_token() }}",
                     "id": val
                 },
                 success: function (data) {
                   $('.date').text(data);

                     reload_table();

                 },
                 error: function(jqXHR, textStatus, errorThrown) {
                     console.log(textStatus, errorThrown);
                 }
             });

         })

	   
    
</script>
 @endsection
     