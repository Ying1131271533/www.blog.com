<style type="text/css">
    .icon{
        font-size: 22px;
    }
</style>
<div class="left_nav">
    <ul>
        <li>
            <span class="nav_span">
                <svg class="icon" aria-hidden="true">
                  <use xlink:href="#icon-yonghu"></use>
                </svg>
            </span>
            <a href="javascript:;">个人中心</a>
            <ul class="second">
                <li class="{{ $action != 'info' ?: 'active' }}"><a href="{{ route('user.info') }}">个人信息</a></li>
                <li class="{{ $action != 'avatar' ?: 'active' }}"><a href="{{ route('user.avatar', auth()->id()) }}">修改头像</a></li>
                <li class="{{ $action != 'blog' ?: 'active' }}"><a href="{{ route('user.blog') }}">我的博客</a></li>
            </ul>
        </li>
    </ul>
</div>
