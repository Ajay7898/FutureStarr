<div class="col-sm-8 col-md-8 buyer-products buyer-profile">
   <h4 class="buyer-profile-heading"> Change Password</h4>
   <hr>


   <div class="row">
      <form method="POST" action="{{route('buyer.setPassword')}}">
         @csrf
         <div class="form-group">
            <label for="email">Current Password</label>
            <input type="password" class="form-control" name="current-password"  placeholder="Password">
            @if ($errors->has('current-password'))
               <span class="error" role="">
                    <strong>{{ $errors->first('current-password') }}</strong>
            </span>
            @endif
         </div>
         <div class="form-group">
            <label for="email">Password</label>
            <input type="password" class="form-control" name="new-password"  placeholder="Password">
            @if ($errors->has('new-password'))
                <span class="" role="alert">
                    <strong>{{ $errors->first('new-password') }}</strong>
            </span>
            @endif
         </div>
         <div class="form-group">
            <label for="pwd">Confirm Password:</label>
            <input type="password" class="form-control" name="password_confirmation"  placeholder="Confirm Password">
             @if ($errors->has('password_confirmation'))
                <span class="" role="alert">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
         </div>
         <input type="hidden" name="token" value="{{ Request::segment(2) }}">
         <button type="submit" class="btn btn-danger main-button">Submit</button>
      </form>
   </div>
</div>