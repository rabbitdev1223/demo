@extends('layouts.admin.master')

@section('title')
	User Management

@endsection

@push('css')
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}"> 
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mycss.css') }}">
 
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>User Management</h3>
		@endslot
		<!-- <li class="breadcrumb-item">Tables</li>
		<li class="breadcrumb-item">Data Tables</li>
		<li class="breadcrumb-item active">AJAX</li> -->
	@endcomponent
	
	<div class="container-fluid">
	    <div class="row">
	        <!-- Ajax data source array start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-header">
	                    <h5>User List</h5>
	                    
	                </div>
	                <div class="card-body">
	                    <div class="table-responsive">

						
	                        <table class="display datatables" id="userlist">
	                            <thead>
	                                <tr>
										
	                                    <th>Name</th>
										<th>Surname</th>
	                                    <th>Email</th>
										<th>Suspend/Unsuspend</th>
										<th class="center">Action</th>
										
	                                </tr>
	                            </thead>
	                            <tbody>
								@foreach ($users as $user)
									<tr data-id={{$user->id}}>
										
	                                    <td>{{ $user['name'] }}</td>
										<td>{{ $user['surname'] }}</td>
	                                    <td>{{ $user['email'] }}</td>
										<td>
											@if (is_null($user['suspended_at']))
												<button type="button" class="btn btn-danger btn-sm" >Suspend</button>
												<button type="button" class="btn btn-primary  d-none btn-sm">Unsuspend</button>
											@else
												<button type="button" class="btn btn-danger  d-none btn-sm">Suspend</button>
												<button type="button" class="btn btn-primary btn-sm">Unsuspend</button>
											@endif
										</td>
										<td class=""  ><a href="{{route('user.edit',$user->id)}}"><i class="fa fa-eye" ></i></a>&nbsp;
											 <a href="{{route('user.edit',$user->id)}}"><i class="fa fa-pencil"></i></a>&nbsp;
											 <a href="#"><i class="fa fa-trash" role='button'></i></a></td>
			
	                                </tr>
								@endforeach
								</tbody>
	                        </table>
	                    </div>
	                </div>

	            </div>
				<!--modal dialog-->	
				<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
					<div class="modal-dialog ">
						<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" id="modal-btn-si">Yes</button>
							<button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
						</div>
						</div>
					</div>
				</div>
				<!---------->
				
	        </div>
	        <!-- Ajax data source array end-->
	        
	    </div>
		<!--Toast-->
		@component('components.toast')	
		@endcomponent
	
		<!----------->
	</div>
	

	@push('scripts')
	<!-- <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script> -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
	<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
	@endpush

@endsection