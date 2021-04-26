const io = require('socket.io-client');
const socket = io('http://192.168.1.200:8192');
const Mysql = require('mysql');
const MysqlHelper = require('node-mysql-helper');
const cid = 'dps1';

const mysqlOptions = {
    host: 'localhost',
    user: 'nodesql',
    password: '1234',
    database: 'tpbdb',
    socketPath: false,
    connectionLimit: 10
};
let db = Mysql.createConnection(mysqlOptions);
db.connect();

socket.on('init_tpb'+cid, function(data) {
    db.query('show tables', function (error, results, fields) {
        if (error) throw error;

        results.forEach(element => {
            let table = element.Tables_in_tpbdb;

            db.query('select * from '+table, function (error, results, fields) {
                if (error) throw error;

                results.forEach(row => {
                    console.log(row);
                    socket.emit('smartone',{client: cid, table: table, data: row});
                });
            });
        });
    });
});

socket.on('tpb'+cid, function(data) {
    console.log(data);

    /*
        Mysql.insert(data.table, data.record)
            .then(function(info){
                //1;
            })
            .catch(function(err){
                console.log('mysql error:', err.message);
            });
    */
});
