const io = require('socket.io-client');
//const socket = io('http://192.168.1.200:8192');
const socket = io('http://smartone.smartnusantara.id:8192');
const MySQLEvents = require('@cenkingunlugu/mysql-events');
const mysql = require('mysql');
const timeout = 5000;
const cid = 'dps1';

let db_config = {
    host: 'localhost',
    user: 'beacukai',
    password: 'beacukai',
    database: 'tpbdb'
};

let db;
let dbstatus = false;

function handleDisconnect() {
    db = mysql.createConnection(db_config);

    db.connect(function(err) {
        if(err) {
            console.log('Waiting for reconnecting...');
            dbstatus = false;
            setTimeout(handleDisconnect, timeout);
        } else {
            dbstatus = true;
            program()
                .then(() => console.log('Waiting for database events...'))
                .catch(function(err) {
                    //console.log('event listener error', err);
                    //console.log('Listening database stopped.')
                });
        }
    });

    db.on('error', function(err) {
        console.log('Trying reconnect...');
        dbstatus = false;
        if(err.code === 'PROTOCOL_CONNECTION_LOST') {
            handleDisconnect();
        } else {
            //throw err;
            console.log('OTHER ERROR');
        }
    });
}

handleDisconnect();

const program = async () => {
    const instance = new MySQLEvents(db, {
        startAtEnd: true,
        excludedSchemas: {
            mysql: true,
        },
    });

    await instance.start();

    instance.addTrigger({
        name: 'TPB',
        expression: 'tpbdb.*',
        statement: MySQLEvents.STATEMENTS.ALL,
        onEvent: (event) => {
            //console.log(event);
            let record;
            if(event.type === 'DELETE') record = event.affectedRows[0].before;
            else record = event.affectedRows[0].after;
            socket.emit('smartone',{client: cid, table: event.table, type: event.type, record: record});
        },
    });

    instance.on(MySQLEvents.EVENTS.CONNECTION_ERROR, (err) => {
        console.log('MySQL Events Listener Stopped.')
    });
    //instance.on(MySQLEvents.EVENTS.ZONGJI_ERROR, console.error);
};

socket.on('init_tpb'+cid, function(data) {
    if(dbstatus)
        db.query('show tables', function (error, results, fields) {
            if (error) throw error;

            results.forEach(element => {
                let table = element.Tables_in_tpbdb;

                db.query('select * from '+table, function (error, results, fields) {
                    if (error) throw error;

                    results.forEach(row => {
                        console.log(row);
                        socket.emit('smartone',{client: cid, table: table, record: row});
                    });
                });
            });
        });
});

socket.on('tpb'+cid, function(data) {
    console.log("Data from Smartone...");
    writeToDB(data);
});

function writeToDB(data) {
    if(dbstatus){
        let tipe = data.type.toLowerCase();

        switch (tipe) {
            case "insert":
                db.query("insert into "+data.table+" set ? ", data.record, function(err, rows){
                    if(err)
                        console.log("Inserting data failed. "+err);
                    console.log("Insert new record to table "+data.table+" with ID : "+data.record.ID);
                });
                break;
            case "update":
                db.query("update "+data.table+" set ? where ID = ?", [data.record, data.record.ID], function(err, rows){
                    if(err)
                        console.log("Updating data failed. "+err);
                    console.log("Update record to table "+data.table+" with ID : "+data.record.ID);
                });
                break;
            case "delete":
                db.query("delete from "+data.table+" where ID = ?", [data.record.ID], function(err, rows){
                    if(err)
                        console.log("Deleting data failed. "+err);
                    console.log("Delete record from table "+data.table+" with ID : "+data.record.ID);
                });
                break;
            default:
                break;
        }
    } else {
        console.log("Database Operation Failed. Trying to reconnect...");
        setTimeout(writeToDB, timeout);
    }
}