     <!-- sample modal content -->
     @foreach($all_users_points as $val)
                           <div id="view-{{$val->user_id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title text-center" id="myModalLabel">Points Informations</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>Points</h4>
                                                         <table class="table table-bordered">
                                                         <tr>
                                                              <th>Referral Point:</th>
                                                              <td>{{$val->referral_points}}</td>
                                                          </tr>
                                                            <tr>
                                                              <th>Custom Point:</th>
                                                              <td>{{$val->custom_points}}</td>
                                                          </tr>
                                                          <tr>
                                                           <th>Quiz Point:</th>
                                                              <td>{{$val->quiz_points}}</td>
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