@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
                      <div class="col-md-12">
                              <div class="panel panel-default">
    
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
                                              <th>Date</th>
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



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Referred Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <table class="table table-bordered" border="1pt solid ash" style="font-family: arial; color:black; border-collapse: collapse;">
              <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Date</th>
              </thead>
              <tbody id="my-data">

              </tbody>
             </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<!-- Teacher Verified Not_veryfied form database with jquery -->
<!--START AJAX SERVERSITE DATATABLE-->
<script type="text/javascript">
  var table;
  jQuery(document).ready(function ($) {
    table = $('#my_table').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.
      // Load data for the table's content from an Ajax source
      pageLength: 0,
      lengthMenu: [10, 50, 100, 500, 1000,5000,10000,25000],
      "ajax": {
        "url": "<?php echo route('studentData'); ?>",
        "type": "POST",
        "data": function(data) {
          data._token = "{{ csrf_token() }}";
          // data.dates = $('.date').text();
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




//find reerall users
  function refer(id){
    toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
  	     	toastr.success("Please Wait few minutes.");
     $.ajax({
            url: '<?php echo URL::to('student-refar');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            console.log(html);
            $("#my-data").html("");
          $.each(html, function(index, val) {
                $("#my-data").append('<tr><td>'+ val.id +'</td> <td>'+ val.name +'</td><td>'+ val.mobile +'</td> <td>'+ val.date +'</td> </tr>');
             });
             $("#myModal").modal("show");
            }
          });
  }
  //end refaral users
  //start student block
   function s_delete(id){
      //  alert(id);
      $('.delete').click(function(){
        swal({   
            title: "Are you sure?",   
            text: "Delete this Student!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete ",   
            closeOnConfirm: false 
        }, function(){ 
          $.ajax({
            url: '<?php echo URL::to('student-delete');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            console.log(html);
             reload_table()
            }
          });  
            swal("Deleted!", "Your Student delete successfull.", "success"); 
        });
    });
  }
  //end student block
  //start student block
  function student_block(id){
        var bclass = $("#s_block"+id).hasClass("btn-danger");
        //alert(bclass);
        if($("#s_block"+id).hasClass("btn-danger")){
          $.ajax({
            url: '<?php echo URL::to('student-block');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
            $("#s_block"+id).text('Unblock'); //versions newer than 1.6
            $("#s_block"+id).removeClass("btn-danger");
            $("#s_block"+id).addClass("btn-warning");
            }
          });
        }else {
          $.ajax({
            url: '<?php echo URL::to('student-unblock');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
             $("#s_block"+id).text('Block'); //versions newer than 1.6
             $("#s_block"+id).removeClass("btn-warning");
             $("#s_block"+id).addClass("btn-danger");
            }
          });
        }
  }
  //end student block
</script>
<!--END SERVERSITE DATATABLE-->
@endsection

