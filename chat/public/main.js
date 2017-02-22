var socket = io.connect();

$('button[type=submit]').click(function(){
    socket.emit('chat message', $('#input').val());
    $('#input').val('');
    return false;
});
socket.on('news', function (data) {
    $('#message').append($('<li>').text(data.hello));
});
socket.on('reply message', function (data) {
    $('#message').append($('<li>').text(data));
});