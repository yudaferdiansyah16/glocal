const app = require('express')();
const bodyParser = require('body-parser');
const server = require('http').Server(app);
const io = require('socket.io')(server);
app.use(bodyParser.json());
server.listen(8192);

io
    .on('connection', function(socket){
        socket.on('connect', function(data){
            console.log(data);
        });

        socket.on('smartone', function(o){
            console.log("Data from TPB to Smartone. Client ID : "+o.client);
            io.sockets.emit('smart'+o.client, o);
        });
    });

app.post('/totpb/:data', function(req, res){
    console.log("Sending data to TPB. Client ID : "+req.params.data);
    io.sockets.emit('tpb'+req.params.data, req.body);
    res.sendStatus(200);
});

app.post('/init/:data', function(req, res){
    console.log("Request data initialization from TPB to Smartone... Client ID : "+req.params.data);
    io.sockets.emit('init_tpb'+req.params.data, req.body);
    res.sendStatus(200);
});