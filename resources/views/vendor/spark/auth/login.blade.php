@extends('spark::layouts.app')
@section('custom-class', 'register-page login-page')

@section('content')
<div class="register__container">
    <h1 role="heading" aria-level="1" class="register__title">Gérez votre élevage différemment</h1>
    <span class="register__login">Ou <a href="{{ url('/register') }}">créez un compte</a> si vous n'êtes pas encore enregistré</span>

    <div class="register__form-container login__form-container">
        <el-form class="register__form" method="POST" action="/login">
            {{ csrf_field() }}
            <strong class="register__form__title">Connectez-vous</strong>

            <!--email-->
            <div class="register__form__row login__form__row">
                <el-form-item label="{{ __('labels.email') }}">
					<el-input name="email" id="email" required>
					</el-input>
                </el-form-item>
            </div>

            <!--password-->
            <div class="register__form__row login__form__row">
                <el-form-item label="{{ __('labels.password') }}">
					<el-input name="password" id="password" type="password" required>
					</el-input>
                </el-form-item>
            </div>
            <el-checkbox >{!! __('labels.remember', ['linkOpen' => "<a href='/terms' target='_blank'>", 'linkClose' => '</a>']) !!}
			</el-checkbox>

            </label>
            @if (count($errors) > 0)
                <div>
                    <ul class="login__form__error">
                        @foreach ($errors->all() as $error)
                            <li class="el-form-item__error">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
      

            <!--submit-->
            <div class="register__form__button login__form__button">
                <button type="submit" class="el-button el-button--primary el-button--medium">
                    <span>{{ __('labels.login-button') }}</span>
                </button>
                <a class="btn btn-link" href="{{ url('/password/reset') }}">{{ __('labels.password-forgot') }}</a>
            </div>
        </el-form>
    </div>



    <!--<div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-default">
                <div class="card-header">{{__('Login')}}</div>

                <div class="card-body">
                    @include('spark::shared.errors')

                    <form role="form" method="POST" action="/login">
                        {{ csrf_field() }}

                
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{__('E-Mail')}}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                            </div>
                        </div>

                   
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{__('Password')}}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                      
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="remember" class="form-check-input"> {{__('Remember Me')}}
                                    </label>
                                </div>
                            </div>
                        </div>

                 
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{__('Login')}}
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">{{__('Forgot Your Password?')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>-->
</div>
@endsection
