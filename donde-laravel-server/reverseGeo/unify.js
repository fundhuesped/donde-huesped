var fs = require("fs");
var jsonminify = require("jsonminify");

//Converter Class
var Converter = require("csvtojson").Converter;
var converterCABA = new Converter({});
var converterBB = new Converter({});

var fecha = "06ABR2016";
var arg = JSON.parse(fs.readFileSync('raw-datasets/' + fecha+ '/arg-export.json', 'utf8'));
var uru = JSON.parse(fs.readFileSync('raw-datasets/' + fecha+ '/uru-export.json', 'utf8'));
var chi = JSON.parse(fs.readFileSync('raw-datasets/' + fecha+ '/chi-export.json', 'utf8'));


function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
var unify = function(){


    var sets = arg.concat(uru).concat(chi);
      console.log(arg.length,'arg');
      console.log(uru.length,'uru');
      console.log(chi.length,'chi');
        console.log(sets.length,'sets');
       
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

var updateCaba = function(){
    converterCABA.fromFile("raw-datasets/12ABR2016/CABA-No-Comunas.csv",processCABA);
};

var processCABA = function(err,newCaba){
        
        var oldCaba =[];
        console.log(err);

       
        var count = 0;
        for (var i = 0; i < arg.length; i++) {
            //Si esta en...
            var item = arg[i];


            //Actualizo CABA
            var provincia_region = item.provincia_region;
            if (provincia_region === "Ciudad Autónoma de Buenos Aires" 
                || provincia_region ==="CABA" || provincia_region ==="Caba"){
                item.provincia_region =  "Ciudad Autónoma de Buenos Aires";//update.provincia_region;

                for (var j = 0; j < newCaba.length; j++) {
                    var update = newCaba[j];

                    if (update.establecimiento === item.establecimiento){
                        console.log("update", update.establecimiento, update.barrio_localidad);
                        item.partido_comuna = update.partido_comuna;
                        item.barrio_localidad = update.barrio_localidad;
                        
                        count++;
                        console.log('converted! ', count ,
                            item.provincia_region, 
                            item.barrio_localidad, item.establecimiento);
                       
                        break;
                    }

                }
                arg[i] = item;
            }
          
           
        }
        
            unify();
        


    };

updateCaba();