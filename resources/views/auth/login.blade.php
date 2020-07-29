@extends('layouts.app')

@section('content')
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-end" style="padding-right: 50px;">
                    <div class="col-lg-4">
                        <div class="login-content card" style="background-color: #fff0; border:0;">
                            <div class="login-form">
                                <div class="container">
                                <img src="images/new-logo.png" style="width: 100%;">
                                </div>
                                
                                <h4><b style="color:white;" class="h-title">SMS Gateway</b></h4>
                                <form method="POST" action="{{ route('login') }}">
                                  @csrf


                                  <!--USERNAME-->
                                    <div class="form-group">
                                    
                                        <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user-circle-o" aria-hidden="true" style="color: black;"></i></div>
                                            </div>
                                            <!-- <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username"> -->
                                            <input type="text" placeholder="username" id="inlineFormInputGroupUsername2" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}">
                                        </div>

                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <!--PASSWORD-->
                                    <div class="form-group">
                                        <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-key" aria-hidden="true" style="color: black;"></i></div>
                                            </div>
                                            <input type="password" placeholder="password" id="inlineFormInputGroupUsername2" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
                                            
                                        </div>
                                        

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>

                                </form>
                                    <div class="form-group text-center">
                                        <p>Copyright &copy; coreDev Solutions Inc. 2018</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
@endsection
