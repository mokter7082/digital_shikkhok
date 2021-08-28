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
@include('modal.student-refer')
@include('modal.edit-student')







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
                $("#my-data").append('<tr><td>'+ val.id +'</td> <td>'+ val.name +'</td><td>'+ val.email +'</td> <td>'+ val.mobile +'</td><td>'+ val.institutionname +'</td> <td>'+ val.date +'</td> </tr>');
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
//start edite student from here
  function studentEdit (id){
    toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
  	     	toastr.success("Please Wait few minutes.");
     $.ajax({
            url: '<?php echo URL::to('edit-student');?>',
            method: 'POST',
            data: {
                  "_token": "{{ csrf_token() }}",
                  "id": id
                  },
            cache: false,
            success: function(html){
             $("#editModal").modal("show");
             $('#id').val(html.id);
             $('#name').val(html.name);
             $('#email').val(html.email);
             $('#mobile').val(html.mobile);
             $('#insName').val(html.institutionname);
            }
          });
  }
  // end edite student from here
  function studentUpdate(){
    toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
  	     	toastr.success("Updating");
    var id=$("#id").val();
    var name=$("#name").val();
    var email=$("#email").val();
    var mobile=$("#mobile").val();
    var insName=$("#insName").val();
    // alert(name);
     $.ajax({
            type: 'post',
            url: '<?php echo URL::to('update-student');?>',
            data:{
             "id":id,
             "name":name,
             "email":email,
             "mobile":mobile,
             "insName":insName,
             "_token": "{{ csrf_token() }}"  
        },
            success: function (response ) {
              console.log(response);
              if(response.status===200) {
                // loop through all modal's and call the Bootstrap
                // modal jQuery extension's 'hide' method
                //$("#answer_td_"+id).html(ans);
                $('.modal').each(function(){
                    $(this).modal('hide');
                });
                reload_table()
                console.log('success');
            } else {
                console.log('failure');
            }
                
            }
        });
  }
</script>
<!--END SERVERSITE DATATABLE-->
@endsection

