var token = localStorage.getItem('user-token');
var urlIndex = 'http://192.168.50.148:18306/api/v1';

function date_format(timestamp) {
  var date = new Date(timestamp * 1000); //时间戳为10位需*1000，时间戳为13位的话不需乘1000
  var Y = date.getFullYear();
  var M = date.getMonth() + 1;
  var D = date.getDate();
  var h = date.getHours();
  var m = date.getMinutes() === 0 ? '00' : date.getMinutes();
  var s = date.getSeconds();
  return Y + '年' + M + '月' + D + '日 ';
}
