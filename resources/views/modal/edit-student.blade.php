<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edite Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
            <div class="row"> 
                <div class="col-md-6"> 
                    <div class="form-group"> 
                        <label for="field-1" class="control-label">Name</label> 
                        <input type="text" class="form-control" id="name"> 
                        <input type="hidden" id="id">
                    </div> 
                </div> 
                <div class="col-md-6"> 
                    <div class="form-group"> 
                        <label for="field-2" class="control-label">Email</label> 
                        <input type="email" class="form-control" id="email"> 
                    </div> 
                </div> 
            </div> 
            <div class="row"> 
                <div class="col-md-12"> 
                    <div class="form-group"> 
                        <label for="field-3" class="control-label">Mobile</label> 
                        <input type="text" class="form-control" id="mobile"> 
                    </div> 
                </div> 
            </div> 
            <div class="row"> 
                <div class="col-md-12"> 
                    <div class="form-group"> 
                        <label for="field-1" class="control-label">Institution Name</label> 
                        <input type="text" class="form-control" id="insName" value> 
                    </div> 
                </div> 
            </div> 
        </div> 
     <div class="modal-footer"> 
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
        <button onclick="studentUpdate()" type="button" class="btn btn-info waves-effect waves-light">Update</button> 
     </div> 
    </div>
  </div>
</div>