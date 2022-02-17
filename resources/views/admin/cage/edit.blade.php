@extends('layouts.admin.master')

@section('title')
	{{trans('cage.edit_cage')}}	
@endsection

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mycss.css') }}">
     <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>{{trans('cage.edit_cage')}}</h3>
		@endslot
		<li class="breadcrumb-item">{{trans('cage.cage')}}</li>
		<li class="breadcrumb-item active">{{trans('cage.edit_cage')}}</li>
	@endcomponent
	<div class="container-fluid">
	    <div class="edit-profile">
	        <div class="row">
			
			@if ($errors->any())
			<div class="alert alert-danger dark alert-dismissible fade show" role="alert">{{trans('cage.failed_to_update_cage')}}
				<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
			</div>
			@endif
	            <div class="">
	                <div class="card">
	                    <div class="card-body">
	                        <form class="theme-form profile-form" method="post" enctype="multipart/form-data" action="{{ route('cage.save') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />  
							<input type="hidden" name="id" value="{{ $current_cage->id }}" />  
								<div class="row mb-2">
	                                <div class="profile-title">
	                                    <div class="media" style="position: relative;">
											<img class="img-70 rounded-circle" alt="" 
												@if ($current_cage->photo)
													src="{{asset('uploads/cages/' . $current_cage->photo) }}"
												@else
													src=""
												@endif
												onerror="onErrorImage(this)"
												id="profileDisplay"  />
											<a href="javascript:triggerClick()"><i class="fa fa-pencil circle-icon"
											></i></a>
											@if ($errors->has('profileImage'))
                                    			<div><span class="text-danger text-left">{{ $errors->first('profileImage') }}</span></div>
                                    		@endif
												<input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
											
	                                    </div>
	                                </div>
	                            </div>
								<div class="mb-3 col-6">
	                                <label class="form-label">{{trans('parrot.name')}}</label>
	                                <input class="form-control" name="name" maxlength=30 placeholder = "{{trans('cage.friendly_name_of_cage')}}" value="{{old('name',$current_cage->name)}}" />
									@if ($errors->has('name'))
                                    	<div><span class="text-danger text-left">{{ $errors->first('name') }}</span></div>
                                    @endif
								</div>

								
								<div class="mb-3 col-6">
	                            	<label class="form-label">Quanti pappagalli può contenere la gabbia?</label>
									<input class="form-control " name="max_parrot" type="number"  value="{{old('max_parrot',$current_cage->max_parrot)}}" min=1 >
								</div>
								    
								<div class="mb-3">
	                            	<label class="form-label">Dimensioni</label>
									<div style="border:4px solid #24695c;padding :5px; border-radius:4px " >
										<div class="row">
											<div class="col-sm-6">
												<div class="input-group mb-3 "><span class="input-group-text">cm</span>
													<input class="form-control " name="width" type="number"  min=1 value="{{old('width',$current_cage->width)}}" >
													<span class="input-group-text">&nbsp;larghezza</span>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="input-group mb-3 "><span class="input-group-text">cm</span>
													<input class="form-control" name="height" type="number" min=1 value="{{old('height',$current_cage->height)}}" >
													<span class="input-group-text">&nbsp;&nbsp;&nbsp;{{'altezza'}}&nbsp;&nbsp;&nbsp; </span>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="input-group"><span class="input-group-text">cm</span>
												
													<input class="form-control " name="depth" type="number"  min=1 value="{{old('depth',$current_cage->depth)}}" >									
													<span class="input-group-text">profondità</span>
												</div>
											</div>
										</div>
									</div>
								</div>

								
								<div class="mb-3">
									<label class="form-label">{{trans('couple.note')}}</label>
									<textarea class="form-control" name="note" rows="3" maxlength=1000>{{old('note',$current_cage->note)}}</textarea>
								</div>
								<div class="mb-3">	
									<div class="checkbox checkbox-solid-primary">
										<input id ="possibility_add_parrot" type="checkbox"  name="possibility_add_parrot" value="1"  @if ($current_cage->possibility_add_parrot == 1) {{ 'checked' }} @endif>
										<label class="text-muted" for="possibility_add_parrot" >Aggiungi pappagalli al termine della creazione</label>
									</div>	
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
	<script>
		$(document).ready(function(){

			

			});

	</script>
	<script src="{{ asset('assets/js/cage/cage.js') }}"></script>

	@endpush

@endsection