     <!-- sample modal content -->
     @foreach($flags_answer as $val)
                           <div id="view-{{$val->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title text-center" id="myModalLabel">Details</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>Answered By</h4>
                                                         <table class="table table-bordered">
                                                         <tr>
                                                              <th>ID:</th>
                                                              <td>{{$val->id}}</td>
                                                          </tr>
                                                          <tr>
                                                              <th>Name:</th>
                                                              <td>{{$val->name}}</td>
                                                          </tr>
                                                          <tr>
                                                              <th>Email:</th>
                                                              <td>{{$val->email}}</td>
                                                          </tr>
                                                          <tr>
                                                              <th>Mobile:</th>
                                                              <td>{{$val->mobile}}</td>
                                                          </tr>
                                                          <tr>
                                                              <th>Institution Name:</th>
                                                              <td>{{$val->institutionname}}</td>
                                                          </tr>
                                                          <tr>
                                                              <th>Question:</th>
                                                              <td>{{$val->question}}</td>
                                                          </tr>
                                                          <tr>
                                                              <th>Answer:</th>
                                                              <td>{{$val->answer}}</td>
                                                          </tr>
                                                         </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        @endforeach