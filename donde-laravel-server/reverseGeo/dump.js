var mysqlDump = require('mysqldump');
 
mysqlDump({
	host: 'us-cdbr-iron-east-03.cleardb.net',
	user: 'b1007d9371bfe6',
	password: 'ecc3af85',
	database: 'heroku_ba201e13d0ee73b',
	ifNotExist:true, 
	dest:'./data.sql' // destination file 
},function(err){
	if (err){
		console.log(err);
	}
	else {
		console.log('ok!');
	}

});
