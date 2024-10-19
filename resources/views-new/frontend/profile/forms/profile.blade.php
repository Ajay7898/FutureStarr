<div class="col-sm-8 col-md-8 buyer-products buyer-profile">
    <h4 class="buyer-profile-heading"> Edit Account</h4>
    <hr>
    <div class="row">
        {!! Form::model($user,['route' => ['profile.update',$user->id],'method'=>'PATCH']) !!}
            @csrf
            <div class="form-group col-sm-12 p-b-10">
                <label for="name" class="required">Profile Name</label>
                {!! Form::text('display_name', old('display_name') , ['class' => 'form-control' . ($errors->has('display_name') ? ' is-invalid' : ''),'placeholder'=>'Profile Name' ]) !!}
                {!! $errors->first('display_name', '<span class="alert alert-danger" role="alert">:message</span>') !!}
            </div>
            <div class="form-group col-sm-12 p-b-10">
                <label for="">Profile Image</label>
                <div class="file-upload">
                    <div class="file-select">
                        <div class="file-select-button" id="fileName">Browse</div>
                        <div class="file-select-name" id="noFile">No file selected
                        </div>
                        <span></span>
                        <input type="file" id="chooseFile" name="profile_pic">
                    </div>
                    <ul class="file-list">
                        <li></li>
                        <li>
                            <span>test</span>
                            <a href="javascript:;">
                                <i class="fa fa-remove"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="form-group col-sm-12 p-b-10">
                <label class="required">Buyer - Bio Information</label>
                <br />
                {!! Form::textarea('description', old('description') , ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),'placeholder'=>'Bio Information','rows'=>'4' ]) !!}
                    {!! $errors->first('description', '<span class="alert alert-danger" role="alert">:message</span>') !!}
            </div>
            <div class="buyer-profile-contact">
                <span class="col-sm-12 buyer-profile-contact-heading">Contact Information</span>
                <div class="form-group col-sm-6 col-md-6 p-b-10">
                    <label for="first_name" class="required">First name</label>
                    {!! Form::text('first_name', old('first_name') , ['class' => 'form-control' . ($errors->has('first_name') ? ' is-invalid' : ''),'placeholder'=>'First Name' ]) !!}
                    {!! $errors->first('first_name', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                </div>
                <div class="form-group col-sm-6 col-md-6 p-b-10">
                    <label for="last_name" class="required">Last name</label>
                    {!! Form::text('last_name', old('last_name') , ['class' => 'form-control' . ($errors->has('last_name') ? ' is-invalid' : ''),'placeholder'=>'Last Name' ]) !!}
                    {!! $errors->first('last_name', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                </div>
                <div class="form-group col-sm-6 col-md-6 p-b-10">
                    <label for="email" class="required">Email</label>
                    {!! Form::text('email', old('email') , ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),'placeholder'=>'Email' ]) !!}
                    {!! $errors->first('email', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                </div>

                <div class="form-group col-sm-6 col-md-6 p-b-10">
                    <label for="phone" class="required">Phone</label>
                    {!! Form::text('phone', old('phone') , ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''),'placeholder'=>'+1234567890' ]) !!}
                    {!! $errors->first('phone', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                </div>
                <div class="form-group col-sm-4 col-md-4 p-b-10">
                    <label for="city" class="required">City</label>
                    {!! Form::text('city', old('city') , ['class' => 'form-control' . ($errors->has('city') ? ' is-invalid' : ''),'placeholder'=>'City' ]) !!}
                    {!! $errors->first('city', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                </div>
                <div class="form-group col-sm-4 col-md-4 p-b-10">
                    <label for="state" class="required">State</label>
                    {!! Form::text('state', old('state') , ['class' => 'form-control' . ($errors->has('state') ? ' is-invalid' : ''),'placeholder'=>'State' ]) !!}
                    {!! $errors->first('state', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                </div>
                <div class="form-group col-sm-4  col-md-4 p-b-10">
                    <label for="zip_code" class="required">Zip Code</label>
                    {!! Form::text('zip_code', old('zip_code') , ['class' => 'form-control' . ($errors->has('zip_code') ? ' is-invalid' : ''),'placeholder'=>'Zip Code' ]) !!}
                    {!! $errors->first('zip_code', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                </div>
                <div class="form-group col-sm-12  col-md-12 p-b-10">
                    <label class="required">Address</label>
                    {!! Form::textarea('address', old('address') , ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''),'placeholder'=>'Address','rows'=>'4' ]) !!}
                    {!! $errors->first('address', '<span class="alert alert-danger" role="alert">:message</span>') !!}
                </div>
            </div>
            <div class="buyer-profile-action-buttons">
                <div class="form-group">
                    <button type="submit" class="btn btn-danger">SAVE</button>
                    <a class="btn btn-danger">CANCEL</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>