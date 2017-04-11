var fs = require("fs");
var jsonminify = require("jsonminify");
var _ = require('underscore');
var async = require('async');

//Converter Class
var Converter = require("csvtojson").Converter;
var converterCABA = new Converter({});
var converterBB = new Converter({});
var mysql = require('mysql');
var fs = require('fs');
var readline = require('readline');
var connection = mysql.createConnection({
    multipleStatements: true,
   host: 'us-cdbr-iron-east-03.cleardb.net',
   port: '3306',
   database: 'heroku_ba201e13d0ee73b',
   user: 'b1007d9371bfe6',
   password: 'ecc3af85'
});

var fecha = "06ABR2016";
var fullSet = JSON.parse(fs.readFileSync('public/datasets/full-unified.json', 'utf8'));

var countries = [];
var provincias = [];
var partidos = [];

var finales = [];

    countries['Argentina']= {
        habilitado: true,
        nombre_pais: 'Argentina',
        // latitude: -37.8514367,
        // longitude: -67.2153843,
        zoom:4
     
    };
 countries['Chile']= {
    habilitado: true,
        nombre_pais: 'Chile',
        // latitude: -35.4544075,
        // longitude: -74.6860874,
        zoom:4
    };
 countries['Uruguay']= {
    habilitado: true,
        nombre_pais: 'Uruguay',
        // latitude: -32.8846634,
        // longitude:-56.2372968,
        zoom:6
       
    };
 
 countries['Colombia']= {
    habilitado: false,
     nombre_pais: 'Colombia',
     // latitude: 3.8926541,
     // longitude:-73.325062,
     zoom:5    
    };

 countries['Mexico']= {
    habilitado: false,
     nombre_pais: 'Mexico',
     // latitude: 21.9828103,
     // longitude:-106.4451805,
     zoom:5
    };




function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
var unify = function(){

       
    var newSet = fullSet;


        console.log(newSet.length,'newSet');
        
        //OBTENER TODOS LOS PAISES
        pushCountries(newSet,function(){
            //Obtener todas las provincias
            console.log('ahora todos los provincias');
            pushProvinces(newSet, function(){
                //Obtener todas los partidos
                console.log('ahora todos los partidos');
                pushPartidos(newSet, function(){
                        console.log('ahora todos los puntos');
                         pushItems(newSet, function(){
                                   console.log('ahora listo!');
                         });

                })
            });
        });
    
}

var pushItems = function(dataset,cb){
    


    async.filter(dataset, function(p, callback) {
        var pais = countries[p.pais];
        if(!pais){
            console.log("no hay pais ?", p);
            callback();
        }
        var idProvincia = getIdProvincia(pais.id,p.provincia_region);
        if (idProvincia === 0){
            console.log("no hay provincia ?", p.establecimiento);
            callback();
        }
        console.log(idProvincia,p.partido_comuna);
        var idPartido = getIdPartido(idProvincia,p.partido_comuna);
        if (idPartido === 0){
            console.log("no hay partido ?",idProvincia, p.partido_comuna, p.establecimiento);
            callback();
        }

        var p = JSON.parse(JSON.stringify(p));  
        var z ={
            idPais: parseInt(pais.id),
            idProvincia: parseInt(idProvincia),
            idPartido: parseInt(idPartido)

        };
        p.idPais = z.idPais
        p.idProvincia = z.idProvincia;
        p.idPartido = z.idPartido;
        p.aprobado = 1;
        delete p.partido_comuna;
        delete p.provincia_region;
        delete p.pais;
        delete p.LatLong;
        delete p.source;

        if (p["ubicación_distrib"]){
            p.ubicacion_distrib = p["ubicación_distrib"];
            console.log('adios1')
        }
        delete p["ubicación_distrib"];


        connection.query('INSERT INTO places SET ?', p, function(err, result) {
                  if (err) 
                    {
                        console.log(err,z);
                        
                        throw err;
                    }
                    else {
                        p.id =  result.insertId;
                        finales.push(p);
                        console.log(p.establecimiento, " insertado");

                       


                        callback(null,!err);
                    }
                });

           
    }, function(err, results){
        console.log('todos insertados partidos', partidos.length);
        cb();
    });
    


};




