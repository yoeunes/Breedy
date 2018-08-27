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
        <form class="register__form password__form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
            <strong class="register__form__title">Réinitialisez votre mot de passe</strong>
            <!--email-->
            <div class="register__form__row password__form__row">
                <label for="email" class="el-form-item__label">{{ __('labels.email') }}</label>
                <input type="email" name="email" id="email" class="el-input__inner reset-input" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        {{ $errors->first('email') }}
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
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

              
                        <div class="form-group row{{ $errors->has('email') ? ' is-invalid' : '' }}">
                            <label class="col-md-4 col-form-label text-md-right">{{__('E-Mail Address')}}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="el-button el-button--primary el-button--medium">
                                    <i class="fa fa-btn fa-envelope"></i> {{__('Send Password Reset Link')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->

