<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>查看list</title>
  <link rel="stylesheet" href="/layui/css/layui.css">
</head>

<body>

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
<script>

  layui.use(['layer', 'laypage', 'jquery'], function () {
    var layer = layui.layer, flow = layui.flow, $ = layui.$;
    getServiceList()
    function getServiceList(page = 1) {
      $.ajax({
        beforeSend: function (request) {
          request.setRequestHeader("USER-TOKEN", token);
          request.setRequestHeader("Access-Control-Allow-Origin", '*');
        },
        url: urlIndex + '/service/list/' + page + '/1000', type: 'GET', success(result) {
          if(result.count){
            html = ''
            $.each(result.list,function (k,v){

              typeArr = {'1':'出','2':'求'}
              serviceTypeArr = {'1' :'妆娘', '2' :'道具', '3': '摄影'}

              html += '<li class="layui-timeline-item">'+
                '<i class="layui-icon layui-timeline-axis"></i>'+
                '<div class="layui-timeline-content layui-text">'+
                 ' <h3 class="layui-timeline-title">'+date_format(v.startTime)+' - '+date_format(v.endTime)+'</h3>'+
                  '<p>'+v.title+'</p>'+
                  '<p> ￥'+v.lowPrice+' ~ '+v.highPrice+'</p>'+
                  '<ul>'+
                    '<li> ['+typeArr[v.type] + ']' +serviceTypeArr[v.serviceType]+'</li>'+
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
  });
</script>

</html>
