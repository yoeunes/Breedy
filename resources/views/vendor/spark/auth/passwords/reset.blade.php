@extends('spark::layouts.app')
@section('custom-class', 'register-page login-page')

@section('content')

<div class="register__container">
    <div class="register__form-container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form class="register__form" role="form" method="POST" action="{{ url('/password/reset') }}">
            {!! csrf_field() !!}

            <input type="hidden" name="token" value="{{ $token }}">

            <!--email-->
            <div class="register__form__row">
                <label for="email" class="el-form-item__label">{{ __('labels.email') }}</label>
                <input type="email" name="email" id="email" class="el-input__inner reset-input" required>
            </div>

            <!--password-->
            <div class="register__form__row">
                <label for="password" name="password" class="el-form-item__label">{{__('Password')}}</label>
                <input type="password" name="password" class="el-input__inner reset-input" required >
                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>

            <!--password confirmation-->
            <div class="register__form__row">
                <label for="password" name="password" class="el-form-item__label">{{__('Confirm Password')}}</label>
                <input type="password" name="password_confirmation" class="el-input__inner reset-input" required>
                 @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                @endif
            </div>

            
            <!--submit-->
            <div class="register__form__button">
                <button type="submit" class="el-button el-button--primary el-button--medium">
                    <span>{{ __('labels.reset-password') }}</span>
                </button>
            </div>
        </form>
    </div>
</div>
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-default">
                <div class="card-header">{{__('Reset Password')}}</div>

                <div class="card-body">
                    <form role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row{{ $errors->has('email') ? ' is-invalid' : '' }}">
                            <label class="col-md-4 col-form-label text-md-right">{{__('E-Mail Address')}}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                  
                        <div class="form-group row{{ $errors->has('password') ? ' is-invalid' : '' }}">
                            <label class="col-md-4 col-form-label text-md-right">{{__('Password')}}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                 
                        <div class="form-group row{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}">
                            <label class="col-md-4 col-form-label text-md-right">{{__('Confirm Password')}}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i> {{__('Reset Password')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->

