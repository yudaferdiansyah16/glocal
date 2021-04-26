const io = require('socket.io-client');
//const socket = io('http://localhost:8192');
const socket = io('http://smartone.smartnusantara.id:8192');
const mysql = require('mysql');
const timeout = 5000;
const cid = 'dps1';

let mysqlOptions = {
    host: 'localhost',
    user: 'smart',
    password: 'nusantar4NLS',
    database: 'smartone',
    socketPath: false,
    connectionLimit: 10
};

let db;
let dbstatus = false;

function handleDisconnect() {
    db = mysql.createConnection(mysqlOptions);

    db.connect(function(err) {
        if(err) {
            console.log('Waiting for reconnecting...');
            dbstatus = false;
            setTimeout(handleDisconnect, timeout);
        } else {
            dbstatus = true;
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

socket.on('smart'+cid, function(data) {
    console.log("Data from TPB...");
    checkTable(data);
});

function checkTable(data) {
    if(dbstatus) {
        let tipe = data.type.toLowerCase();
        switch (tipe) {
            case "insert":
                db.query("select count(*) jumlah from "+data.table+" where ID = ? ", data.record.ID, function(err, rows){
                    if(err)
                        console.log("Checking Data Failed. ");
                    if(!rows[0].jumlah)
                        writeToDB(data);
                });
                break;
            case "update":
                writeToDB(data);
                break;
            case "delete":
                db.query("select count(*) jumlah from "+data.table+" where ID = ? ", data.record.ID, function(err, rows){
                    if(err)
                        console.log("Checking Data Failed. ");
                    if(rows[0].jumlah)
                        writeToDB(data);
                });
                break;
        }
    } else {
        console.log("Database Operation Failed. Trying to reconnect...");
        setTimeout(checkTable, timeout);
    }
}

function writeToDB(data) {
    if(dbstatus){
        let tipe = data.type.toLowerCase();

        switch (tipe) {
            case "insert":
                db.query("insert into "+data.table+" set ? ", data.record, function(err, rows){
                    if(err)
                        console.log("Inserting data failed. "+err);
                    console.log("Insert new record from TPB to table "+data.table+" with ID : "+data.record.ID);
                });
                break;
            case "update":
                db.query("update "+data.table+" set ? where ID = ?", [data.record, data.record.ID], function(err, rows){
                    if(err)
                        console.log("Updating data failed. "+err);
                    console.log("Update record from TPB to table "+data.table+" with ID : "+data.record.ID);
                });
                break;
            case "delete":
                db.query("delete from "+data.table+" where ID = ?", [data.record.ID], function(err, rows){
                    if(err)
                        console.log("Deleting data failed. "+err);
                    console.log("Delete record from TPB to table "+data.table+" with ID : "+data.record.ID);
                });
                break;
        }
    } else {
        console.log("Database Operation Failed. Trying to reconnect...");
        setTimeout(writeToDB, timeout);
    }
}