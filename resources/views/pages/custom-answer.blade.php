@extends('welcome')

@section('content')
<div class="content">
<div class="container">

   <div class="row">
     
       
     <div class="col-md-2">
       <label for="">Start Date</label>
       <input class="form-control" type="date" id="start_date" value="">
       <label for="">End Start</label>
       <input class="form-control" type="date" id="end_date" value="">
       <button style="margin-top: 2px;" class="btn btn-primary btn-sm pull-right" id="search">Search</button>
      
      </div>
   </div>

<!-- /****END BASIC DATE SETUP***/ -->
<!-- /****START CUSTOM QUESTIONS TABLE DESIGN SETUP***/ -->
  <div class="row">
  <div class="col-md-12">
  <div class="panel panel-default">               
    <div class="panel-body">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
             <table id="my_table" class="table table-striped table-bordered my_table">
               <thead>
                    <tr>
                      <th>Ques ID</th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Date</th>
                      <th>Questions</th>
                      <th>Answer</th>
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


<script type="text/javascript">
  var table;
  jQuery(document).ready(function ($) {
    table = $('#my_table').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "pageLength":10,
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo route('date-custom_answer'); ?>",
        "type": "POST",
        "data": function(data) {
          data._token = "{{ csrf_token() }}";
          data.start_date = $("#start_date").val();
          data.end_date = $("#end_date").val();
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
 @endsection
     