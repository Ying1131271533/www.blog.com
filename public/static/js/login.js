var scene = '';
var QrcodeShow = false;

$(function () {

	$("#sub-login").click(function () {

		var username = $("#username").val();
		var password = $("#password").val();
		var verifyCode = $("#verifyCode").val();
		if (username == '' || password == '') {
			layer.msg('请输入登录信息', {icon: 0});
			return false;
		}

		if(verifyCode == ''){
			layer.msg('请输入图片验证码', {icon: 0});
			return false;
		}

		if($('.rember').is(':checked')){
			rember = true;
		}else{
			rember = false;
		}

		var loadding = layer.load();


		$.ajax({
			url: "/login",
			type: "POST",
			data: {
				username: username,
				password: password,
				rember: rember,
				verifyCode:verifyCode,
				type: 2,
				lasturl: $('#lasturl').val(),
			},
			dataType: "json",
			jsonp: "callback",
			success: function (json) {
				layer.close(loadding);

				if (json.code == 200) {
					// 保存jwt
					storage('token', json.data.token);
					console.log('token：'+json.data.token);
					delete json.data.token;

					layer.msg('登录成功，正在跳转页面...', {icon: 1});
					setTimeout(function () {
						window.location.href = $('#lasturl').val();
					}, 500);
				} else {
					$('#captcha_login').trigger('click');
					layer.msg(json.msg, {icon: 2});
				}
			},
			error: function () {
				// $('#sub-login').trigger('click');
				layer.close(loadding);
				layer.msg("网络错误！", {icon: 2});
			}
		});


	});


	// 提交注册
	$("#sub-register").click(function () {
		// 验证手机号
		var phone = $("#phone").val();
		if (phone == '') {
			layer.msg('请输入正确的手机号码', {icon: 0});
			$("#phone").focus();
			return false;
		}

		if ($("#code").val() == '' || $("#code").val() == "undefined") {
			layer.msg('请填写验证码', {icon: 0});
			$("#code").focus();
			return false;
		}
		var username = $("#username").val();
		if (username == '') {
			layer.msg('请填写用户名', {icon: 0});
			$("#username").focus();
			return false;
		}
		if (!username.match(/^[a-zA-Z][a-zA-Z0-9]{5,19}$/)) {
			layer.msg('用户名只能为英文字母和数字，首字母不能为数字，长度6-20', {icon: 0});
			$("#username").focus();
			return false;
		}
		var password = $("#password").val();
		if (password == '') {
			layer.msg('请填写密码', {icon: 0});
			$("#password").focus();
			return false;
		}
		if (!password.match(/^[a-zA-Z0-9]{8,20}$/)) {
			layer.msg('密码只能为英文字母或者数字，长度必须为8-20', {icon: 0});
			$("#password").focus();
			return false;
		}
		var agreement = $('#agreement')[0].checked;
		if (!agreement) {
			layer.msg('请阅读并同意用户协议', {icon: 0});
			return false;
		}
		var loading = layer.load();
		$.ajax({
			url: "/register",
			type: "POST",
			data: $(".registerForm").serialize(),
			dataType: "json",
			success: function (json) {
				layer.close(loading);
				if (json.code == 200) {
					// 保存jwt
					storage('token', json.data.token);
					layer.msg('注册成功，正在自动登录...', {icon: 1});
					setTimeout(function () {
						window.location.href = $('#lasturl').val();
					}, 500)
				} else {
					layer.msg(json.msg, {icon: 2});
				}
			},
			error: function () {
				layer.close(loading);
				layer.msg('网络错误！', {icon: 2});
			}
		});
	});
});
