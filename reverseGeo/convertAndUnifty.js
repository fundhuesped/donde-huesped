var fs = require("fs");
var jsonminify = require("jsonminify");

//Converter Class
var Converter = require("csvtojson").Converter;
var converterCABA = new Converter({});
var converterBB = new Converter({});


var arg = JSON.parse(fs.readFileSync('raw-datasets/argentina-export-final.json', 'utf8'));
var uru = JSON.parse(fs.readFileSync('raw-datasets/uruguay-export-final.json', 'utf8'));
var chi = JSON.parse(fs.readFileSync('raw-datasets/chile-export-final.json', 'utf8'));


function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
var unify = function(){


    var sets = arg.concat(uru).concat(chi);

    var newSet = [];

  

    for (var i = 0; i < sets.length; i++) {
    	var s = sets[i];
    	s.barrio_localidad = toTitleCase(s.barrio_localidad);
        s.partido_comuna = toTitleCase(s.partido_comuna);
        if (s.provincia_region !== "CABA"){
            s.provincia_region = toTitleCase(s.provincia_region);
        }
        s.pais = toTitleCase(s.pais);
        s.vacunatorio = s.vacunatorio ==="SI";
        s.infectologia = s.infectologia === "SI";
        s.condones = s.preservativos === "SI";
        s.prueba =  s.testeo === "SI";
        delete s.preservativos;
        delete s.testeo;
        newSet.push(s);
    };
    var initSet = JSON.stringify(newSet);
    fs.writeFile('public/datasets/full-unified.json',initSet , function(err) {
        if(err) {
            return console.log(err);
        }

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

var processBB = 
    function(err,argNewBB){


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
        var count = 0;
        console.log(arg.length,'before');
        arg = arg.filter(filterBB);
        console.log(arg.length,'after filter bb');
        //concateno!
        arg = arg.concat(argNewBB);

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