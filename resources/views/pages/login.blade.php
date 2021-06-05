@include('fileInclude.headerArea')


<div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">
                 @if($errors->any())
                 <div class="alert alert-danger" role="alert">
                  <p>{{$errors->first()}}</p>
                </div>     
                @endif
                <div class="panel-heading bg-img"> 
                    <div class="bg-overlay"></div>
                    <h3 class="text-center m-t-10 text-white"> Log In to <strong>DS</strong> </h3>
                </div> 
                <div class="panel-body">
                <form class="form-horizontal m-t-20" action="{{route('login')}}" method="post">
                @csrf
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control input-lg" name="mobile" type="text" required="" placeholder="Phone Number">
                        </div>     
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg" name="password" type="password" required="" placeholder="Password">
                        </div>
                    </div>  
                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
                </form> 
                </div>                                 
                
            </div>
        </div>



@include('fileInclude.footerArea')

