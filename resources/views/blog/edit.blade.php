@extends('layout.app')

@section('title', '博客修改')

@section('style')
    <!-- css -->
    <link href="{{ asset('static/css/tab.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/layout.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/weui.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/serviceCommon.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/serviceEnter.css') }}" rel="stylesheet" type="text/css">
    <style>
        #img {
            height: 100px;
            width: auto;
            display: none;
        }

        #demo2 img {
            width: 140px;
        }

        .test {
            display: none;
        }
    </style>
@endsection

<!-- 主体内容 -->
@section('content')

    <!-- <header class="navbar navbar-expand-lg navbar-dark bg-dark" id="header"></header> -->
    <main id="body" style="margin-top: 150px;">
        <div class="container service-enter">

            @include('common.error')
            @include('common.success')
            <form method="post" action="{{ route('blog.update', $blog) }}">
                @csrf
                @method('put')
                <!-- 分类 -->
                <div class="display-flex flex-warp content-wrap">
                    <span class="display-flex justify-end align-center content-name">
                        <i class="fa fa-star icon" aria-hidden="true"></i>
                        <span class="content-field">分类：</span>
                    </span>
                    <div class="content-right">
                        <select class="service-select input-value" title="分类" name="category_id">
                            <option value="0">选择分类</option>
                            @foreach (categorys() as $id => $name)
                                @if ( old('category_id') )
                                <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : ''}}>{{ $name }}</option>
                                @else
                                <option value="{{ $id }}" {{ $blog['category_id'] == $id ? 'selected' : ''}}>{{ $name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- 标题 -->
                <div class="display-flex flex-warp content-wrap">
                    <span class="display-flex justify-end align-center content-name">
                        <i class="fa fa-star icon" aria-hidden="true"></i>
                        <span class="content-field">标题：</span>
                    </span>
                    <div class="content-right">
                        <input type="text" placeholder="请输入" maxlength="50" class="input-commom input-value" title="标题：" name="title" value="{{ old('title') ? old('title') : $blog['title'] }}">
                    </div>
                </div>

                <!-- 内容 -->
                <div class="display-flex flex-warp content-wrap">
                    <span class="display-flex justify-end align-center content-name">
                        <i class="fa fa-star icon" aria-hidden="true"></i>
                        <span class="content-field">内容：</span>
                    </span>
                    <div class="content-right">
                        <script id="container" name="content" type="text/plain"></script>
                    </div>
                </div>

                <div class="display-flex flex-warp content-wrap" style="margin-top: 66px;"
                    class="display-flex justify-end content-name">
                    <span class="display-flex justify-end content-name"></span>
                    <div class="content-right" style="height: 136px;">
                        <div style="height: 50px;">
                            <input type="submit" value="确认发布" class="submit-btn">
                            <input type="hidden" name='id' value="{{ $blog['id'] }}">
                        </div>
                    </div>
                </div>
            <form>
        </div>
    </main>
@endsection

@section('script')

    <script type="text/javascript" src="{{ asset('static/lib/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/lib/ueditor/ueditor.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/lib/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
    <script type="text/javascript">
        // 富文本
        var ue = UE.getEditor('container', {
            initialFrameWidth: '100%',
            initialFrameHeight: 200,
            allowDivTransToP: false,
            autoClearEmptyNode: false
        });
        $('#container').html({{ $content }});
    </script>

@endsection
