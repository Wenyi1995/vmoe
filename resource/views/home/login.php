<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>注册登陆</title>
  <link rel="stylesheet" href="/layui/css/layui.css">
</head>

<body>

<form class="layui-form" action="post">
  <div class="layui-form-item">
    <label class="layui-form-label">账号</label>
    <div class="layui-input-block">
      <input type="text" name="account" required lay-verify="required" placeholder="请输入账号" autocomplete="off"
             class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码</label>
    <div class="layui-input-block">
      <input type="password" name="pwd" required lay-verify="required" placeholder="请输入密码" autocomplete="off"
             class="layui-input">
    </div>
  </div>

  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="login">登陆</button>
      <button class="layui-btn" lay-submit lay-filter="register">注册</button>
    </div>
  </div>
</form>

<script src="/layui/layui.js"></script>
<script src="/js/common.js"></script>
<script>

  layui.use(['layer', 'form', 'jquery'], function () {
    var layer = layui.layer, form = layui.form, $ = layui.$;
    form.on('submit(login)', function (data) {
      $.ajax({
        url: urlIndex + '/login', type: 'post', data: data.field, success(result) {
          localStorage.setItem('user-token', result.token);
          window.location = urlIndex + '/home/index'
        }, error(e) {
          layer.msg(e.responseText)
        }
      });
      return false;
    });
    form.on('submit(register)', function (data) {
      $.ajax({
        url: urlIndex + '/register', type: 'post', data: data.field, success(result) {
          localStorage.setItem('user-token', result.token);
          window.location =  urlIndex + '/homeindex'
        }, error(e) {
          layer.msg(e.responseText)
        }
      });
      return false;
    });
  });
</script>
</body>

</html>
