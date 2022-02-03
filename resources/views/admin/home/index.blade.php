@extends('layouts.admin.master')

@section('title'){{trans('dashboard.home')}} 
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/owlcarousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/whether-icon.css')}}">
@endpush
    @section('content')
        @component('components.breadcrumb')
            @slot('breadcrumb_title')
                <h3>{{trans('dashboard.home')}}</h3>
            @endslot
            <li class="breadcrumb-item active">{{trans('dashboard.dashboard')}}</li>
        @endcomponent
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{route('parrot.index')}}">
                        <div class="card o-hidden border-0">
                            <div class="bg-primary b-r-4 card-body">
                        
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                
                                    <div class="media-body">
                                    
                                            <span class="m-0">@if ($parrot_count == 1) {{'pappagallo'}} @else {{'pappagalli'}} @endif </span>
                                            <h4 class="mb-0 counter">{{$parrot_count}}</h4>
                                            <i class="icon-bg" data-feather="database"></i>
                                        
                                    </div>
                                
                                </div>
                        
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <a href="{{route('couple.index')}}">
                        <div class="card o-hidden border-0">
                            <div class="bg-secondary b-r-4 card-body">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                                    <div class="media-body">
                                        <span class="m-0">@if ($couple_count == 1) {{'Coppia'}} @else {{'coppie'}} @endif </span>
                                        <h4 class="mb-0 counter">{{$couple_count}}</h4>
                                        <i class="icon-bg" data-feather="shopping-bag"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
                                <div class="media-body">
                                    <span class="m-0">Messages</span>
                                    <h4 class="mb-0 counter">893</h4>
                                    <i class="icon-bg" data-feather="message-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden border-0">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                                <div class="media-body">
                                    <span class="m-0">New Use</span>
                                    <h4 class="mb-0 counter">4531</h4>
                                    <i class="icon-bg" data-feather="user-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
               
            </div>
        </div>

    @push('scripts')    
        <script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
        <script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
        <script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
        <script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
        <script src="{{asset('assets/js/general-widget.js')}}"></script>
        <script src="{{asset('assets/js/height-equal.js')}}"></script>
        <script src="{{asset('assets/js/tooltip-init.js')}}"></script>
    @endpush
@endsection