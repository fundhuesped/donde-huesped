var geocoderProvider = 'google';
var httpAdapter = 'https';
var fs = require("fs");
var json2csv = require('nice-json2csv');
// // optionnal
// var extra = {
//     apiKey: 'YOUR_API_KEY', // for Mapquest, OpenCage, Google Premier
//     formatter: null         // 'gpx', 'string', ...
// };

var geocoder = require('node-geocoder')(geocoderProvider, httpAdapter);


//Converter Class
var Converter = require("csvtojson").Converter;
var converter = new Converter({});

var i = 0;
// var top = ;
//end_parsed will be emitted once parsing finished
converter.on("end_parsed", function (data) {
      console.log('hey');
       var top = data.length;
       var next = function(){
           var d = data[i];
           getAddress(d, function(){
                if (i + 1 < top){
                    setTimeout(function(){
                        i++;
                        next();
                    },500)
                    
                }else {
                    saveResult();
                }
           });
      };
      next();
   
});

var saveResult = function(){


    var csvContent = json2csv.convert(results);
    fs.writeFile("datasets/argentina-distr-export.csv", csvContent);

}

//read from file
fs.createReadStream("datasets/argentina-distr.csv")
    .pipe(converter);

var results = [];

var getAddress = function(d,cb){


    var first = ""
    if (!d.altura){
        first = d.calle;
        if (d.cruce){
            first += " " + d.cruce;
        }
    }else {
        first = d.altura + " " + d.calle;
    }   
    var address = first +  " , " + d.partido_comuna_dpto + " , " +  d.provincia + ", Argentina";
    geocoder.geocode(address)
        .then(function(res) {
            d.latitude = res[0].latitude;
            d.longitude = res[0].longitude;
            if (res[0].extra){
                d.confidence = res[0].extra.confidence;
            }
            console.log(address, d.latitude, d.longitude, d.confidence);
            results.push(d);
            cb();
        })
        .catch(function(err) {

            d.fail = err;
            results.push(d);
            console.log(err);
            cb();
        });

}

