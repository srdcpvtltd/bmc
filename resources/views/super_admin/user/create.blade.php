@extends('super_admin.layout.index')

@section('title')
    Add Users
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Users</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
            
                <form action="{{route('super_admin.user.store')}}" method="post" enctype="multipart/form-data" >
                @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label>Name</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" id="name" class="form-control" value="{{old('name')}}" placeholder="username" name="name" required>
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Email Address</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" id="email" class="form-control"  value="{{old('email')}}" placeholder="Enter your email" name="email" required>
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Contact No.</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text"  class="form-control"  value="{{old('phone')}}" placeholder="Enter your phone" name="phone" required>
                                <div class="form-control-feedback">
                                    <i class="icon-phone text-muted"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Profile Image</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input class="form-control" type="file" name="image" placeholder="Enter password" required>
                                <div class="form-control-feedback">
                                    <i class="icon-file-picture text-muted"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Password</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="pwd" minlength="4" class="form-control" value="{{old('password')}}" onkeyup="validatePassword(this.value);" type="password" name="password" placeholder="Enter password" required>
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Confirm Password</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input id="confirmpwd" minlength="4" class="form-control" value="{{old('confirm_password')}}" onkeyup="confirmPassword(this.value);" type="password" name="confirm_password" placeholder="Enter confirm password" required>
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                                <span id="confirmmsg"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Role</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <select name="role_id" class="form-control select-search" id="role_id" required>
                                    <option>Select</option>
                                    @foreach(App\Models\Role::where('name','!=',['Super Admin'])->get() as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Zone</label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <select name="zone_id" class="form-control select-search" id="zone_id" required>
                                    <option>Select</option>
                                    @foreach(App\Models\Zone::all() as $zone)
                                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Create <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
    function validatePassword(password) {
        
        // Do not show anything when the length of password is zero.
        if (password.length === 0) {
            document.getElementById("msg").innerHTML = "";
            return;
        }
        // Create an array and push all possible values that you want in password
        var matchedCase = new Array();
        matchedCase.push("[$@$!%*#?&]"); // Special Charector
        matchedCase.push("[A-Z]");      // Uppercase Alpabates
        matchedCase.push("[0-9]");      // Numbers
        matchedCase.push("[a-z]");     // Lowercase Alphabates

        // Check the conditions
        var ctr = 0;
        for (var i = 0; i < matchedCase.length; i++) {
            if (new RegExp(matchedCase[i]).test(password)) {
                ctr++;
            }
        }
        // Display it
        var color = "";
        var strength = "";
        switch (ctr) {
            case 0:
            case 1:
            case 2:
                strength = "Very Weak";
                color = "red";
                break;
            case 3:
                strength = "Medium";
                color = "orange";
                break;
            case 4:
                strength = "Strong";
                color = "green";
                break;
        }
        document.getElementById("msg").innerHTML = strength;
        document.getElementById("msg").style.color = color;
    }
    function confirmPassword(password) {
        
        // Do not show anything when the length of password is zero.
        if (password.length === 0) {
            document.getElementById("confirmmsg").innerHTML = "";
            return;
        }
        // new_password = document.getElementById("pwd").val();
        new_password =  $('#pwd').val();
        if(new_password == password)
        {
            var strength = "Password Matched";
            var color = "green";
        }else{
            var strength = "Password dont Matched";
            var color = "red";
        }

        document.getElementById("confirmmsg").innerHTML = strength;
        document.getElementById("confirmmsg").style.color = color;
    }
    
</script>
@endsection
