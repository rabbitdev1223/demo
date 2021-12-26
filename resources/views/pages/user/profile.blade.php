@extends('layouts.admin.master')

@section('title', 'Edit Profile')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/sweetalert2.css')}}">
@endpush

@section('content')
  @component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Edit Profile</h3>
		@endslot
		<li class="breadcrumb-item">Users</li>
		<li class="breadcrumb-item active">Edit Profile</li>
	@endcomponent
	
	<div class="container-fluid">
	    <div class="edit-profile">
	        <div class="row">
	            <div class="col-xl-4">
	                <div class="card">
	                    <div class="card-header pb-0">
	                        <h4 class="card-title mb-0">My Profile</h4>
	                        <div class="card-options">
	                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
	                        </div>
	                    </div>
	                    <div class="card-body">
	                        <form>
	                            <div class="row mb-2">
                                <div class="profile-title">
                                  <div class="media">
                                    <img class="img-70 rounded-circle" alt="" id="show_img" src="{{$user_info['profile_photo_path'] ? asset('images/'.$user_info['profile_photo_path']) : asset('assets/images/user/7.jpg')}}" />
                                    <div class="media-body">
                                        <h3 class="mb-1 f-20 txt-primary" id="fullname">{{ $user_info['name']." ".$user_info['surname'] }}</h3>
                                        <p class="f-12" id="disp_option">{{ $user_info['option'] }}</p>
                                    </div>
                                  </div>
                                </div>
	                            </div>
                              <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" placeholder="Name" id="disp_name" value="{{ $user_info['name'] }}" disabled />
	                            </div>
                              <div class="mb-3">
                                <label class="form-label">Surname</label>
                                <input class="form-control" placeholder="Surname" id="disp_surname" value="{{ $user_info['surname'] }}" disabled />
	                            </div>
                              <div class="mb-3">
                                  <label class="form-label">Nickname</label>
                                  <input class="form-control" placeholder="Nickname" id="disp_nickname" value="{{ $user_info['nickname'] }}" disabled />
                              </div>
	                            <div class="mb-3">
	                                <label class="form-label">Email-Address</label>
	                                <input class="form-control" placeholder="email" id="disp_email" value="{{ $user_info['email'] }}" disabled />
	                            </div>
                              <div class="mb-3">
                                  <label class="form-label">Option</label>
	                                <input class="form-control" id="disp_option" value="{{ $user_info['option'] }}" disabled />
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">My City</label>
                                  <input class="form-control" placeholder="Mycity" id="disp_mycity" value="{{ $user_info['mycity'] }}" disabled />
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">My Cap</label>
                                  <input class="form-control" placeholder="Mycap" id="disp_mycap" value="{{ $user_info['mycap'] }}" disabled />
                              </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	            <div class="col-xl-8">
                <div class="card">
                  <div class="card-header pb-0">
                      <h4 class="card-title mb-0">Edit Profile</h4>
                      <div class="card-options">
                          <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                      </div>
                  </div>

                  <div class="card-body">
                    <form method="POST"  id="update-profile" enctype="multipart/form-data">
                      @csrf
                      <div class="row mb-2">
                        <div class="profile-title">
                          <div class="media ">
                              <img class="img-70 img-fluid m-r-20 rounded-circle update_img" id="upload_img" src="{{ $user_info['profile_photo_path'] ? asset('images/'.$user_info['profile_photo_path']) : asset('assets/images/user/7.jpg') }}" alt="" />
                              <input class="updateimg" type="file" name="profile_photo_path" onchange="readURL()" id="file" accept=".jpg, .png" />
                              <div class="media-body mt-0">
                                  <h5><span class="first_name_0">Click the photo</span></h5>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{ $user_info['name'] }}" placeholder="Name" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Surname</label>
                                <input class="form-control" type="text" name="surname" id="surname" value="{{ $user_info['surname'] }}" placeholder="Surname" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nickname</label>
                                <input class="form-control" type="text" name="nickname" id="nickname" value="{{ $user_info['nickname'] }}" placeholder="Nickname" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Age</label>
                                <input class="form-control" type="number" name="age" id="age" value="{{ $user_info['age'] }}" placeholder="Age" />
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Option</label>
                            <select class="form-control btn-square" id="option">
                              <option value="allevatore" {{ $user_info['option'] == "allevatore" ? "selected": null }}>allevatore</option>
                              <option value="appassionato" {{ $user_info['option'] == "appassionato" ? "selected": null }}>appassionato</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">My City</label>
                                <input class="form-control" type="text" name="mycity" id="mycity" value="{{ $user_info['mycity'] }}" placeholder="My City" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">My Cap</label>
                                <input class="form-control" type="number" name="mycap" id="mycap" value="{{ $user_info['mycap'] }}" placeholder="Cap" />
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3 form-group">
                                <input type="checkbox" name="is_visible" id="is_visible" {{ $user_info['is_visible'] ? "checked": null }} />
                                <label class="text-muted" for="checkbox1">Public visible</label>
                            </div>
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col-md-12">
                          <div class="mb-3 form-group">
                            <div class="profile-title">
                              <div class="media text-right">
                                <div class="col-sm-6 offset-sm-6 col-md-4 offset-md-8">
                                  <button class="btn btn-primary" type="submit">Update Profile</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="card-footer">
                        </div> -->
                    </form>
                    <form method="POST"  id="update-password" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input class="form-control" type="password" name="new_password" id="new_password" placeholder="New Password" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm" />
                            </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="mb-3">
                          <div class="profile-title">
                            <div class="media text-right">
                              <div class="col-sm-6 offset-sm-6 col-md-4 offset-md-8">
                                <button class="btn btn-primary" type="submit">Change Password</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    <form method="POST"  id="update-email" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <input class="form-control" type="email" name="email" id="new_email" placeholder="Email" value="{{ $user_info['email'] }}" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 offset-md-2">
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Change Email</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
	            </div>
	        </div>
	    </div>
	</div>

	
	@push('scripts')
    <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('assets/custom/profile/custom.js')}}"></script>
	@endpush
@endsection