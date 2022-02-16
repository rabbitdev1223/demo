@extends('layouts.admin.master')

@section('title')
	Assegna Pappagalli alla Gabbia {{$current_cage->name?$current_cage->name:$current_cage->cage_id}}

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
			<h3>Assegna Pappagalli alla Gabbia {{$current_cage->name?$current_cage->name:$current_cage->cage_id}}</h3>
		@endslot
		<li class="breadcrumb-item">{{trans('cage.cage')}}</li>
		<li class="breadcrumb-item active">Assegna Pappagalli</li>
	@endcomponent
	
	<div class="container-fluid">
	    <div class="row">
	        <!-- Ajax data source array start-->
            @if(session('success'))	
					<div class="alert alert-primary dark alert-dismissible fade show" role="alert"> {{trans('cage.updated_success')}}
						<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>	
					</div>
				@endif	
	        <div class="col-sm-12">
	            <div class="card">
	               
	                <div class="card-body">
						<label>Seleziona I pappagalli che vuoi inserire nella gabbia che hai appena creato.</label>
						<label>Potrai modificare I pappagalli nella gabbia anche in un secondo momento.</label>
						
	                    <div class="table-responsive" style="margin-top:20px">
						
                        	<table class="display datatables" id="parrotlist">
	                            <thead>
	                                <tr>
                                        <th class="center">+aggiungi</th>
	                                    <th>ID</th>
										<th>{{trans('parrot.name')}}</th>
	                                    <th>{{trans('parrot.gender')}}</th>
										<th>{{trans('parrot.breed')}}</th>
										
									
	                                </tr>
	                            </thead>
	                            <tbody>
								@foreach ($parrots as $parrot)
									<tr data-id={{$parrot->id}}  data-couple="{{$parrot['is_couple']}}">
										<td>
										
											<input type="checkbox" name="checkbox" style="width:17px;height:17px" value="{{$parrot['id']}}">
										</td>
	                                    	
										<td>{{$parrot['parrot_id'] }}</td>
										<td>{{ $parrot['name'] }}</td>
										<td>{{$parrot['gender']==1?trans('parrot.male'):trans('parrot.female')}}</td>
	                                    <td>{{ $parrot['breed']['name'] }}</td>
	                                </tr>
								@endforeach
								</tbody>
	                        </table>
	                    </div>
						<div>
							<button class="btn btn-square btn-primary btn-sm" type="button" id="addParrot" >
								{{trans('cage.add_cage')}}
							</button>
						</div>
	                </div>

	            </div>
				<!--modal dialog-->	
				<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
					<div class="modal-dialog ">
						<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel">{{trans('user.are_you_sure')}}</h4>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" id="modal-btn-si">{{trans('parrot.yes')}}</button>
							<button type="button" class="btn btn-primary" id="modal-btn-no">{{trans('parrot.no')}}</button>
						</div>
						</div>
					</div>
				</div>
				<!---------->
				
	        </div>
	        <!-- Ajax data source array end-->
	        
	    </div>

		<!----------->
	</div>
	

	@push('scripts')
	<!-- <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script> -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
	<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
	<script src="{{ asset('assets/js/notify/notify-script.js')}}"></script>

	<script>
		var selectedCheckBoxArray = [];

		$('#addParrot').click(function(){
			
			
			var parrots = selectedCheckBoxArray.join(',');
			$.post("add-parrot",
			{
				parrots:parrots	
			},
			function(data, status){
			//    alert("Data: " + data + "\nStatus: " + status);
				var response = JSON.parse(data);
				console.log(response);
				
				if(response.error==0 && status=="success"){
					// $("#successToast .toast-body").html("success to delete");
					// new bootstrap.Toast(document.querySelector('#successToast')).show();
					show_notify(0,window.lang.success_to_delete);
					parrottable.draw();
					// parrottable
					// .row( target )
					// .remove()
					// .draw();
					                        
				}
				else{
					// $("#failedToast .toast-body").html("failed to delete");
					// new bootstrap.Toast(document.querySelector('#failedToast')).show();
					show_notify(1,window.lang.failed_to_delete);
				}
			});
		});
		$('#parrotlist tbody').on('click', 'input[type="checkbox"]', function(e) {
			var checkBoxId = $(this).val();
			var rowIndex = $.inArray(checkBoxId, selectedCheckBoxArray); 

			if(this.checked && rowIndex === -1) {
				selectedCheckBoxArray.push(checkBoxId); // If checkbox selected and element is not in the list->Then push it in array.
			}
			else if (!this.checked && rowIndex !== -1) {
				selectedCheckBoxArray.splice(rowIndex, 1); // Remove it from the array.
			}
			console.log(selectedCheckBoxArray);
		});
		window.lang ={
			"really_delete": "<?php echo trans('cage.really_delete')?>",
			"success_to_delete": "<?php echo trans('couple.success_to_delete')?>",
			"failed_to_delete": "<?php echo trans('couple.failed_to_delete')?>"
		}
	</script>
	<script src="{{ asset('assets/js/cage/addParrot.js') }}"></script>

	@endpush

@endsection