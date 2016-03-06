var async = require('async');
var fs = require("fs");

//Converter Class
var Converter = require("csvtojson").Converter;
var converter = new Converter({constructResult:false});


var places = [];

;

var exportFull = 'full.json';
var basedir = 'datasets/' ;
var files =['argentina-export.csv','chile-export.csv'];
var steps = [];


	
steps.push(function(cb){
		//read from file
	converter.fromFile(basedir + files[0],function(err,result){
		 console.log(files[0], err,result );
			places.concat(result); //here is your result jsonarray
			cb();
		});
	
});

	
steps.push(function(cb){
		//read from file
	converter.fromFile(basedir + files[1],function(err,result){
		 console.log(files[1], err,result );
			places.concat(result); //here is your result jsonarray
			cb();
		});
	
});

var finalProcess = function(){
	
	var data = JSON.stringify(places);
	fs.writeFile(exportFull, data, function(err) {
	    if(err) {
	      console.log(err);
	    } else {
	      console.log("JSON saved to " + exportFull);
	    }
	}); 
	
}

async.parallel(steps,finalProcess); 