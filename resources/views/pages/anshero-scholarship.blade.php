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

                                  <?php 
                                        // $custom_date = date('Y-m-d');
                                        // $custom_date = explode('-',$custom_date);
                                        // $custome_year = $custom_date[0];
                                        // $custome_month = $custom_date[1];
                                        // $custome_day = $custom_date[2];
                                        // $final_date = $custome_year.'-'.$custome_month.'-'.'20';
    

                                          
                                    $all_s = DB::select("SELECT DISTINCT
                                            COUNT( ans.user_id ) AS answered,
                                            scolarship.`id`,
                                            scolarship.`user_id`,
                                            scolarship.`name`,
                                            users.`email`,
                                            scolarship.mobile,
                                            scolarship.`ans`,
                                            scolarship.`status`,
                                            max( ans.date ) `date` 
                                            FROM
                                            scolarship
                                            JOIN ans ON ans.user_id = scolarship.user_id 
                                            JOIN users ON users.id = scolarship.user_id
                                            WHERE
                                            date( ans.date ) >= '2021-04-20' 
                                            GROUP BY
                                            scolarship.`id`,
                                            scolarship.`user_id`,
                                            scolarship.`name`,
                                            users.`email`,
                                            scolarship.mobile,
                                            scolarship.`ans`,
                                            scolarship.`status` 
                                            ORDER BY
                                            answered DESC");
                                  // dd($all_s)
                     
                                                            
                                 

                                  ?>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Mobile</th>
                                                  <th>Answer</th>
                                                  <th>date</th>
                                                  <th>Ques Count</th>
                                                  <th>Action</th>
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                    @foreach($all_s  as $val)
                                                        <tr>
                                                            <td>{{$val->user_id}}</td>
                                                            <td>{{$val->name}}</td>
                                                            <td>{{$val->email}}</td>
                                                            <td>{{$val->mobile}}</td>
                                                            <td>{{$val->ans}}</td>
                                                            <td>{{$val->date}}</td>
                                                            <td>{{$val->answered}}</td>
                                                            
                                                            <!-- <td>{{isset($q_q[$val->user_id])?$q_q[$val->user_id]:0}}</td> -->
                                                            <td>
                                                              @if($val->status == 'আপনার আবেদনটি নিশ্চিত করা হয়েছে')
                                                               <button type="submit" id="verified_{{$val->id}}" class="btn btn-primary btn-sm" onclick="verification({{$val->id}})">আপনার আবেদনটি নিশ্চিত করা হয়েছে</button>
                                                              @else
                                                               <button type="submit" id="verified_{{$val->id}}" class="btn btn-danger btn-sm" onclick="verification({{$val->id}})">আপনার আবেদন পর্যালোচনা অধীন</button>
                                                              @endif
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

                      </div>

</div> <!-- container -->
</div>
<!-- Teacher Verified Not_veryfied form database with jquery -->
<script type="text/javascript">

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
