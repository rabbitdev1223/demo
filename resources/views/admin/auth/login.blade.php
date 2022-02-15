@extends('admin.auth.master')

@section('title')
{{trans('auth.login')}}
@endsection

@push('css')
@endpush

@section('content')
    <section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form class="theme-form login-form" method="post"  action="{{ route('login.perform') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <h4>{{trans('auth.login')}}</h4>
                        
                        @include('layouts.partials.messages')
                        <div class="form-group">
                            <label>{{trans('user.email_address')}}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" required="" placeholder="Nickname or Email" name="nickname" value="{{ old('nickname') }}"/>
                            </div>
                            @if ($errors->has('nickname'))
                                <span class="text-danger text-left">{{ $errors->first('nickname') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>{{trans('user.password')}}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" value="{{ old('password') }}" required="" placeholder="*********" />
                                <div class="show-hide"><span class="show"> </span></div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox" />
                                <label for="checkbox1">{{trans('auth.remember_password')}}</label>
                            </div>
                            <a class="link" href="javascript:goReset()">{{trans('auth.forgot_password')}}</a>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">{{trans('auth.login')}}</button>
                        </div>
                        <!-- <div class="login-social-title">
                            <h5>Sign in with</h5>
                        </div>
                        -->
                        <p>{{trans('auth.dont_have_account')}}<a class="ms-2" href="{{ route('register.show') }}">{{trans('auth.create_account')}}</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

	
    @push('scripts')
    <script>
        function goReset(){

            var nickname = $("input[name=nickname]").val();
            location.href = "{{route('reset-password')}}" + "?email=" + nickname ; 
        }
    </script>
    @endpush

@endsection