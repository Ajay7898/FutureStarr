<div id="myModal" class="modal fade modal-m" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header mob-cls" style="padding:5px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <h4 class="modal-title">Modal Header</h4> -->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-5 login-back" style="background-color:#fff;">
                        <form>
                            {!! Form::open(['route' => 'login']) !!} @csrf
                            <h3 style="color:#ff503f;font-weight: 600;">Login</h3>
                            <div class="input-group" style="margin-bottom:8px;">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                 {!! Form::text('email', old('email') , ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),'placeholder'=>'User name OR Email' ]) !!}
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password" class="form-control" name="password" required placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-sm-7 col-xs-7 no-padding-right">
                                    <div class="fom-inline">
                                        <div class="checkbox">
                                            <label style="font-size:12px;">
                                                {!! Form::checkbox('remember', old('remember') , ['class' => 'form-check-input' ]) !!} Remember Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5 col-xs-5 no-padding">
                                    <div class="fom-inline">
                                        <div class="checkbox">
                                            @if (Route::has('password.request'))
                                            <a style="color:#ff503f;margin-left:12px;font-size:12px;" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-danger btn-sm login-button">LOG IN</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <br>
                                    <p class="text-center" style="color:#151829;">Sign In with</p>
                                    <div class="text-center login-foooter-box">
                                        <span style="cursor: pointer;"><a  data-toggle="tooltip" title="Facebook"><i
                            class="fab fa-facebook-f"></i></a></span>
                                        <span style="cursor: pointer;"><a  data-toggle="tooltip" title="Twitter"><i
                            class="fab fa-twitter"></i></a></span>
                                        <span style="cursor: pointer;"><a data-toggle="tooltip" title="LinkedIn"><i
                            class="fab fa-linkedin"></i></a></span>
                                    </div>

                                </div>
                            </div>
                            {!! Form::close()!!}
                    </div>
                    <div class="col-sm-7 text-center login-back-img" style="background-image:url('assets/images/news-2.jpg');background-size:cover;background-position:left;">
                        <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p style="color:#fff;">Welcome to</p>
                        <h3 style="color:#fff;">FutureStarr</h3>
                        <p style="color:#fff;">The Official Talent Marketplace</p>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
        </div>

    </div>
</div>