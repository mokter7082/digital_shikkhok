@php
date_default_timezone_set("Asia/Dhaka");
$time = date("Y-m-d h:i");


$q_timing = DB::table('questioning_time')->first();
$get_id = $q_timing->id;
@endphp





<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog"> 
   <div class="modal-content col-md-7"> 
       <div class="modal-header"> 
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
           <h4 class="modal-title">Questioning Time Set</h4> 
      </div> 
   <div class="modal-body"> 
   <div class="row"> 
      <div class="col-md-6"> 
      <div class="form-group">
          <input type="hidden" name="" id="id" value="{{$get_id}}"> 
          <input type="hidden" name="" id="up_time" value="{{$time}}"> 
          <label for="" class="control-label">Start Time</label> 
          <input type="time" class="form-control" id="start_time"> 
      </div> 
      </div> 
      <div class="col-md-6"> 
      <div class="form-group"> 
          <label for="" class="control-label">End Time</label> 
          <input type="time" class="form-control" id="end_time"> 
      </div> 
      </div> 
    </div> 
    </div> 
    <div class="modal-footer"> 
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
        <button type="button" id="q_timing" class="btn btn-info waves-effect waves-light">Save</button> 
    </div> 
</div> 
</div>
</div>
  