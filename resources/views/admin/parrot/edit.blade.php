@extends('layouts.admin.master')

@section('title')
{{trans('parrot.edit_parrot')}}
@endsection

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mycss.css') }}">
     <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
<script>
	function onErrorImage(e){
		e.onerror=null;
		e.src="{{asset('assets/images/user/7.jpg')}}";
  }
</script>
@section('content')
@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>{{trans('parrot.edit_parrot')}}</h3>
		@endslot
		<li class="breadcrumb-item">{{trans('parrot.parrot')}}</li>
		<li class="breadcrumb-item active">{{trans('parrot.edit_parrot')}}</li>
	@endcomponent
	<div class="container-fluid">
	    <div class="edit-profile">
	        <div class="row">
			
			@if ($errors->any())
			<div class="alert alert-danger dark alert-dismissible fade show" role="alert">{{trans('parrot.failed_to_update_parrot')}}
                      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
                    </div>
			@endif
	            <div class="">
	                <div class="card">
	                    <div class="card-header pb-0">
	                        <h4 class="card-title mb-0">{{trans('parrot.edit_parrot')}}</h4>
	                        <div class="card-options">
	                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
	                        </div>
	                    </div>
	                    <div class="card-body">
	                        <form class="theme-form profile-form" method="post" enctype="multipart/form-data" action="{{ route('parrot.save') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />    
                            <input type="hidden" name="id" value="{{ $current_parrot->id }}" />  
							<div class="row mb-2">
	                                <div class="profile-title">
	                                    <div class="media">
											<img class="img-70 rounded-circle" alt="" 
                                                src="{{asset('uploads/parrots/' . $current_parrot->photo) }}"
												onerror="onErrorImage(this)"
												id="profileDisplay" onClick="triggerClick()" />
											@if ($errors->has('profileImage'))
                                    			<div><span class="text-danger text-left">{{ $errors->first('profileImage') }}</span></div>
                                    		@endif
												<input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
											
	                                    </div>
	                                </div>
	                            </div>
								<div class="mb-3">
	                                <label class="form-label">{{trans('parrot.name')}}</label>
	                                <input class="form-control" name="name" placeholder = "{{trans('parrot.friendly_name_of_parrot')}}" value="{{old('name',$current_parrot->name)}}" />
									@if ($errors->has('name'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('name') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
	                                <label class="form-label">{{trans('parrot.date_of_birth')}}</label>
	                                {{old('date_of_birth',$current_parrot->date_of_birth)}}
                                    <input class="datepicker-here form-control digits" 
                                        type="text" data-language="en" name="date_of_birth" 
                                        value="" readonly style="background:white">
                                    @if ($errors->has('date_of_birth'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('date_of_birth') }}</span></div>
                                    @endif
								</div>
								<div class="mb-3">
									<label class="form-label">Razza </label>
									<select class="form-control btn-square" name="breed" style="display:block">
                                        @foreach($breeds as $breed)
                                        <option value='{{ $breed->id }}'  @if ($current_parrot->breed->id == $breed->id) {{ 'selected' }} @endif>{{ $breed->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted" style="display:block" >{{trans('parrot.not_on_list_contact')}}</small>
								</div>

								<div class="mb-3">
	                                <label class="form-label">{{trans('parrot.gender')}}</label>
	                                <select class="form-control btn-square" name="gender" style="display:block" @if ($current_parrot->is_couple == true) {{ 'disabled' }} @endif</select>)>
										<option value='0' @if ($current_parrot->gender == 0) {{ 'selected' }} @endif>{{trans('parrot.i_donot_know')}}</option>
										<option value='1' @if ($current_parrot->gender == 1) {{ 'selected' }} @endif>{{trans('parrot.male')}}</option>
                                        <option value='2' @if ($current_parrot->gender == 2) {{ 'selected' }} @endif>{{trans('parrot.female')}}</option>
                                       	 
                                    </select>
								</div>

                                <div class="mb-3">
	                                <label class="form-label">{{trans('parrot.color')}}</label>
	                                <input class="form-control" name="color" type="text" placeholder="{{trans('parrot.color')}}" value="{{old('color',$current_parrot->color)}}" >
	                            	
								</div>
	                            <div class="form-footer">
	                                <button class="btn btn-primary btn-block">{{trans('parrot.save')}}</button>
	                            </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	           
	        </div>
	    </div>
	</div>
	
	@push('scripts')
	<script src="{{ asset('assets/js/parrots/profile.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script> -->
    <script>
        $(document).ready(function() {
            $("input[name=date_of_birth]").val("{{old('date_of_birth',$current_parrot->date_of_birth)}}")        
        });
    </script>
	@endpush

@endsection