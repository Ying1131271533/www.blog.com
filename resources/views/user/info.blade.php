@extends('layout.app')

@section('title', '个人信息')

@section('style')
    <!-- css -->
    <link href="{{ asset('static/css/site.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/lib/layui/cropper/cropper.css') }}" rel="stylesheet" type="text/css">
    <style>
        .info-ul {
            border-bottom: #ddd 1px solid;
            padding-bottom: 30px;
            margin: 0 20px;
        }

        .info-ul li {
            min-height: 50px;
            line-height: 50px;
            background: #fff;
            padding: 0 10px;
            font-size: 1.6rem
        }

        .thumb-div {
            padding: 15px 0;
            float: left;
        }

        .thumb-div .user-thumb {
            float: left;
        }

        .thumb-div .user-thumb img {
            width: 81px;
            height: 81px;
            border-radius: 50%;
        }

        .thumb-div .tips {
            float: left;
            margin-left: 38px;
            font-size: 16px;
            line-height: 82px;
        }

        .info-ul .title {
            width: 90px;
            float: left;
        }

        .info-ul .data {
            color: #999;
            margin-left: 10px;
        }

        .info-ul li .desc {
            line-height: 22px;
            padding-top: 14px;
        }

        .btn-div {
            /*text-align: center;*/
            padding: 20px 10px;
            background-color: #fff;
            margin-left: 90px;
        }

        .btn-div .btn {
            border-radius: 5px;
            color: #fff;
            width: 100px;
            height: 35px;
        }

        .btn-div .btn-ok {
            background-color: #fff;
            border: 1px solid #fc9d27;
            color: #fc9d27;
        }

        .info-ul li input {
            height: 30px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .user_name,
        .user_website {
            width: 233px;
        }

        .user_desc {
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }

        .avatar_img_jzc .avatar-view {
            width: 150px;
            height: 150px;
            margin-left: 80px;
        }
    </style>
@endsection

<!-- 主体内容 -->
@section('content')
    <div class="container body-container">
        <div class="site-body">
            <!-- 左侧 -->
            @include('user.nav', ['action' => 'info'])

            <!-- 右侧 -->
            <div class="left_cont">

                @include('common.success')
                @include('common.warning')

                <form method="POST" action="{{ route('user.infoUpdate', auth()->id()) }}">
                    @method('PUT')
                    @csrf

                    <div class="main-info">
                        <h1 class="site-h1">个人信息</h1>
                        <ul class="info-ul">

                            <li style="margin-top: 10px;">
                                <div class="title">用户名：</div>
                                <div class="data">
                                    <input class="username @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ auth()->user()->name }}">
                                </div>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                {{-- 回填表单 --}}
                                {{-- <input class="username" type="text" name="name" id="name" value="{{ old('name') }}"> --}}
                            </li>

                            <li style="margin-top: 10px;">
                                <div class="title">邮箱：</div>
                                <div class="data">
                                    <input class="email @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{ auth()->user()->email }}">
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                {{-- 回填表单 --}}
                                {{-- <input class="email" type="text" name="email" id="email" value="{{ old('email') }}"> --}}
                            </li>

                            <div class="btn-div">
                                <input type="submit" value="确认修改" class="btn btn-ok">
                                {{-- <button type="button" class="btn btn-ok">确认修改</button> --}}
                            </div>
                        </ul>
                    </div>
                </form>

                {{-- <script>
                    let token = null;
                    $(function() {

                        $.ajax({
                            url: '/token',
                            type: "get",
                            dataType: 'json',
                            success: function(json) {
                                if (json.code == 200) {
                                    layer.msg(json.msg);
                                    token = json.data.token;
                                }
                            }
                        });

                        $(".btn-ok").click(function() {
                            var username = $(".username").val();
                            if (!username) {
                                layer.msg('用户名不能为空', {
                                    icon: 0
                                });
                            }
                            var email = $(".email").val();
                            if (!email) {
                                layer.msg('邮箱不能为空', {
                                    icon: 0
                                });
                            }
                            $.ajax({
                                url: '/user/'+{{ auth()->id() }},
                                type: "put",
                                data: {
                                    username: username,
                                    email: email,
                                    _token: token,
                                },
                                dataType: 'json',
                                error: function() {
                                    layer.msg('网络错误！', {
                                        icon: 2
                                    });
                                },
                                success: function(json) {
                                    if (json.code == 200) {
                                        layer.msg(json.msg, {
                                            icon: 1
                                        });
                                        // window.location.reload();
                                    } else {
                                        layer.msg(json.msg, {
                                            icon: 2
                                        });
                                    }
                                }
                            });
                        });
                    });
                </script> --}}
            </div>
        </div>
    </div>
@endsection
