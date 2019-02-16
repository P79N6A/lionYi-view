<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta author="JerryChen">
	<title>{{<$title|default:'登陆'>}}</title>
	<link rel="stylesheet" type="text/css" href="{{<$static_host>}}page/css/register-login.css">
</head>
<body>
<div id="box"></div>
<div class="cent-box">
	<div class="cent-box-header">
		<h1 class=" hide"><img style="width:100px;" src="{{<$logo|default:'http://bear.jerryblog.cn/bear/images/blank.png'>}}" alt=""></h1>
		<h2 class="sub-title">bear PHP开发助手，让开发更简单</h2>
	</div>

	<div class="cont-main clearfix">
		<div class="index-tab">
			<div class="index-slide-nav">
				<a href="{{<$loginurl|default:'#'>}}" class="active">登录</a>
				<a href="{{<$regurl|default:'#'>}}">注册</a>
				<div class="slide-bar"></div>				
			</div>
		</div>
		<form action="{{<$action|default:''>}}" class="tForm" method="post">
			<div class="login form ">
				<div class="group">
					<div class="group-ipt email">
						<input type="text" name="email" id="email" class="ipt" placeholder="邮箱地址" >
					</div>
					<div class="group-ipt password">
						<input type="password" name="password" id="password" class="ipt" placeholder="输入您的登录密码" >
					</div>
					<!-- <div class="group-ipt verify">
						<input type="text" name="verify" id="verify" class="ipt" placeholder="输入验证码" required>
						<img src="imgcode?id=" class="imgcode">
					</div> -->
				</div>
			</div>

		<div class="button">
			<a  class="login-btn register-btn tPost" id="button" style="text-align:center;">登录</a>
		</div>
	</form>
		<!-- <div class="remember clearfix">
			<label class="remember-me"><span class="icon"><span class="zt"></span></span><input type="checkbox" name="remember-me" id="remember-me" class="remember-mecheck" checked>记住我</label>
			<label class="forgot-password">
				<a href="#">忘记密码？</a>
			</label>
		</div> -->
	</div>
</div>

<div class="footer">
	<p>{{<$copyright|default:'power by JerryChen'>}}</p>
</div>
  <script src="{{<$static_host>}}plus/layui/layui.all.js" charset="utf-8"></script>
    <script src="/static/admin/bear/js/bear.js" charset="utf-8"></script>
  <script src="/static/admin/bear/js/bearForm.js" charset="utf-8"></script>
  <script src="/static/admin/bear/js/bearMethod.js" charset="utf-8"></script>
<script src='{{<$static_host>}}page/js/particles.js' type="text/javascript"></script>
<script src='{{<$static_host>}}page/js/background.js' type="text/javascript"></script>


</body>
</html>