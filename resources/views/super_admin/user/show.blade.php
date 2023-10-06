@extends('super_admin.layout.index')

@section('title')
    {{$user->name}} Project User
@endsection

@section('content')


				<!-- Inner container -->
				<div class="d-md-flex align-items-md-start">

					<!-- Left sidebar component -->
					<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">

						<!-- Sidebar content -->
						<div class="sidebar-content">

							<!-- Navigation -->
							<div class="card">
								<div class="card-body bg-indigo-400 text-center card-img-top" style="background-image: url({{asset('user_asset/global_assets/images/backgrounds/panel_bg.png')}}); background-size: contain;">
									<div class="card-img-actions d-inline-block mb-3">
										@if($user->image)
										<img class="img-fluid rounded-circle" src="{{asset($user->image)}}" width="170" height="170" alt="">
										@else 
										<img class="img-fluid rounded-circle" src="{{asset('user_asset/global_assets/images/placeholders/placeholder.jpg')}}" width="170" height="170" alt="">
										@endif
										<div class="card-img-actions-overlay rounded-circle">
											<a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
												<i class="icon-plus3"></i>
											</a>
											<a href="user_pages_profile.html" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
												<i class="icon-link"></i>
											</a>
										</div>
									</div>

						    		<h6 class="font-weight-semibold mb-0">{{$user->name}}</h6>
						    		<span class="d-block opacity-75">{{$user->email}}</span>
									
									@if($user->is_verified)
										<span class="badge badge-success">Verified</span>
									@else
										<span class="badge badge-danger">Not Verified</span>
									@endif
									
									@if($user->is_active)
										<span class="badge badge-success">Active</span>
									@else
										<span class="badge badge-danger">Pending</span>
									@endif
									<br>
					    			<div class="list-icons list-icons-extended mt-3">
										
										@if($user->is_verified)
											<a href="{{route('super_admin.user.revert_verification',$user->id)}}" class="btn btn-danger btn-sm">Revert Verification</a>
										@else 
											<a href="{{route('super_admin.user.verified',$user->id)}}" class="btn btn-info btn-sm">Verify</a>
										@endif
										@if($user->is_active)
											<a href="{{route('super_admin.user.in_active',$user->id)}}" class="btn btn-warning btn-sm">In Active</a>
										@else 
											<a href="{{route('super_admin.user.active',$user->id)}}" class="btn btn-success btn-sm">Active</a>
										@endif
									</div>
						    	</div>

								<div class="card-body p-0">
									<ul class="nav nav-sidebar mb-2">
										<li class="nav-item-header">Navigation</li>
										<li class="nav-item">
											<a href="#profile" class="nav-link active" data-toggle="tab">
												<i class="icon-user"></i>
												 Basic profile
											</a>
										</li>
										{{-- <li class="nav-item">
											<a href="#inbox" class="nav-link" data-toggle="tab">
												<i class="icon-book"></i>
												Projects
											</a>
										</li> --}}
										<li class="nav-item-divider"></li>
										<li class="nav-item">
											<a href="{{route('super_admin.user.index')}}" class="nav-link" data-toggle="tab">
												<i class="icon-switch2"></i>
												Go Back To User  Page
											</a>
										</li>
									</ul>
								</div>
							</div>
							<!-- /navigation -->
						</div>
						<!-- /sidebar content -->

					</div>
					<!-- /left sidebar component -->


					<!-- Right content -->
					<div class="tab-content w-100 overflow-auto">
						<div class="tab-pane fade active show" id="profile">


							<!-- Profile info -->
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">Profile information</h5>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
					                		<a class="list-icons-item" data-action="reload"></a>
					                		<a class="list-icons-item" data-action="remove"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">
									<form action="{{route('super_admin.user.update',$user->id)}}" method="post" enctype="multipart/form-data" >
										@method('PUT')
										@csrf
										<div class="form-group">
											<div class="row">
												<div class="col-md-6">
													<label>Username</label>
													<input type="text" name="name" value="{{$user->name}}" class="form-control">
												</div>
												<div class="col-md-6">
													<label>Email</label>
													<input type="email" value="{{$user->email}}" name="email" readonly class="form-control">
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-md-6">
													<label>Password <small style="color:red;">(Leave It Blank if you don't want to change)</small></label>
													<input type="password" name="password" placeholder="Password" class="form-control">
												</div>
												<div class="col-md-6">
													<label>Upload profile image</label>
				                                    <input type="file" class="form-input-styled" name="image" data-fouc>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-4">
													<label>Phone</label>
													<input type="text" value="{{@$user->phone}}" name="phone"  class="form-control" required>
												</div>
												<div class="col-md-4">
													<label>Role</label>
													<select name="role_id" class="form-control select-search" id="role_id" required>
														<option>Select</option>
														@foreach(App\Models\Role::where('name','!=',['Super Admin'])->get() as $role)
														<option @if($user->role_id == $role->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
														@endforeach
													</select>
												</div>
												<div class="col-md-4">
													<label>Zone</label>
													<select name="zone_id" class="form-control select-search" id="zone_id" required>
														<option>Select</option>
														@foreach(App\Models\Zone::all() as $zone)
														<option @if($user->zone_id == $zone->id) selected @endif value="{{$zone->id}}">{{$zone->name}}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>

				                        <div class="text-right">
				                        	<button type="submit" class="btn btn-primary">Save changes</button>
				                        </div>
									</form>
								</div>
							</div>
							<!-- /profile info -->

					    </div>
					    {{-- <div class="tab-pane fade" id="inbox">

							<!-- My inbox -->
							<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<h6 class="card-title">Projects</h6>

								</div>
								<div class="card-body">

									<form action="{{route('super_admin.project_user.store')}}" method="post" enctype="multipart/form-data" >
										@csrf
										<div class="form-group">
											<input type="hidden" name="user_id" value="{{$user->id}}">
											<div class="row">
												<div class="col-md-6">
													<label>Project</label>
													<select  name="project_id"  class="form-control select-search" data-fouc required>
														<option selected disabled>Select Project</option>
														@foreach(App\Models\Project::all() as $project)
														<option value="{{$project->id}}">{{$project->name}}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>

										<div class="text-right">
											<button type="submit" class="btn btn-primary">Save</button>
										</div>
									</form>
									<table class="table datatable-save-state">
										<thead>
											<tr>
												<th>#</th>
												<th>Project</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($user->projects  as $key => $project)
											<tr>
												<td>{{$key+1}}</td>
												<td>{{$project->project->name}}</td>
												<td>
													<form action="{{route('super_admin.project_user.destroy',$project->id)}}" method="POST">
														@method('DELETE')
														@csrf
													<button class="btn btn-danger">Delete</button>
													</form>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>

							</div>
							<!-- /my inbox -->

				    	</div> --}}
					</div>
					<!-- /right content -->

				</div>
				<!-- /inner container -->
@endsection
@section('scripts')
@endsection
