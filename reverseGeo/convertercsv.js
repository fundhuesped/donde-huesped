var fs = require("fs");

var sets = JSON.parse(fs.readFileSync('raw-datasets/raw-full.json', 'utf8'));
var newSet = [];

function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

for (var i = 0; i < sets.length; i++) {
	var s = sets[i];
	s.barrio_localidad = toTitleCase(s.barrio_localidad);
    s.partido_comuna = toTitleCase(s.partido_comuna);
    s.provincia_region = toTitleCase(s.provincia_region);
    s.pais = toTitleCase(s.pais);
    s.condones = s.preservativos;
    s.prueba = s.testeo;
    delete s.preservativos;
    delete s.testeo;
    newSet.push(s);
};

fs.writeFile('raw-datasets/full.json', JSON.stringify(newSet), function(err) {
    if(err) {
        return console.log(err);
    }

    console.log("The file was saved!");
}); 