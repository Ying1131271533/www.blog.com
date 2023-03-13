<script src="{{ asset('static/js/jquery.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('static/lib/layer/layer.js') }}"></script>
<script src="{{ asset('static/lib/layui/layui.js') }}"></script>
<script src="{{ asset('static/iconfont/iconfont.js') }}"></script>
<script src="{{ asset('static/js/search.js') }}"></script>
<script src="{{ asset('static/js/sweetalert2.min.js') }}"></script>
<script>
    // 一些公共的脚本
    // Demo
    layui.use('form', function() {
        var form = layui.form;

        //监听提交
        form.on('submit(formDemo)', function(data) {
            layer.msg(JSON.stringify(data.field));
            return false;
        });
    });

    // 头像下拉
    $('.user-menu-container').mouseover(function() {
        $('.user-menu-top').show();
    });
    $('.user-menu-container').mouseout(function() {
        $('.user-menu-top').hide();
    });

    function notiy(icon, title) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'middle',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
        })

        Toast.fire({
            icon: icon,
            title: title
        })
    }

    // ajax全局设置
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('script')
