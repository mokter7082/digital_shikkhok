@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
             @php
             $teacher = Session::get('type')  
             @endphp
             @if($teacher == '1') 
                      <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">All Answear</h3>
                                  </div>

                            <div class="panel-body">
                                <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                   <!-- <button type="button" onclick="reload_table();">Reload</button> -->
                                        <table id="my_table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>User Name</th>
                                                    <th>Answear</th>
                                                    <th>Subject</th>
                                                    <th>Date</th>
                                                    <th>Institution Name</th>
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
                        @elseif($teacher == '3')
                         <div class="col-md-12">
                              <div class="panel panel-default">
                            @php
                            ini_set('memory_limit', '-1');
                            ini_set('max_execution_time', '0');
                            $all_ans = DB::table('ans')->orderBy('date','DESC')->get();
                            @endphp

                            <div class="panel-body">
                                <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                   <!-- <button type="button" onclick="reload_table();">Reload</button> -->
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>User Name</th>
                                                    <th>Answear</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             @foreach($all_ans as $val)
                                                      <tr id = "tr-{{$val->id}}">
                                  
                                                      <td>{{$val->user_name}}</td>
                                                      <td>{{$val->ans}}</td>
                                                      <td>{{$val->date}}</td>
                                                       <td>
                                                              <button type="submit" class="btn btn-danger btn-sm delete" id="a_delete{{$val->id}}" onclick="a_delete({{$val->id}})">Delete</button>
                                                            </td>
                                            
                                                        </tr>
                                                     @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                </div>
                                </div>
                        </div>
                        </div>
                         @elseif($teacher == '4')
                        
                         <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">All Answear</h3>
                                  </div>

                            <div class="panel-body">
                                <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                   <!-- <button type="button" onclick="reload_table();">Reload</button> -->
                                        <table id="my_table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Ques ID</th>
                                                    <th>User Name</th>
                                                    <th>Mobile</th>
                                                    <th>Answear</th>
                                                    <th>Subject</th>
                                                    <th>Date</th>
                                                    <th>Designation</th>
                                                    <th>Institution Name</th>
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
                        @elseif($teacher == '5')
                           <div class="col-md-12">
                              <div class="panel panel-default">
                            @php
                            ini_set('memory_limit', '-1');
                            ini_set('max_execution_time', '0');
                            $all_ans = DB::table('ans')->orderBy('date','DESC')->get();
                            @endphp

                            <div class="panel-body">
                                <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                   <!-- <button type="button" onclick="reload_table();">Reload</button> -->
                                        <table id="" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>User Name</th>
                                                    <th>Answear</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             @foreach($all_ans as $val)
                                                      <tr id = "tr-{{$val->id}}">
                                  
                                                      <td>{{$val->user_name}}</td>
                                                      <td>{{$val->ans}}</td>
                                                      <td>{{$val->date}}</td>
                                                       <td>
                                                              <button type="submit" class="btn btn-danger btn-sm delete" id="a_delete{{$val->id}}" onclick="a_delete({{$val->id}})">Delete</button>
                                                            </td>
                                            
                                                        </tr>
                                                     @endforeach
                                            </tbody>
                                        </table>
                                </div>
                                </div>
                                </div>
                        </div>
                        </div>
                        @elseif($teacher == '6')
                        <!--  editor -->
                        
                         <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">All Answear</h3>
                                  </div>

                            <div class="panel-body">
                                <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                   <!-- <button type="button" onclick="reload_table();">Reload</button> -->
                                        <table id="my_table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Ques ID</th>
                                                    <th>User Name</th>
                                                    <th>Answear</th>
                                                    <th>Subject</th>
                                                    <th>Date</th>
                                                    <th>Designation</th>
                                                    <th>Institution Name</th>
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
                        @else
                        @endif
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
        "url": "<?php echo route('all_answer_data'); ?>",
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
</script>
<!--END SERVERSITE DATATABLE-->

<!--START ANSWER DELETE BY AJAX-->
<script type="text/javascript">

 function a_delete(id){
      // var t_td = (id);
      $('.delete').click(function(){
        swal({   
            title: "Are you sure?",   
            text: "Delete this Ans!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete ",   
            closeOnConfirm: false 
        }, function(){ 
          $.ajax({
            url: '<?php echo URL::to('ans-delete');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            console.log(html);
            //$("#tr-"+id).remove();
            reload_table();
            }
          });  
            swal("Deleted!", "Your Ans delete successfull.", "success"); 
        });
    });       
 }
</script>
<!--END ANSWER DELETE BY AJAX-->
@endsection
