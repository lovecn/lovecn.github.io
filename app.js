// http://www.hubwiz.com/class/543b9914032c781494012b65
/*var io = require('socket.io')(8888);
io.on('connection',function(socket){
     //连接成功...
     socket.on('disconnect',function(){
         //用户已经离开...
     });
});*/
var express = require('express');
var app = express();
app.get('/',function(req,res){
  res.status(200).send('欢迎来到汇智网学习！');
});
app.get('/index',function(req,res){
   res.sendFile('index.html',{root:__dirname});
});
var server = require('http').createServer(app);
var io = require('socket.io')(server);
io.on('connection',function(socket){
          socket.send('汇智网欢迎你！');
  socket.on('message',function(data){
      //收到消息 为socket注册message事件来接收客户端发送过来的消息。
      console.log(data);
  });
});
server.listen(8888);
<script src="https://cdn.socket.io/socket.io-1.2.1.js"></script>
// index.html http://www.hubwiz.com/class/543b9914032c781494012b65
var socket = io.connect('/');
socket.on('connect',function(){
   //客户端连接成功后发送消息'hello world!'
   socket.send('hello world!');
});
socket.on('message',function(data){
   alert(data);//在message事件中接收到发送过来的消息
});