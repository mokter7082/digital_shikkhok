@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
                      <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Bangla Question</h3>
                                  </div>
                                  <div class="panel-heading">
                                    @php
                                      $count_bangla_ques = DB::select("SELECT * FROM `post_q` WHERE `subject` = 'bangla' AND (`status` = 0 OR `status` = 2)");
                                      $bangla_count = count($count_bangla_ques);
                                       @endphp
                                      <h3 class="panel-title">Total Bangla Pending Question ={{$bangla_count}} </h3>
                                  </div>
                          <?php                           
                              $l_user_id = Session::get('user_id');
                              $institutionname = Session::get('institutionname');
                              $username = Session::get('name');
                              date_default_timezone_set("Asia/Dhaka");
                              $todaydate = date("Y-m-d");
                          ?>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                 <th>ID</th>
                                                 <th>Question</th>
                                                 <th>Date</th>
                                                 <th>Subject</th>
                                                 <th>Answer</th>
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                    @foreach($bangla_sub as $val)
                                                     <tr id="rowid_{{$val->id}}" data-id="{{$val->id}}">
                                                        <input type="hidden" value="{{$val->id}}" id="userId">
                                                        <td>{{$val->id}}</td>
                                                        <td id="q">
                                                        {{$val->quens}}
                                                         @if($val->status == 0)
                                                          <p id="a">No answers yet</p>
                                                          @elseif($val->status == 2)
                                                          <p>Someone is answering this question</p>
                                                          @else
                                                          @endif  
                                                            <input type="hidden" name="a_id" value="{{$val->id}}">
                                                            @if($val->status == 0)
                                                            <button class="btn btn-warning btn-sm edit" id="ans{{$val->id}}">I am Answering</button>
                                        
                                                             @elseif($val->status == 1)
                                                             @else
                                                             @endif
                                                        </td>
                                                        <td>{{$val->date}}</td>
                                                        <td>{{$val->subject}}</td>
                                                        <td>
                                                            <form method="post" class="sub" enctype="multipart/form-data">
                                                            @csrf
                                                              <input type="hidden" class="id_i" name="id" value="{{$val->id}}">
                                                              <input type="hidden" name="post_user_id" id="post_user_id_{{$val->id}}" value="{{$val->user_id}}">
                                                              <textarea class="form-control" name="ans" id="ans_{{$val->id}}" rows="3" cols="30" placeholder="Write Answer Here" required></textarea>
                                                              <input name="image" type="file" id="image_{{$val->id}}" />
                                                              <input type="hidden" name="user_id" id="l_user_id_{{$val->id}}" value="{{$l_user_id}}">
                                                              <input type="hidden" name="username" id="username_{{$val->id}}" value="{{$username }}">
                                                              <input type="hidden" name="subject" id="subject_{{$val->id}}" value="{{$val->subject}}">
                                                              <input type="hidden" name="date" id="date_{{$val->id}}" value="{{$todaydate}}">
                                                              <input type="hidden" name="institutionname" id="institutionname_{{$val->id}}" value="{{$institutionname}}">
                                                              <button style="margin-top:2px; border-radius:10px;" type="submit" class="btn btn-sm btn-success">Submit</button>
                                                              </form>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
  




    //*****update data******/
    

    $('.edit').on('click',function(){
       var id = $(this).parents('tr').find('#userId').val();
       //alert(id);
       $.ajax({
        type: "get",
        url: '{{url('answering')}}/' + id,
        dataType: "json",
        success: function(data){
            console.log(data);
           $("#ans"+id).text('Someone is answering this question'); 
           $("#ans"+id).removeClass("btn-warning");
           $("#ans"+id).removeClass("btn"); 
           $("#a").remove();
        }
    });
    })

    $('.sub').submit(function(e) {
       e.preventDefault();
       var id = $(this).parents('tr').find('#userId').val();
         //alert(id); return;
       let formData = new FormData(this);
       $.ajax({
          type:'POST',
          url: '{{url('a_insert')}}',
           data: formData,
           contentType: false,
           processData: false,
           success:function(data){
             console.log(data);
             if(data.data===true) {
              $("#rowid_"+id).hide();
            }else if(data.data===null){
              $("#rowid_"+id).hide();
            }
             
        },
       });
  });

      //      $(document).ready(function(){  
      //      $('#search').keyup(function(){  
      //           search_table($(this).val());  
      //      });  
      //      function search_table(value){  
      //           $('#value_serch tr').each(function(){  
      //                var found = 'false';  
      //                $(this).each(function(){  
      //                     if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)  
      //                     {  
      //                          found = 'true';  
      //                     }  
      //                });  
      //                if(found == 'true')  
      //                {  
      //                     $(this).show();  
      //                }  
      //                else  
      //                {  
      //                     $(this).hide();  
      //                }  
      //           });  
      //      }  
      // });  



</script>


@endsection
