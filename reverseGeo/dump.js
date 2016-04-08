var mysqlDump = require('mysqldump');
 
mysqlDump({
	host: 'us-cdbr-iron-east-03.cleardb.net',
	user: 'ba653b684c7109',
	password: '03ade712',
	database: 'heroku_6bd2ee3def67785',
	dest:'./data.sql' // destination file 
},function(err){
	if (err){
		console.log(err);
	}
	else {
		console.log('ok!');
	}

});
