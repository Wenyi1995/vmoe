<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>查看list</title>
  <link rel="stylesheet" href="/layui/css/layui.css">
</head>

<body>
<button type="button" class="layui-btn" id="addService">添加一条</button>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
  <legend>最近都有啥</legend>
</fieldset>
<ul class="layui-timeline" id="serviceList">


  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis"></i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title">8月15日</h3>
      <p>
        中国人民抗日战争胜利日
        <br>铭记、感恩
        <br>所有为中华民族浴血奋战的英雄将士
        <br>永垂不朽
      </p>
    </div>
  </li>
</ul>
<div id="page"></div>

</body>

<script src="/layui/layui.js"></script>
<script src="/js/common.js"></script>
<script type="text/html" id="serviceForm">


  <form class="layui-form" action="post">
    <div class="layui-form-item">
      <label class="layui-form-label">标题</label>
      <div class="layui-input-block">
        <input type="text" name="title" required lay-verify="required" placeholder="请输入标题" autocomplete="off"
               class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">内容</label>
      <div class="layui-input-block">
        <textarea name="content" placeholder="请输入" class="layui-textarea"></textarea>

      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">类型</label>
      <div class="layui-input-block">
        <input type="radio" name="type" value="1" title="提供" checked="">
        <input type="radio" name="type" value="2" title="需要">
      </div>
    </div>
    <div class="layui-form-item" pane="">
      <label class="layui-form-label">种类</label>
      <div class="layui-input-block">
        <input type="radio" name="serviceType" value="1" title="妆娘" checked="">
        <input type="radio" name="serviceType" value="2" title="道具">
        <input type="radio" name="serviceType" value="3" title="摄影">
      </div>
    </div>

    <div class="layui-inline">
      <label class="layui-form-label">定价区间</label>
      <div class="layui-input-inline" style="width: 100px;">
        <input type="text" name="lowPrice" placeholder="￥" autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid">-</div>
      <div class="layui-input-inline" style="width: 100px;">
        <input type="text" name="highPrice" placeholder="￥" autocomplete="off" class="layui-input">
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">开始时间</label>
      <div class="layui-input-block">
        <input type="text" name="startTime" required lay-verify="required" autocomplete="off" id="startTime"
               class="layui-input" placeholder="开始日期">
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">结束时间</label>
      <div class="layui-input-block">
        <input type="text" name="endTime" required lay-verify="required" autocomplete="off" id="endTime"
               class="layui-input" placeholder="结束日期">
      </div>
    </div>

    <div class="layui-form-item">
      <div class="layui-input-block">
        <button class="layui-btn" lay-submit lay-filter="service">立即提交</button>
      </div>
    </div>

  </form>

</script>
<script>

  layui.use(['layer', 'laypage', 'jquery','laydate','form'], function () {
    var layer = layui.layer, form = layui.form, $ = layui.$, laydate = layui.laydate;
    getServiceList()

    function getServiceList(page = 1) {
      $.ajax({
        beforeSend: function (request) {
          request.setRequestHeader("USER-TOKEN", token);
          request.setRequestHeader("Access-Control-Allow-Origin", '*');
        },
        url: urlIndex + '/service/list/' + page + '/1000', type: 'GET', success(result) {
          if (result.count) {
            html = ''
            $.each(result.list, function (k, v) {

              typeArr = {'1': '出', '2': '求'}
              serviceTypeArr = {'1': '妆娘', '2': '道具', '3': '摄影'}

              html += '<li class="layui-timeline-item">' +
                '<i class="layui-icon layui-timeline-axis"></i>' +
                '<div class="layui-timeline-content layui-text">' +
                ' <h3 class="layui-timeline-title">' + date_format(v.startTime) + ' - ' + date_format(v.endTime) + '</h3>' +
                '<p>' + v.title + '</p>' +
                '<p> ￥' + v.lowPrice + ' ~ ' + v.highPrice + '</p>' +
                '<ul>' +
                '<li> [' + typeArr[v.type] + ']' + serviceTypeArr[v.serviceType] + '</li>' +
                '</ul></div></li>'


            })
            $('#serviceList').html(html)
          }
        }, error(e) {
          layer.msg(e.responseText)
          if (e.status == 401) {
            window.location = '/login.html';
          }
        }
      });
    }

    $("#addService").click(function () {
      layer.open(
        {
          type: 1 //此处以iframe举例
          , title: '添加一条'
          , area: ['390px', '480px']
          , shade: 0
          , maxmin: true

          , content: $('#serviceForm').html()
          , zIndex: layer.zIndex //重点1
          , success: function (layero, index) {
            layer.setTop(layero); //重点2. 保持选中窗口置顶

            //记录索引，以便按 esc 键关闭。事件见代码最末尾处。
            layer.escIndex = layer.escIndex || [];
            layer.escIndex.unshift(index);
            //选中当前层时，将当前层索引放置在首位
            layero.on('mousedown', function () {
              var _index = layer.escIndex.indexOf(index);
              if (_index !== -1) {
                layer.escIndex.splice(_index, 1); //删除原有索引
              }
              layer.escIndex.unshift(index); //将索引插入到数组首位
            });
            form.render()
            laydate.render({
              elem: '#startTime'
              , type: 'datetime'
            });
            laydate.render({
              elem: '#endTime'
              , type: 'datetime'
            });
            form.verify();
            form.on('submit(service)', function (data) {
              postData = data.field
              postData.startTime = date2int(postData.startTime)
              postData.endTime = date2int(postData.endTime)

              $.ajax({
                beforeSend: function (request) {
                  request.setRequestHeader("USER-TOKEN", token);
                  request.setRequestHeader("Access-Control-Allow-Origin", '*');
                },
                url: urlIndex + '/service',
                data:postData ,
                type: 'POST',
                success(e) {
                  layer.closeAll();
                  window.reload()
                }, error(e) {
                  layer.msg(e.responseText)
                  if (e.status == 401) {
                    window.location = '/login.html';
                  }
                }
              });
              return false;
            });
          }
          , end: function () {
            //更新索引
            if (typeof layer.escIndex === 'object') {
              layer.escIndex.splice(0, 1);
            }
          }
        })
    })

  });
</script>

</html>
