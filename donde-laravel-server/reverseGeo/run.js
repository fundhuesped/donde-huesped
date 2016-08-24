var geocoderProvider = 'google';
var httpAdapter = 'https';
var fs = require("fs");
var async = require("async");
var json2csv = require('nice-json2csv');
// optionnal
var extra = {
    apiKey: 'AIzaSyACdNTXGb7gdYwlhXegObZj8bvWtr-Sozc', // for Mapquest, OpenCage, Google Premier
    formatter: null         // 'gpx', 'string', ...
};

var geocoder = require('node-geocoder')(geocoderProvider, httpAdapter, extra);


//Converter Class
var Converter = require("csvtojson").Converter;
var converter = new Converter({});

var i = 0;

// var top = ;
//end_parsed will be emitted once parsing finished
converter.on("end_parsed", function (data) {
      
       var top = data.length;
       
       async.eachSeries(data, function(item, callback) {
                  console.log('start');
                  getAddress(item,callback);
                
            }, function(err){
                // if any of the file processing produced an error, err would equal that error
                if( err ) {
                  // One of the iterations produced an error.
                  // All processing will now stop.
                  console.log('error ', err);
              }
                  saveResult();
                
            });
 
     
   
});

var baseName = "uru";
var baseFolder = "06ABR2016";

var saveResult = function(){
    var csvContent = JSON.stringify(results);
    console.log('saving...');
    fs.writeFile("raw-datasets/"+baseFolder + "/"+ baseName+  "-export.json", csvContent);
    console.log('saveResult');
}

//read from file
fs.createReadStream("raw-datasets/"+baseFolder + "/"+ baseName+  ".csv")
    .pipe(converter);

var results = [];
var errCount = 0;

var getAddress = function(d,cb){
    //Si esta localizado, me voy
    if (d.latitude > 0){
        console.log(d.latitude);

        cb();
    }

    
    var first = ""
    if (!d.altura && !d.numero){
        first = d.calle;
        if (d.cruce){
            first += " " + d.cruce;
        }
    }else {
        var n = 0;
        if (d.altura){
            n = d.altura;
        }
        if (d.numero){
            n = d.numero
        }
        first = n + " " + d.calle;
    }   
    var address = first +  " , " + d.partido_comuna + " , " + d.barrio_localidad +  " , " +  d.provincia_region + ", " + d.pais;
    geocoder.geocode(address)
        .then(function(res) {
          
            if(d){
                d.latitude = res[0].latitude;
                d.longitude = res[0].longitude;
                if (res[0].extra){
                    d.confidence = res[0].extra.confidence;
                }
                console.log(address, d.latitude, d.longitude, d.confidence);
            }
            else {
                 d.fail = "empty result";
                d.source = address;
                console.log(console.log(err));
            }
          
             results.push(d);
           setTimeout(cb, 25);
        })
        .catch(function(err) {
            console.log(err);
            d.fail = err;
            d.source = address;
            results.push(d);
            //Si hay muchos errores me voy
             saveResult();
            setTimeout(cb, 25); 
           
            
            
        });

}

