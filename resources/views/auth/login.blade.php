@extends('layout.app')
@section('title', '用户登录')

@section('style')
    <link rel="stylesheet" href="{{ asset('static/css/login.css') }}">
@endsection

<!-- 主体内容 -->
@section('content')
    <div class="site-login" style="margin-bottom:100px;">
        <!-- Tab panes -->
        <div class="tab-content user-login">
            <!-- 帐户密码登录-->
            <div class="tab-pane active" id="login">
                <form method="POST" action="{{ route('login') }}" id="myForm">
                    @csrf

                    @include('common.error')
                    <div class="form-group">
                        <div class="input-icon">
                            <!-- <i class="icon-user"></i>-->
                            <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="请输入邮箱">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-icon">
                            <!-- <i class="icon-psd"></i>-->
                            <input type="password" class="form-control" name="password" id="password" value="" placeholder="请输入密码">
                            <i class="icon-keyboard"></i> <i class="icon-look"></i>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <div class="input-icon">
                            <div class="input-group">
                                <input type="text" class="form-control" id="verifyCode" name="verifyCode"
                                    placeholder="输入图片验证码">
                                <span class="input-group-btn">
                                    <img id="captcha" src="" alt="点击换一个" title="点击换一个" style="cursor:pointer;"
                                        onclick="this.src=this.src + '?1'">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="checkbox pull-left">
                            <label> <input type="checkbox" id="rember" class="rember" title="记住密码"> 记住登录</label>
                        </div>
                    </div> --}}

                    <input type="submit" value="登录" class="btn btn-block btn-submit">
                    {{-- <button type="button" id="sub-login" class="btn btn-block btn-submit">登录</button>
                    <a class="login-btn-a" href="/login/register">没有账户？<span>去注册</span></a> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('static/js/login.js') }}"></script>
@endsection

{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
