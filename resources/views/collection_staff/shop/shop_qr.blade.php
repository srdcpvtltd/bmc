<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>QR CODE FOR SHOP | BMC MARKET  </title>

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

	<script src="{{asset('user_asset/assets/js/app.js')}}"></script>
	<script src="{{asset('user_asset/global_assets/js/demo_pages/login.js')}}"></script>
	<!-- /theme JS files -->
	<style>
        /* Add your custom styles here if needed */
        .wizard {
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: relative;
        }

        .wizard-step {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .step-circle {
            width: 30px;
            height: 30px;
            background-color: #f35b3f;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1; /* Set z-index to 1 to bring it in front of the line */
        }

    </style>
</head>

<body >
<!-- Page content -->

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Registration form -->
				<form  class="flex-fill">
					<div class="row">
						<div class="col-lg-6 offset-lg-3">
							<div class="card mb-0" style="background-color:#fbebfc;">
								<div class="card-body">
									<div class="text-center mb-3">
										<img src="{{asset('uploaded_images/logo/bmc_logo-1.png')}}" alt="">
										{{-- <i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i> --}}
										<h1 class="mb-0" style="color:#baad00;"><strong>Bhubaneswar Munipal Corporation</strong></h1>
									</div>

									<div class="row">
										<div class="col-lg-4 offset-lg-4">
											<div class="card text-center" style="border-color:red; height: 200px; border-radius: 25px; overflow: hidden;">
												<div class="card-body text-center">
														<iframe src="{{$shop->getQRCode(170,170)}}" style="border: none;"></iframe>
												</div>
											</div>
										</div> 
										<div class="col-md-12 text-center">
											<h1 class="mb-0" style="color:#baad00;"><strong>{{$shop->shop_name}}, Shop No-{{$shop->shop_number}}  </strong></h1>
										</div>
										<br>
										<br>
										<div class="wizard mt-4">
											<div class="wizard-step">
												<div class="step-circle">1</div>
												<br>
												<p><strong>OPEN YOUR PAYMENT APP</strong></p>
												{{-- <div class="step-line"></div> --}}
											</div>
											<div class="wizard-step">
												<div class="step-circle">2</div>
												<br>
												<p><strong>SCAN THIS QR CODE</strong></p>
												{{-- <div class="step-line"></div> --}}
											</div>
											<div class="wizard-step">
												<div class="step-circle">3</div>
												<br>
												<p><strong>VERIFY PAYMENT DETAILS</strong></p>
												{{-- <div class="step-line"></div> --}}
											</div>
											<div class="wizard-step">
												<div class="step-circle">4</div>
												<br>
												<p><strong>CONFIRM THE TRANCATION</strong></p>
											</div>
										</div>
										<div class="col-md-12 text-center">
											<h1 class="mb-0" style="color:#baad00;"><strong>Banking Partner</strong></h1>
											<h1 class="mb-0" style="color:#840f3a;font-size:xxx-large;"><strong>IndusInd Bank</strong></h1>
										</div>
										<div class="col-md-12">
											<div class="card text-center" style="border-color:red;background-color:#fbebfc;  border-radius: 25px; overflow: hidden;">
												<div class="card-body ">
													<div class="row">
														<div class="col-md-4">www.bmcdashboard.in</div>
														<div class="col-md-4">support@bmcdashboard.in</div>
														<div class="col-md-4">+91 80184 33463</div>

													</div>
												</div>
											</div>
										</div> 
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- /registration form -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
    <script src="{{asset('user_asset/assets/js/toastr.js')}}"></script>

</body>
</html>
