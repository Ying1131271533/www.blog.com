<!-- 头部文件 -->
<header class="header">
    <nav class="nav-menu navbar-fixed-top navbar" style="height:100px;">
        <!-- 最顶部 -->
        <!-- 最顶部 -->
        <div class="container kjy_top_nav" style="border:none;height: 100px;background-color: #fff;">
            <ul id="w1" class="navbar-nav navbar-left nav">
                <li>
                    <div>
                        <a href="{{ route('index') }}" style="background-color: none">
                            <img src="/static/images/logo.png" class="menu_logo" alt="草帽跨境">
                            <img src="/static/images/top_2.png" class="menu_logo_right_abc" alt="草帽跨境">
                        </a>
                    </div>
                </li>
                <!-- <li class="items select_li_padding"> -->
                <li class="sousuoItem" style="display:flex;flex-direction:column;">

                    <form method="get" action="{{ route('index') }}" name="example" id="form_search">
                        <div class="home_search_word" style="width: 520px;">
                            <div class="searchShowCont" style="float: left;height: 32px;">

                                <div class="layui-form" style="width: 210px;margin-left: -95px;">
                                    <div class="layui-form-item">
                                        <div class="layui-input-block" style="height: 30px">
                                            <select class="layui-input-block" title="分类" name="category_id">
                                                <option value="0">站内搜索</option>
                                                @foreach (categorys() as $id => $name)
                                                    <option value="{{ $id }}"
                                                    @if (request()->query('category_id') == $id) selected="selected" @endif
                                                    >{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="searchShowCont" style="float: left;height: 32px;">
                                <input name="keyword" id="keyword_search" autofocus="autofocus" value="{{ request()->query('keyword') }}"
                                    type="text" placeholder="请输入搜索内容" class="keyword_search_input"
                                    style="width:295px;">
                                <span id="fangdajing">搜索</span>
                            </div>
                        </div>
                    </form>

                    <!--搜索输入框下部-->
                    <div class="cif-header__word cifnews_block">
                        <a href="{{ route('blog.create') }}">发布博客</a>
                        <a href="{{ route('user.info') }}">个人中心</a>
                    </div>

                </li>


                <input type="hidden" name="user_type" value="0" class="user_type">
                <input type="hidden" name="user_service_id" value="0" class="user_service_id">

                @auth

                    <!-- 已登录 -->
                    <li>
                        {{ auth()->user()->name }}
                    </li>
                    <li class="user-menu-container">
                        <div class="userInfo">
                            <a href="{{ route('user.info') }}" id="user-center">
                                <img src="{{ avatar(auth()->user()->avatar) }}"
                                    style="max-width:38px;">
                            </a>
                        </div>
                        <div class="user-menu-top" aria-labelledby="user-center" style="display: none;">
                            <p><a href="{{ route('user.info') }} ">个人信息</a></p>
                            <p><a href="{{ route('user.avatar', auth()->id()) }} ">修改头像</a></p>
                            <p><a href="{{ route('user.blog') }} ">我的博客</a></p>
                            <form method="POST" action="{{ route('logout') }}" id="logout">
                                @csrf
                                <p><a href="javascript:" onclick="$('#logout').submit()">退出</a></p>
                            </form>
                        </div>
                    </li>
                @else
                    <!-- 未登录 -->
                    <li class="task-li taskliMenu" id="padding0_nav">
                        <p>
                            <a href="{{ route('login') }} ">
                                <button type="button" id="denglu_btn" class=" btn-header">登录</button>
                            </a>
                            <a href="{{ route('register') }} ">
                                <button type="button" id="denglu_btn" class=" btn-header">注册</button>
                            </a>
                        </p>
                    </li>

                @endauth
            </ul>
        </div>

    </nav>
</header>
