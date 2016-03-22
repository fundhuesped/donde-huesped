var fs = require("fs");

//Converter Class
var Converter = require("csvtojson").Converter;
var converter = new Converter({});


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
        s.condones = s.preservativos;
        s.prueba = s.testeo;
        delete s.preservativos;
        delete s.testeo;
        newSet.push(s);
    };

    fs.writeFile('public/datasets/full-unified.json', JSON.stringify(newSet), function(err) {
        if(err) {
            return console.log(err);
        }

        console.log("The file was saved!");
    }); 

}






converter.fromFile("raw-datasets/argentina-caba.csv",function(err,argNewCaba){
    
    var oldCaba =[];
    var newCaba = [];

  

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
        var item = arg[i]
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
                    console.log('converted! ', count ,update.provincia_region, 
                        update.barrio_localidad, item.establecimiento);
                     arg[i] = item;
                    break;
                }

            };
        }
       
    }

    unify();



});
