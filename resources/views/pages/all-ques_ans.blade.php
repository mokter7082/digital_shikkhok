@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
                      <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Question And Answer</h3>
                                  </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="my_table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th>Question</th>
                                                  <th>Ans</th>
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

</div> <!-- container -->
</div>

<!--START AJAX SERVERSITE DATATABLE-->
<script type="text/javascript">
  var table;
  jQuery(document).ready(function ($) {
    table = $('#my_table').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo route('ques_and_ans_data'); ?>",
        "type": "POST",
        "data": function(data) {
          data._token = "{{ csrf_token() }}";
          data.dates = $('.date').text();
        }
      },

      //Set column definition initialisation properties.
      "columnDefs": [
        {
          "targets": [0, 1, -1], //first, second and last column
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
<!--END SERVERSITE DATATABLE-->
@endsection
