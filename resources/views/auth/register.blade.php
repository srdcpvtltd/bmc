<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>REGISTER | SHOP SYSTEM </title>

	<!-- Global stylesheets -->
    <link rel="shortcut icon" type="image/png" href="{{asset('front/image/favicon.png')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/global_assets/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('user_asset/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
    <link href="{{asset('user_asset/assets/css/toastr.css')}}" rel="stylesheet" type="text/css">

	<!-- Core JS files -->
	<script src="{{asset('user_asset/global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('user_asset/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>

	<script src="{{asset('user_asset/assets/js/app.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/demo_pages/login.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/demo_pages/form_select2.js')}}"></script>
	<!-- /theme JS files -->
	<style>
		.error_message{
			color:red;
		}
		.success_message{
			color:green;
		}
	</style>
</head>

<body class="bg-slate-800">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form class="flex-fill" method="POST" action="{{route('register')}}" enctype="multipart/form-data">
                    @csrf
					
					<div class="row">
						<div class="col-lg-8 offset-lg-2">
							<div class="card mb-0">
								<div class="card-body">
									<div class="text-center mb-3">
										<i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
										<h5 class="mb-0">Register Yourself</h5>
									</div>
									<div class="row">
										<div class="col-md-4">
											<label>Name</label>
											<div class="form-group form-group-feedback form-group-feedback-left">
												<input type="text" id="name" class="form-control" value="{{old('name')}}" placeholder="username" name="name" required>
												<div class="form-control-feedback">
													<i class="icon-user text-muted"></i>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<label>Email Address</label>
											<div class="form-group form-group-feedback form-group-feedback-left">
												<input type="text" id="email" class="form-control"  value="{{old('email')}}" placeholder="Enter your email" name="email" required>
												<div class="form-control-feedback">
													<i class="icon-mail5 text-muted"></i>
												</div>
											</div>
										</div>
										<div class="col-md-4">
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
										<div class="col-md-4">
											<label>Password</label>
											<div class="form-group form-group-feedback form-group-feedback-left">
												<input id="pwd" minlength="4" class="form-control" value="{{old('password')}}" onkeyup="validatePassword(this.value);" type="password" name="password" placeholder="Enter password" required>
												<div class="form-control-feedback">
													<i class="icon-lock2 text-muted"></i>
												</div>
												<span id="msg"></span>
											</div>
										</div>
										<div class="col-md-4">
											<label>Confirm Password</label>
											<div class="form-group form-group-feedback form-group-feedback-left">
												<input id="confirmpwd" minlength="4" class="form-control" value="{{old('confirm_password')}}" onkeyup="confirmPassword(this.value);" type="password" name="confirm_password" placeholder="Enter confirm password" required>
												<div class="form-control-feedback">
													<i class="icon-lock2 text-muted"></i>
												</div>
												<span id="confirmmsg"></span>
											</div>
										</div>
										<div class="col-md-4">
											<label>Role</label>
											<div class="form-group form-group-feedback form-group-feedback-left">
												<select name="role_id" class="form-control select-search" id="role_id" required>
													<option>Select</option>
													@foreach(App\Models\Role::where('name','!=',['Super Admin','Admin','Prospect'])->get() as $role)
													<option value="{{$role->id}}">{{$role->name}}</option>
													@endforeach
												</select>
											</div>
										</div>

									</div>
									<div class="row all_college_fields" {{old('role_id')?old('role_id') == 2:'hidden'}}>
										@include('auth.partials.college_profile_fields')
									</div>
									<div id="course_fields"></div>
									<div class="row student_profile_fields" {{old('role_id')?old('role_id') == 3:'hidden'}}>
										@include('auth.partials.student_profile_fields')
									</div>
									<div class="row all_teacher_fields" {{old('role_id')?old('role_id') == 4:'hidden'}}>
										@include('auth.partials.teacher_profile_fields')
									</div>
									<div class="form-group">
										<input class="" type="checkbox" name="terms_condiition" required> I accept <a href="{{url('terms_&_condition')}}"> terms and condition policy </a>of the University.
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-block">Sign Up <i class="icon-circle-right2 ml-2"></i></button>
									</div>
									<p  class="text-center">OR</p>
									
									<a href="{{url('/')}}"><button type="button" class="btn btn-primary btn-block">Sign In <i class="icon-circle-right2 ml-2"></i></button></a>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<div id="course_fields_for_html" style="display:none;">
		<div class="row">
			<div class="col-md-6">
				<label>Course </label>
				<div class="form-group form-group-feedback form-group-feedback-left">
					<select  name="course_ids[]"  class="form-control select-2">
						<option selected disabled>Select Course</option>
						@foreach(App\Models\Course::all() as $course)
						<option value="{{$course->id}}">{{$course->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<label>Course Seats</label>
				<div class="form-group form-group-feedback form-group-feedback-left">
					<input type="number" class="form-control" value="" placeholder="Course Seats" name="course_seats[]">
					<div class="form-control-feedback">
						<i class="icon-user text-muted"></i>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- /page content -->
    <script src="{{asset('user_asset/assets/js/toastr.js')}}"></script>
	@include('auth.partials.js')
	@toastr_render
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
	
    <script>
        $(document).on('change', '#role_id', function () {
			role_id = $(this).val();
			if(role_id == 2)
			{
				$('.all_college_fields').attr("hidden",false);
				$('.student_profile_fields').attr("hidden",true);
				$('.all_teacher_fields').attr("hidden",true);
			}else if(role_id == 3) {
				$('.all_college_fields').attr("hidden",true);
				$('.all_teacher_fields').attr("hidden",true);
				$('.student_profile_fields').attr("hidden",false);
			}else if(role_id == 4){
				$('.all_teacher_fields').attr("hidden",false);
				$('.all_college_fields').attr("hidden",true);
				$('.student_profile_fields').attr("hidden",true);
			}else{
				$('.all_teacher_fields').attr("hidden",true);
				$('.all_college_fields').attr("hidden",true);
				$('.student_profile_fields').attr("hidden",true);

			}
        });
        $(document).on('click', '#add_row_for_courses', function () {
			html = $('#course_fields_for_html').html();
			$('#course_fields').append(html);
			$('.select-2').addClass('select-search');
        });
        $(document).on('change', '#same_as_temparory', function (event) {
            if(this.checked){
				$('#permenant_address').val($('#temparory_address').val());
				$('#permenant_country_id').val($('#temparory_country_id').val());
				$('#permenant_state_id').val($('#temparory_state_id').val());
				$('#permenant_landmark').val($('#temparory_landmark').val());
				$('#permenant_city_id').val($('#temparory_city_id').val());
				$('#permenant_town').val($('#temparory_town').val());
				$('#permenant_pin').val($('#temparory_pin').val());
				$('#permenant_lan').val($('#temparory_lan').val());
				$('.permenant_fields').hide();
			}else{
				$('#permenant_address').val('');
				$('#permenant_country_id').val('');
				$('#permenant_state_id').val('');
				$('#permenant_landmark').val('');
				$('#permenant_city_id').val('');
				$('#permenant_town').val('');
				$('#permenant_pin').val('');
				$('#permenant_lan').val('');
				$('.permenant_fields').show();
			}
        });
    </script>
</body>
</html>
