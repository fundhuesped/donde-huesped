var mysql = require('mysql');
var fs = require('fs');
var readline = require('readline');
var connection = mysql.createConnection({
	multipleStatements: true,
   host: 'us-cdbr-iron-east-03.cleardb.net',
   port: '3306',
   database: 'heroku_ba201e13d0ee73b',
   user: 'b1007d9371bfe6',
   password: 'ecc3af85'
});
  fs.readFile('database/01-main.sql', "utf8", function(err, data) {
        if (err) throw err;
        connection.query(data, function(er, results) {
    		  if (er) throw er;

    		  // `results` is an array with one element for every statement in the query:
    		  console.log(data, results); 
    		  });
    });



