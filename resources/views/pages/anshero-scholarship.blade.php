@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
                      <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Answer Hero Scholarship</h3>
                                  </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="my_table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Mobile</th>
                                                  <th>Answer</th>
                                                  <th>date</th>
                                            
                                                  <th>Action</th>
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
<!-- Teacher Verified Not_veryfied form database with jquery -->
<script type="text/javascript">
  var table;
  jQuery(document).ready(function ($) {
    table = $('#my_table').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "pageLength":50,
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo route('anshero_acholarship_data'); ?>",
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




  function verification(id){
        var bclass = $("#verified_"+id).hasClass("btn-primary");
        //alert(bclass);
        if($("#verified_"+id).hasClass("btn-primary")){
          $.ajax({
            url: '<?php echo URL::to('scholarship-not_verified');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
            $("#verified_"+id).text('আপনার আবেদন পর্যালোচনা অধীন'); //versions newer than 1.6
            $("#verified_"+id).removeClass("btn-primary");
            $("#verified_"+id).addClass("btn-danger");
            }
          });
        }else {
          $.ajax({
            url: '<?php echo URL::to('scholarship-verified');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
            // alert("#verified_"+id);
             $("#verified_"+id).text('আপনার আবেদনটি নিশ্চিত করা হয়েছে'); //versions newer than 1.6
             $("#verified_"+id).removeClass("btn-danger");
             $("#verified_"+id).addClass("btn-primary");
            }
          });
        }
  }

 function t_delete(id){
      // var t_td = (id);
      $('.delete').click(function(){
        swal({   
            title: "Are you sure?",   
            text: "Delete this teacher!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete ",   
            closeOnConfirm: false 
        }, function(){ 
          $.ajax({
            url: '<?php echo URL::to('teacher-delete');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            console.log(html);
            $("#tr-"+id).remove();
            }
          });  
            swal("Deleted!", "Your teacher delete successfull.", "success"); 
        });
    });

       
        
 }


</script>
@endsection
