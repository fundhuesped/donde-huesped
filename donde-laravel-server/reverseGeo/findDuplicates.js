var fs = require("fs");
var json2csv = require('nice-json2csv');
//Converter Class
var Converter = require("csvtojson").Converter;
var converterCABA = new Converter({});
var converterBB = new Converter({});
var areEqual = function(a,b){
    if (!a.calle){
        return false;
    }
    try{
        if (a.calle.trim() === ''){
            return false;
        }
    }
    catch(e){
        console.log('error calle', a.calle, a.establecimiento);
        return false;
    }
   
   return  a.pais === a.pais && a.calle === b.calle && b.altura === a.altura;
}

var sets = JSON.parse(fs.readFileSync('public/datasets/full-unified.json', 'utf8'));
    
    var duplicates = [];
    for (var i = 0; i < sets.length; i++) {
    	var s = sets[i];
           console.log(i);
           if (!s.duplicado){
            	for (var j = 0; j< sets.length; j++) {
                    

                    var z = sets[j];
 
                    if (areEqual(s,z) && !z.duplicado && z.establecimiento.toLowerCase() !== s.establecimiento.toLowerCase()){
                        duplicates.push({
                            original_position: i,
                            original_establecimiento: s.establecimiento,
                            original_calle: s.calle,
                            original_altura : s.altura,
                            original_pais : s.pais,
                            original_barrio_localidad: s.barrio_localidad, 
                            original_partido_comuna: s.partido_comuna, 
                            original_provincia_region: s.provincia_region, 
                            duplicate_position:j ,
                            duplicate_establecimiento: z.establecimiento,
                            duplicate_calle: z.calle,
                            duplicate_altura : z.altura,
                            duplicate_pais : z.pais,
                            duplicate_barrio_localidad: z.barrio_localidad, 
                            duplicate_partido_comuna: z.partido_comuna, 
                            duplicate_provincia_region: z.provincia_region
               
                        }); 
                        sets[i].duplicado = true;
                        sets[j].duplicado = true;
                        console.log('duplicate!!');       
                        break;
                    }
                };
            }
        
    };

       
    var csvContent = json2csv.convert(duplicates);
    console.log('saving...', duplicates.length);
    fs.writeFile("raw-datasets/duplicates-export.csv", csvContent);
    console.log('saveResult');
    