var getIdProvincia = function(pais, provincia){
    if (pais === 0){
        return 0;
    }
    for (var i = 0; i < provincias.length; i++) {
        if (provincias[i].nombre_provincia === provincia){
            return provincias[i].id;
        }
    };
    return 0 ;
}

var getIdPartido = function(provincia, partido){
    if (provincia === 0){
        return 0;
    }
    for (var i = 0; i < partidos.length; i++) {
        var l = partidos[i];
        if (parseInt(l.idProvincia) === provincia && l.nombre_partido === partido){
            return l.id;
        }
    };
    
    return 0 ;
}


var pushPartidos = function(dataset,cb){

    var d = _.groupBy(dataset, function(p){ 
        var pais = countries[p.pais];
        var id = 0;
        if (pais){
            id = pais.id;
        }
        var idProvincia = getIdProvincia(id, p.provincia_region);

        var item = id+"__"+idProvincia+"__" + p.partido_comuna;
        return item;
            
            
        
    });
    var x = _.map(d, function(items, i) {   
      
        var s = i.split("__");
        return {
            nombre_partido: s[2], 
            idProvincia : s[1],
            idPais: s[0]
        };   
    });
    console.log('insertando partidos ' , x.length);
    async.filter(x, function(p, callback) {
       
            if (!p){
                console.log('No hay partido?', p);
                callback();
            }
            else if (p.idProvincia === '0'){
                console.log('No hay provincia?');
                   callback();
            }
            else {
               connection.query('INSERT INTO partido SET ?', p, function(err, result) {
                  if (err) 
                    {
                        console.log(err,p);
                        
                        throw err;
                    }
                    else {
                        p.id =  result.insertId;
                        partidos.push(p);
                        console.log(p.nombre_partido, " insertado");
                        callback(null,!err);
                    }
                });
            }      
      
    }, function(err, results){
        console.log('todos insertados partidos', partidos.length);
        cb();
    });
    

}
var pushProvinces = function(dataset,cb){

    var d = _.groupBy(dataset, function(p){ 
        var pais = countries[p.pais];
        var id = 0;
        if (pais){
            id = pais.id;
        }
        var item = id+"__"+p.provincia_region;
        return item;
            
            
        
    });
    var x = _.map(d, function(items, i) {   
    
        var s = i.split("__");
        return {
            nombre_provincia: s[1], 
            idPais : s[0]
        };   
    });

    async.filter(x, function(p, callback) {
       
            if (!p){
                console.log('No hay provincia?',p.establecimiento);
                callback();
            }
            else if (p.idPais === '0'){
                console.log('No hay pais?',p.establecimiento);
                   callback();
            }
            else {
               connection.query('INSERT INTO provincia SET ?', p, function(err, result) {
                  if (err) 
                    {
                        console.log(err,p);
                        a=z;
                        throw err;
                    }
                    else {
                        p.id =  result.insertId;
                        provincias.push(p);
                        callback(null,!err);
                    }
                });
            }      
      
    }, function(err, results){
        console.log('todos insertados provincias', provincias.length);
        cb();
    });
    

}

var pushCountries = function(dataset,cb){

    var d = _.groupBy(dataset, function(p){ 
        return p.pais;
    });
    var x = _.map(d, function(items, pais) {   
        return {nombre_pais: pais,  cantidad: items.length};   
    });
    async.filter(x, function(c, callback) {
        if (c.nombre !== ''){
            var p = countries[c.nombre_pais];
            if (!p){
                console.log('No hay pais?', c);
                callback();
            }
            else {
               connection.query('INSERT INTO pais SET ?', p, function(err, result) {
                  if (err) throw err;
                  countries[c.nombre_pais].id = result.insertId;
                callback(null,!err);
                });
            }
            
        }
        else 
        {
            console.log('No hay pais?', c);
            callback();
        }
    }, function(err, results){
        console.log('todos insertados');
        cb();
    });
    

}
        
unify();

