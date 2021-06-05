@extends('welcome')

@section('content')
<div class="content">
<div class="container">
  <div class="row">
                      <div class="col-md-12">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Question Approval</h3>
                                  </div>
                                  <div class="panel-heading">
                                    <?php
                                       $qus_approval = DB::table('question_approaval')->get();
                                       $all_qus_approv = count($qus_approval);
                                    ?>
                                      <h3 class="panel-title">Total Question = {{$all_qus_approv}}</h3>
                                  </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th class="text-center">Action</th>
                                              </tr>
                                          </thead>
                                                  <tbody>
                                                    @foreach($que_approval as $val)
                                                        <tr>
                                                            <td>{{$val->id}}</td>
                                                            <td class="text-center">
                                                              @if($val->is_approval_on == 0)
                                                               <button type="submit" id="approve_{{$val->id}}" class="btn btn-primary btn-sm" onclick="verification({{$val->id}})">Approval Enable </button>
                                                              @else
                                                               <button type="submit" id="approve_{{$val->id}}" class="btn btn-danger btn-sm" onclick="verification({{$val->id}})">Approval Disable</button>
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
<script type="text/javascript">

  function verification(id){
        var bclass = $("#approve_"+id).hasClass("btn-primary");
        //alert(bclass);
        if($("#approve_"+id).hasClass("btn-primary")){
          $.ajax({
            url: '<?php echo URL::to('approval-anable');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
            $("#approve_"+id).text('Approval Disable'); //versions newer than 1.6
            $("#approve_"+id).removeClass("btn-primary");
            $("#approve_"+id).addClass("btn-danger");
            }
          });
        }else {
          $.ajax({
            url: '<?php echo URL::to('approval-disable');?>',
            method: 'GET',
            data: {id:id},
            cache: false,
            success: function(html){
            //  $("#results").append(html);
            console.log(html);
             $("#approve_"+id).text('Approval Enable'); //versions newer than 1.6
             $("#approve_"+id).removeClass("btn-danger");
             $("#approve_"+id).addClass("btn-primary");
            }
          });
        }
  }


</script>
@endsection
