@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
    <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Leader Board</h3>
                    <h3 class="panel-title">All Teachers</h3>
                </div>  
                <h4 class="show text-success text-center" id="hide"></h4> 
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                                <th>Point</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                                <tbody>
                                <tr>
                                @foreach($all_teacher as $val)
                                    <td>{{$val->id}}</td>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->mobile}}</td>
                                    <td>
                                      <div class="form-group col-xs-6">
                                          <div class="row">
                                          <p id="point_td_{{$val->id}}" class="font-weight-bold">{{$val->points}}</p>
                                          <input class="form-control col-sm-1 inp" id="point_{{$val->id}}" type="text" name="point">
                                          </div>
                                    </div>
                                 </td> 
                                 <td><button type="submit" class="btn btn-sm btn-purple waves-effect waves-light" id="p_update{{$val->id}}" onclick="p_update({{$val->id}})">Update</button></td>                              
                                 </tr>
                                @endforeach
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
<script type="text/javascript">

 function p_update(id){
       var t_id = (id);

       var point = $("#point_"+id).val();
       var data_text = $(this).closest('tr').find('td:nth-child(5)').html();
       $.ajax({
            url: '<?php echo URL::to('t_point-update');?>',
            method: 'GET',
            data: {
                id:id,
                "point":point,
                "_token": "{{ csrf_token() }}"
                
                },
            cache: false,
            success: function(html){
            console.log(html);
            $("#point_td_"+id).html(point);
            $(".inp").val("");
            toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
  		toastr.success("Updated");
            }
          });    
 }

</script>
@endsection
