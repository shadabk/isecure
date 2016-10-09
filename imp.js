var async = require('async');
var express = require('express');
var router = express.Router();
var bp = require('body-parser');
var connection;
var http = require('http');
var port = normalizePort(process.env.PORT ||"3000");
http.createServer();
async.waterfall([
        function(callback) {
            var mysql = require('mysql');
            connection = mysql.createConnection({
                host: '127.0.0.1',
                user: 'root',
                password: '',
                database: 'ait'
            });
            callback(null);
        },
        function(callback) {
            connection.connect(function(err) {
                if (err) {
                    console.log('Error connecting to Db');
                    console.log(err);
                    callback(err, null);
                }
                console.log('Connection established');
            });
            callback(null);
        },
        function(callback){
          connection.query('create table if not exists coefs( id INT(10) NOT NULL'+
          'AUTO_INCREMENT,ts TIMESTAMP(6),name varchar(25),XY double(10),YZ double(10),ZX double(10),primary key (id)'+
          ')ENGINE=InnoDB', function(err, rows) {
              callback(null);
          });
        },
        function(callback){
        }
      ]);

router.use(bp.json());
router.post('/'), function(req, res, next){
  var obj = req.body.obj;
  console.log("Mila: " + obj);
}
