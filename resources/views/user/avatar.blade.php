@extends('layout.app')

@section('title', '修改头像');

@section('style')
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('static/css/site.css') }}">
    <link href="{{ asset('static/lib/layui/cropper/cropper.css') }}" rel="stylesheet" type="text/css">
@endsection

<!-- 主体内容 -->
@section('content')
    <div class="container body-container">
        <div class="site-body">

            <!-- 左侧 -->
            @include('user.nav', ['action' => 'avatar'])

            <!-- 右侧 -->
            <div class="left_cont">
                {{-- <div class="main-info">
                    <h1 class="site-h1">修改头像</h1>
                    <div class="ml20 mt20">

                        <div class="layui-form-item" style="margin-left: 50px;">
                            <div class="layui-input-inline">
                                <div class="layui-upload-list" style="margin:0">
                                    <img src="/static/images/9250ac69d3f98a0f2a340c2876cbc9cf.jpg" id="srcimgurl" class="layui-upload-img" alt="点击修改头像" title="点击修改头像">
                                </div>
                            </div>
                        </div>

                        <div class="layui-form-item" style="margin-left: 50px;">
                            <div class="layui-input-inline layui-btn-container" style="width: auto;">
                                <button class="layui-btn layui-btn-primary" id="editimg">修改头像</button>
                            </div>
                        </div>

                    </div>
                </div> --}}

                <div class="main-info">
                    <h1 class="site-h1">修改头像</h1>
                    @include('common.error')
                    @include('common.success')
                    <form method="post" action="{{ route('user.avatar', auth()->id()) }}" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="ml20 mt20">

                            <div class="layui-form-item" style="margin-left: 50px;">
                                <div class="layui-input-inline">
                                    <div class="layui-upload-list" style="margin:0">
                                        <img src="{{ avatar(auth()->user()->avatar) }}"  class="layui-upload-img" style="max-width:120px;">
                                    </div>
                                </div>
                            </div>

                            <div class="layui-form-item" style="margin-left: 50px;">
                                <div class="layui-input-inline layui-btn-container" style="width: auto;">
                                    <label class="layui-btn layui-btn-primary" onclick="$('#avatar').trigger('click')">上传头像</label>
                                    <input type="file" name="avatar" id='avatar' class="hide">
                                </div>
                            </div>
                            <input class="layui-btn layui-btn-primary" type="submit" value="确定">
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        layui.config({
            base: '/static/lib/layui/cropper/' // layui自定义layui组件目录
        }).use(['form', 'croppers'], function() {
            var $ = layui.jquery,
                form = layui.form,
                croppers = layui.croppers,
                layer = layui.layer;

            // 创建一个头像上传组件
            var loadding = croppers.render({
                elem: '#editimg'
                ,saveW: 150 // 保存宽度
                ,saveH: 150
                ,mark: 1 / 1 // 选取比例
                ,area: '900px' // 弹窗宽度
                ,url: "/user/{{ auth()->id() }}/avatar" // 图片上传接口返回和（layui 的upload 模块）返回的JOSN一样
                ,method: 'patch'
                ,done: function(url) { // 上传完毕回调
                    $("#inputimgurl").val(url);
                    $("#srcimgurl").attr('src', url);
                    $("#user-center img").attr('src', url);
                }
            });
        });
    </script>
@endsection
