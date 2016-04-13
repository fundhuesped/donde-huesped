var fs = require("fs");
var jsonminify = require("jsonminify");

//Converter Class
var Converter = require("csvtojson").Converter;
var converterCABA = new Converter({});
var converterBB = new Converter({});


var fullSet = JSON.parse(fs.readFileSync('public/datasets/full-unified.json', 'utf8'));


function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
var unify = function(){


    

       
    var newSet = fullSet;

  

    
        console.log(newSet.length,'newSet');
       
    var initSet = JSON.stringify(newSet);
    fs.writeFile('public/datasets/full-unified.json',initSet , function(err) {
        if(err) {
            return console.log(err);
        }
        var full = JSON.parse(fs.readFileSync('public/datasets/full-unified.json', 'utf8'));

          console.log(full.length,'full');
                  console.log("The file was saved!");
    }); 



}




var processCABA = function(err,argNewCaba){
        
        var oldCaba =[];
        var newCaba = [];

        console.log(err);

        for (var i = 0; i < argNewCaba.length; i++) {
            //Si esta en...
            var item = argNewCaba[i]
            var provincia_region = item.provincia_region;
            if (provincia_region === "Ciudad Autónoma de Buenos Aires" || provincia_region ==="CABA"){
                newCaba.push(item);
            }
           
        }
        var count = 0;
        for (var i = 0; i < arg.length; i++) {
            //Si esta en...
            var item = arg[i];


            //Actualizo CABA
            var provincia_region = item.provincia_region;
            if (provincia_region === "Ciudad Autónoma de Buenos Aires" 
                || provincia_region ==="CABA"){
                
                for (var j = 0; j < newCaba.length; j++) {
                    var update = newCaba[j];

                    if (update.establecimiento === item.establecimiento){

                        item.partido_comuna = update.partido_comuna;
                        item.barrio_localidad = update.barrio_localidad;
                        item.provincia_region =  "Ciudad Autónoma de Buenos Aires";//update.provincia_region;

                        count++;
                        // console.log('converted! ', count ,
                        //     item.provincia_region, 
                        //     item.barrio_localidad, item.establecimiento);
                         arg[i] = item;
                        break;
                    }

                };
            }
            //actualizo la plata
            var partido_comuna = item.partido_comuna.toLowerCase();
            var barrio_localidad = item.barrio_localidad.toLowerCase();
            if (partido_comuna.indexOf('la plata')>-1
                || barrio_localidad.indexOf('la plata')>-1){
                item.preservativos = "SI";

                
            }
           
        }
        
            unify();
        


    };

var a = false;

var filterBB = function(item){
            var key = item.partido_comuna.toLowerCase().trim();
            var otherKey = item.barrio_localidad.toLowerCase().trim();
            var searchKey = "bahía blanca";
            var othersearchKey = "bahia blanca";
            var result = 
            (   key.indexOf(searchKey)> -1  || 
                key.indexOf(othersearchKey)> -1  || 
                otherKey.indexOf(searchKey)> -1  || 
                otherKey.indexOf(othersearchKey)> -1  );
                return !result;
        }
var processBB = 
    function(err,argNewBB){


        
        var count = 0;
        console.log(arg.length,'before');
        arg = arg.filter(filterBB);
        console.log(arg.length,'after filter bb');
        //concateno!
        for (var i = 0; i < argNewBB.length; i++) {
            argNewBB[i].pais = "Argentina";
        };
        arg = argNewBB.concat(arg);


        console.log(arg.length,'after new points');
        
        updateCaba();


    };


var removeAndUpBahiaBlanca = function(){
converterBB.fromFile("raw-datasets/argentina-data-set-up27MAR2016-export.json",
    processBB);
};

var updateCaba = function(){
converterCABA.fromFile("raw-datasets/argentina-caba.csv",processCABA);
};




removeAndUpBahiaBlanca();